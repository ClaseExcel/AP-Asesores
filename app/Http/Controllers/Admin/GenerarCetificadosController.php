<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmpleadoCliente;
use App\Models\Empresa;
use App\Models\LlamadoAtencion;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;

class GenerarCetificadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('ACCEDER_GENERAR_CERTIFICADOS'), Response::HTTP_UNAUTHORIZED);

        $tipo_documentos = [
            '1' => 'Autorización de retiro cesantías',
            '2' => 'Carta laboral con receptor',
            '3' => 'Contrato de trabajo por días u horas',
            '4' => 'Llamado de atención',
            '5' => 'Minuta de contrato a término fijo',
            '6' => 'Minuta de contrato a término indefinido'
        ];

        $conceptos = [
            '1' => 'Adquisición, construcción o mejora de vivienda',
            '2' => 'Afectación por calamidad doméstica',
            '3' => 'Atención de emergencias sanitarias o sociales',
            '4' => 'Educación',
            '5' => 'Terminación del contrato de trabajo',
        ];


        return view('admin.certificados.index', compact('tipo_documentos', 'conceptos'));
    }

    public function getEmpleado(Request $request)
    {
        $cedula = $request->cedula;
        $empleado = User::withTrashed()->where('cedula', $cedula)->first();

        if (!$empleado) {
            return response()->json(['message' => 'No existe el usuario que estas ingresando.', 'color' => 'danger'], Response::HTTP_BAD_REQUEST);
        }

        return json_encode($empleado);
    }

    public function generarDocumento(Request $request)
    {

        $request->validate([
            'tipo_documento' => 'required',
        ], [
            'tipo_documento.required' => 'Selecciona el tipo de documento.',
        ]);

        $empleado = User::withTrashed()->where('cedula', $request->cedula_empleado)->first();
        $cliente = EmpleadoCliente::where('user_id', $empleado->id)->first();

        if ($cliente) {
            $empresa = $cliente->empresas;
        } else {
            $empresa = Empresa::find(1);
        }

        if ($request->tipo_documento == 1) { //Autorización de retiro cesantías

            $request->validate([
                'concepto' => 'required_if:tipo_documento,1',
            ], [
                'concepto.required_if' => 'Selecciona un concepto.',
            ]);

            if ($request->concepto == 1) {
                $concepto = 'Adquisición, construcción o mejora de vivienda';
            } elseif ($request->concepto == 2) {
                $concepto = 'Afectación por calamidad doméstica';
            } elseif ($request->concepto == 3) {
                $concepto = 'Atención de emergencias sanitarias o sociales';
            } elseif ($request->concepto == 4) {
                $concepto = 'Educación';
            } elseif ($request->concepto == 5) {
                $concepto = 'Terminación del contrato de trabajo';
            }

            $pdf = PDF::loadView('admin.certificados.pdf.cesantias', ['concepto' => $concepto, 'empleado' => $empleado, 'empresa' => $empresa]);
            return $pdf->download('Autorización_retiro_cesantias_' .  $empleado->nombres . ' ' . $empleado->apellidos . '_' . Carbon::now()->format('d-m-Y') . '.pdf');
        } elseif ($request->tipo_documento == 2) { //Carta laboral con receptor

            $request->validate([
                'dirigido' => 'required_if:tipo_documento,2',
                'salario_empleado' => 'required_if:tipo_documento,2',
                'fecha_ingreso_empleado' => 'required_if:tipo_documento,2',
            ], [
                'salario_empleado.required_if' => 'Ingresa el salario del empleado.',
                'dirigido.required_if' => 'Ingresa a quién va dirigida la carta.',
                'fecha_ingreso_empleado.required_if' => 'Selecciona la fecha de ingreso del empleado.',
            ]);

            $pdf = PDF::loadView('admin.certificados.pdf.carta-laboral', [
                'salario' => $request->salario_empleado,
                'empleado' => $empleado,
                'empresa' => $empresa,
                'fecha_ingreso' => $request->fecha_ingreso_empleado,
                'otros_ingresos' => $request->otros_ingresos,
                'dirigido' => $request->dirigido
            ]);

            return $pdf->download('Carta_laboral_' .  $empleado->nombres . ' ' . $empleado->apellidos . '_' . Carbon::now()->format('d-m-Y') . '.pdf');
        } elseif ($request->tipo_documento == 3) { //Contrato de trabajo por días u horas

            $request->validate([
                'funciones_empleados' => 'required_if:tipo_documento,3',
            ], [
                'funciones_empleados.required_if' => 'Ingresa la funciones del empleado.',
            ]);

            $pdf = PDF::loadView('admin.certificados.pdf.contrato-horas', [
                'funciones' => $request->funciones_empleados,
                'empleado' => $empleado,
                'empresa' => $empresa,
                'multa' => $request->valor_multa
            ]);

            return $pdf->download('Contrato_trabajo_por_dias_u_horas_' .  $empleado->nombres . ' ' . $empleado->apellidos . '_' . Carbon::now()->format('d-m-Y') . '.pdf');
        } elseif ($request->tipo_documento == 4) { //Llamado de atención

            $request->validate([
                'asunto' => 'required_if:tipo_documento,4',
                'medidas' => 'required_if:tipo_documento,4',
                'descripcion_conducta' => 'required_if:tipo_documento,4',
            ], [
                'asunto.required_if' => 'Selecciona el asunto del llamado.',
                'medidas.required_if' => 'Selecciona las medidas correctivas a tomar.',
                'descripcion_conducta.required_if' => 'Ingresa la descripción de la conducta o el incumplimiento.',
            ]);

            $medidas = json_encode($request->medidas);
            $empleado_id = $empleado->id;
            $consecutivo = $this->consecutivoLlamadoAtencion($request, $empleado_id);
            $urlPathImage = null;

            //Imagen de evidencia
            if ($request->file('evidencia')) {
                $foldername = 'llamado_atencion_' . $empleado->cedula;
                $archivo = $request->file('evidencia');

                $documento = $archivo->getClientOriginalName();
                $urlPathImage = 'storage/llamadoAtencion/' . $foldername . '/' . $archivo->getClientOriginalName();

                Storage::disk('llamadoAtencion')->put($foldername . '/' . $documento, File::get($archivo));
            }

            $pdf = PDF::loadView('admin.certificados.pdf.llamado-atencion', [
                'empleado' => $empleado,
                'empresa' => $empresa,
                'asunto' => $request->asunto,
                'medidas' => $request->medidas,
                'img_evidencia' => $urlPathImage,
                'consecutivo' => $consecutivo,
                'descripcion_conducta' => $request->descripcion_conducta
            ]);

            // Guardar PDF en el disco 'llamadoAtencion'
            $foldernamePdf = 'llamado_atencion_' . $empleado->cedula;
            $pdfFileName = $request->asunto . '_' .  $empleado->nombres . ' ' . $empleado->apellidos . '_' . Carbon::now()->format('d_m_Y') . '_' . Carbon::now()->format('H_i_s') . '.pdf';
            // almacenar archivo PDF
            Storage::disk('llamadoAtencion')->put($foldernamePdf . '/' . $pdfFileName, $pdf->output());
            // ruta (opcional) para guardar en BD o usar luego
            $urlPathPdf = 'storage/llamadoAtencion/' . $foldernamePdf . '/' . $pdfFileName;

            LlamadoAtencion::create([
                'asunto' => $request->asunto,
                'medidas' => $medidas,
                'consecutivo' => $consecutivo,
                'evidencia' => $urlPathImage,
                'url_documento' => $urlPathPdf,
                'empleado_id' => $empleado_id,
            ]);

            return $pdf->download($pdfFileName);
        } elseif ($request->tipo_documento == 5) { //Minuta de contrato a término fijo

            $request->validate([
                'funciones_empleados' => 'required_if:tipo_documento,5',
            ], [
                'funciones_empleados.required_if' => 'Ingresa la funciones del empleado.',
            ]);

            $pdf = PDF::loadView('admin.certificados.pdf.contrato-fijo', [
                'empleado' => $empleado,
                'empresa' => $empresa,
                'multa' => $request->valor_multa,
                'funciones' => $request->funciones_empleados
            ]);

            return $pdf->download('Minuta_contrato_a_termino_fijo_' .  $empleado->nombres . ' ' . $empleado->apellidos . '_' . Carbon::now()->format('d-m-Y') . '.pdf');
        } elseif ($request->tipo_documento == 6) { //Minuta de contrato a término indefinido

            $request->validate([
                'funciones_empleados_indefinido' => 'required_if:tipo_documento,6',
            ], [
                'funciones_empleados_indefinido.required_if' => 'Ingresa la funciones del empleado.',
            ]);

            $pdf = PDF::loadView('admin.certificados.pdf.contrato-indefinido', [
                'empleado' => $empleado,
                'empresa' => $empresa,
                'multa' => $request->valor_multa,
                'funciones' => $request->funciones_empleados_indefinido
            ]);

            return $pdf->download('Minuta_contrato_a_termino_indefinido_' .  $empleado->nombres . ' ' . $empleado->apellidos . '_' . Carbon::now()->format('d-m-Y') . '.pdf');
        }
    }

    private function consecutivoLlamadoAtencion($request, $empleado_id)
    {
        // Definir prefijo según el tipo de asunto
        $prefijo = '';
        switch ($request->asunto) {
            case 'Llamado de atención':
                $prefijo = 'L';
                break;
            case 'Memorando':
                $prefijo = 'M';
                break;
            case 'Comunicación disciplinaria':
                $prefijo = 'CD';
                break;
            default:
                $prefijo = 'C'; // fallback si no coincide
                break;
        }

        // Contar registros del mismo tipo de asunto para ese empleado
        $count = LlamadoAtencion::where('empleado_id', $empleado_id)
            ->where('asunto', $request->asunto)
            ->count();

        $next = $count + 1;

        // Generar consecutivo con prefijo y número
        $consecutivo = $prefijo . str_pad($next, 3, '0', STR_PAD_LEFT);
        return $consecutivo;
    }
}
