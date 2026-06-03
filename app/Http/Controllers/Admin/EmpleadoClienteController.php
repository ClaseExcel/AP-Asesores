<?php

namespace App\Http\Controllers\admin;

use App\Exports\EmpleadosExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ActionButtonTrait;
use App\Http\Requests\CreateEmpleadoClienteRequest;
use App\Http\Requests\UpdateEmpleadoClienteRequest;
use App\Mail\restablecerContrasena;
use App\Models\AdministradorasActiva;
use App\Models\Cargo;
use App\Models\EmpleadoCliente;
use App\Models\Empresa;
use App\Models\LlamadoAtencion;
use App\Models\Rol;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class EmpleadoClienteController extends Controller
{
    use ActionButtonTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('ACCEDER_EMPLEADOS'), Response::HTTP_UNAUTHORIZED);

        if ($request->ajax()) {
            $empleados = EmpleadoCliente::with(['empresas', 'usuarios' => function ($query) {
                $query->withTrashed();
            }])
                ->select('empleado_clientes.*');


            return DataTables::of($empleados)
                ->addColumn('actions', function ($empleados) {
                    // Lógica para generar las acciones para cada registro de empleados
                    return $this->getActionButtons('admin.empleados', 'EMPLEADOS', $empleados->user_id, $empleados->usuarios->estado);
                })
                ->rawColumns(['actions']) //para que se muestr el codigo html en la tabla
                ->make(true);
        }

        return view('admin.empleados.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('CREAR_EMPLEADOS'), Response::HTTP_UNAUTHORIZED);

        //obtener el id y el nombre del cargo cliente
        $cargo = Cargo::orderBy('nombre')->pluck('nombre', 'id');
        $roles = Role::orderBy('title')->whereIn('title', ['Cliente', 'Génerico'])->pluck('title', 'id');
        $empresas = Empresa::orderBy('razon_social')->whereNotIn('id', [1])->where('estado', 1)->pluck('razon_social', 'id');
        $eps = AdministradorasActiva::where('subsistema', 'EPS')->get();
        $afp = AdministradorasActiva::where('subsistema', 'AFP')->orderBy('razon_social')->get();
        $ccf = AdministradorasActiva::where('subsistema', 'CCF')->orderBy('razon_social')->get();

        $tipos_identificacion = [
            'Cédula de extranjería (CE)',
            'Cédula de ciudadanía (CC)',
            'Documento de identificación extranjero (DIE)',
            'Identificación tributaria de otro país (NE)',
            'Número de Identificación Tributaria CO (NIT)',
            'Pasaporte (PSPT)',
            'Permiso especial permanencia (PEP)',
            'Permiso por protección temporal (PPT)',
            'Registro civil (RC)',
            'Registro Único de Información Fiscal (RIF)',
            'Tarjeta de identidad (TI)',
            'Tarjeta de extranjería (TE)',
        ];

        $beneficiario = [
            'Cónyuge',
            'Companero permanente',
            'Hijos/a',
            'Padre/madre',
            'Hijastro/tra',
        ];

        return view('admin.empleados.create', compact('roles', 'cargo', 'empresas', 'eps', 'afp', 'ccf', 'tipos_identificacion', 'beneficiario'), ['empleado' => new EmpleadoCliente]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEmpleadoClienteRequest $request)
    {

        $beneficiario = json_encode($request['beneficiario']);

        $informacion =  [
            [
                'tipo_identificacion' => $request->tipo_identificacion1,
                'numero' => $request->numero1,
                'nombres' => $request->nombres1,
                'parentesco' => $request->parentesco1,
                'fecha_nacimiento' => $request->fecha_nacimiento1,
                'funeraria' => $request->funeraria1,
                'eps' => $request->eps1,
                'caja_compensacion' => $request->caja_compensacion1
            ],
            [
                'tipo_identificacion' => $request->tipo_identificacion2,
                'numero' => $request->numero2,
                'nombres' => $request->nombres2,
                'parentesco' => $request->parentesco2,
                'fecha_nacimiento' => $request->fecha_nacimiento2,
                'funeraria' => $request->funeraria2,
                'eps' => $request->eps2,
                'caja_compensacion' => $request->caja_compensacion2
            ],
            [
                'tipo_identificacion' => $request->tipo_identificacion3,
                'numero' => $request->numero3,
                'nombres' => $request->nombres3,
                'parentesco' => $request->parentesco3,
                'fecha_nacimiento' => $request->fecha_nacimiento3,
                'funeraria' => $request->funeraria3,
                'eps' => $request->eps3,
                'caja_compensacion' => $request->caja_compensacion3
            ],
            [
                'tipo_identificacion' => $request->tipo_identificacion4,
                'numero' => $request->numero4,
                'nombres' => $request->nombres4,
                'parentesco' => $request->parentesco4,
                'fecha_nacimiento' => $request->fecha_nacimiento4,
                'funeraria' => $request->funeraria4,
                'eps' => $request->eps4,
                'caja_compensacion' => $request->caja_compensacion4
            ],
            [
                'tipo_identificacion' => $request->tipo_identificacion5,
                'numero' => $request->numero5,
                'nombres' => $request->nombres5,
                'parentesco' => $request->parentesco5,
                'fecha_nacimiento' => $request->fecha_nacimiento5,
                'funeraria' => $request->funeraria5,
                'eps' => $request->eps5,
                'caja_compensacion' => $request->caja_compensacion5
            ],
        ];

        $filteredData = array_filter($informacion, function ($item) {
            // Verifica si todos los valores del sub-array son nulos o vacíos
            return !empty(array_filter($item));
        });

        //Reinicia los index del array si el primero esta vacío
        $filteredData = array_values($filteredData);

        $request = $request->merge(['informacion_beneficiario' => json_encode($filteredData)]);
        $request = $request->merge(['beneficiario' => str_replace(['\\', '',], '', $beneficiario)]);

        $empresas_secundarias = json_encode($request['empresas_secundarias']);

        try {
            Mail::to($request['email'])->send(new restablecerContrasena($request['email'], $request['password']));

            $user = User::create($request->all());
            EmpleadoCliente::create([
                'nombres' => $request['nombres'],
                'apellidos' => $request['apellidos'],
                'correo_electronico' => $request['email'],
                'numero_contacto' => $request['numero_contacto'],
                'correos_secundarios' => $request['correos_secundarios'],
                'empresa_id' => $request['empresa_id'],
                'user_id' => $user->id,
                'empresas_secundarias' => $empresas_secundarias
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            session(['message' => 'Hubo un problema al enviar el correo, el usuario no ha sido creado', 'color' => 'warning']);
            return redirect()->route('admin.empleados.index');
        }

        if ($request->fecha_retiro) {
            $user->estado = 'INACTIVO';
            $user->deleted_at = Carbon::parse($request->fecha_retiro)->format('Y-m-d H:i:s');
            $user->save();
        }

        // Verifica si se proporciona un nuevo archivo PDF para 'rut'
        if ($request->hasFile('documento_examen')) {
            $file = $request->file('documento_examen');
            $filename =  'documento_examen' . "." . $file->getClientOriginalExtension();

            // Elimina el archivo anterior si existe
            if (file_exists(storage_path('app/public/' . $user->cedula . '/' . $filename))) {
                unlink(storage_path('app/public/' . $user->cedula . '/' . $filename));
            }
            // Mueve y guarda el nuevo archivo PDF
            $file->move(storage_path('app/public/' . $user->cedula . '/'), $filename);

            $user->documento_examen = $filename;
            $user->save();
        }

        if ($request->hasFile('documento_afiliacion')) {
            $file = $request->file('documento_afiliacion');
            $filename2 =  'documento_afiliacion' . "." . $file->getClientOriginalExtension();

            // Elimina el archivo anterior si existe
            if (file_exists(storage_path('app/public/' . $user->cedula . '/' . $filename2))) {
                unlink(storage_path('app/public/' . $user->cedula . '/' . $filename2));
            }
            // Mueve y guarda el nuevo archivo PDF
            $file->move(storage_path('app/public/' . $user->cedula . '/'), $filename2);

            $user->documento_afiliacion = $filename2;
            $user->save();
        }


        if ($request->hasFile('documento_contrato')) {
            $file = $request->file('documento_contrato');
            $filename3 =  'documento_contrato' . "." . $file->getClientOriginalExtension();

            // Elimina el archivo anterior si existe
            if (file_exists(storage_path('app/public/' . $user->cedula . '/' . $filename3))) {
                unlink(storage_path('app/public/' . $user->cedula . '/' . $filename3));
            }
            // Mueve y guarda el nuevo archivo PDF
            $file->move(storage_path('app/public/' . $user->cedula . '/'), $filename3);

            $user->documento_contrato = $filename3;
            $user->save();
        }

        if ($request->hasFile('documento_otros')) {
            $file = $request->file('documento_otros');
            $filename4 =  'documento_otros' . "." . $file->getClientOriginalExtension();

            // Elimina el archivo anterior si existe
            if (file_exists(storage_path('app/public/' . $user->cedula . '/' . $filename4))) {
                unlink(storage_path('app/public/' . $user->cedula . '/' . $filename4));
            }
            // Mueve y guarda el nuevo archivo PDF
            $file->move(storage_path('app/public/' . $user->cedula . '/'), $filename4);

            $user->documento_otros = $filename4;
            $user->save();
        }

        session(['message' => 'El usuario se ha creado exitosamente.', 'color' => 'success']);
        return redirect()->route('admin.empleados.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado_cliente = EmpleadoCliente::where('user_id', $id)->first();
        $user = User::withTrashed()->find($id);
        $empresas = Empresa::orderBy('razon_social')->select('id', 'razon_social')->get();
        $documentosLlamados = LlamadoAtencion::where('empleado_id', $id)->get();

        $docList = [];

        if ($user->documento_examen) {
            $docList['file_documento_1'] = 'storage/' . $user->cedula . '/' . $user->documento_examen;
        }
        if ($user->documento_afiliacion) {
            $docList['file_documento_2'] = 'storage/' .  $user->cedula . '/' . $user->documento_afiliacion;
        }
        if ($user->documento_contrato) {
            $docList['file_documento_3'] = 'storage/' .  $user->cedula . '/' .  $user->documento_contrato;
        }
        if ($user->documento_otros) {
            $docList['file_documento_4'] = 'storage/' .  $user->cedula . '/' .  $user->documento_otros;
        }

        $docListLlamados = [];

        if ($documentosLlamados) {
            foreach ($documentosLlamados as $documento) {
                $docListLlamados[] = [
                    'consecutivo'   => $documento->consecutivo ?? $documento->id,
                    'url_documento' => $documento->url_documento,
                    'asunto'        => $documento->asunto,
                    'created_at'    => $documento->created_at,
                ];
            }
        }

        $empresas_secundarias = [];

        foreach ($empresas as $empresa) {
            if (collect(json_decode($empleado_cliente->empresas_secundarias))->contains($empresa->id)) {
                $empresas_secundarias[] = [
                    'razon_social' => $empresa->razon_social,
                ];
            }
        }

        return view('admin.empleados.show', compact('empleado_cliente', 'user', 'docList', 'empresas_secundarias', 'docListLlamados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('EDITAR_EMPLEADOS'), Response::HTTP_UNAUTHORIZED);

        $empleado = EmpleadoCliente::with(['usuarios' => function ($query) {
            $query->withTrashed();
        }])->where('user_id', $id)->first();

        $roles = Role::orderBy('title')->whereIn('title', ['Cliente', 'Génerico'])->pluck('title', 'id');
        $cargo = Cargo::orderBy('nombre')->pluck('nombre', 'id');
        $empresas = Empresa::orderBy('razon_social')->whereNotIn('id', [1])->where('estado', 1)->pluck('razon_social', 'id');
        $eps = AdministradorasActiva::where('subsistema', 'EPS')->get();
        $afp = AdministradorasActiva::where('subsistema', 'AFP')->orderBy('razon_social')->get();
        $ccf = AdministradorasActiva::where('subsistema', 'CCF')->orderBy('razon_social')->get();

        $tipos_identificacion = [
            'Cédula de extranjería (CE)',
            'Cédula de ciudadanía (CC)',
            'Documento de identificación extranjero (DIE)',
            'Identificación tributaria de otro país (NE)',
            'Número de Identificación Tributaria CO (NIT)',
            'Pasaporte (PSPT)',
            'Permiso especial permanencia (PEP)',
            'Permiso por protección temporal (PPT)',
            'Registro civil (RC)',
            'Registro Único de Información Fiscal (RIF)',
            'Tarjeta de identidad (TI)',
            'Tarjeta de extranjería (TE)',
        ];

        $beneficiario = [
            'Cónyuge',
            'Companero permanente',
            'Hijos/a',
            'Padre/madre',
            'Hijastro/tra',
        ];

        if ($empleado->usuarios->informacion_beneficiario) {
            $informacion_beneficiarios = json_decode($empleado->usuarios->informacion_beneficiario);
        } else {
            $informacion_beneficiarios = [];
        }

        return view('admin.empleados.edit', compact('empleado', 'roles', 'cargo', 'empresas', 'eps', 'afp', 'ccf', 'tipos_identificacion', 'beneficiario', 'informacion_beneficiarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpleadoClienteRequest $request, $id)
    {
        $empleado_cliente = EmpleadoCliente::where('user_id', $id)->first();
        $user = User::withTrashed()->find($empleado_cliente->user_id);
        $empresas_secundarias = json_encode($request['empresas_secundarias']);

        $informacion =  [
            [
                'tipo_identificacion' => $request->tipo_identificacion1,
                'numero' => $request->numero1,
                'nombres' => $request->nombres1,
                'parentesco' => $request->parentesco1,
                'fecha_nacimiento' => $request->fecha_nacimiento1,
                'funeraria' => $request->funeraria1,
                'eps' => $request->eps1,
                'caja_compensacion' => $request->caja_compensacion1
            ],
            [
                'tipo_identificacion' => $request->tipo_identificacion2,
                'numero' => $request->numero2,
                'nombres' => $request->nombres2,
                'parentesco' => $request->parentesco2,
                'fecha_nacimiento' => $request->fecha_nacimiento2,
                'funeraria' => $request->funeraria2,
                'eps' => $request->eps2,
                'caja_compensacion' => $request->caja_compensacion2
            ],
            [
                'tipo_identificacion' => $request->tipo_identificacion3,
                'numero' => $request->numero3,
                'nombres' => $request->nombres3,
                'parentesco' => $request->parentesco3,
                'fecha_nacimiento' => $request->fecha_nacimiento3,
                'funeraria' => $request->funeraria3,
                'eps' => $request->eps3,
                'caja_compensacion' => $request->caja_compensacion3
            ],
            [
                'tipo_identificacion' => $request->tipo_identificacion4,
                'numero' => $request->numero4,
                'nombres' => $request->nombres4,
                'parentesco' => $request->parentesco4,
                'fecha_nacimiento' => $request->fecha_nacimiento4,
                'funeraria' => $request->funeraria4,
                'eps' => $request->eps4,
                'caja_compensacion' => $request->caja_compensacion4
            ],
            [
                'tipo_identificacion' => $request->tipo_identificacion5,
                'numero' => $request->numero5,
                'nombres' => $request->nombres5,
                'parentesco' => $request->parentesco5,
                'fecha_nacimiento' => $request->fecha_nacimiento5,
                'funeraria' => $request->funeraria5,
                'eps' => $request->eps5,
                'caja_compensacion' => $request->caja_compensacion5
            ],
        ];

        $filteredData = array_filter($informacion, function ($item) {
            // Verifica si todos los valores del sub-array son nulos o vacíos
            return !empty(array_filter($item));
        });

        //Reinicia los index del array si el primero esta vacío
        $filteredData = array_values($filteredData);

        $request = $request->merge(['informacion_beneficiario' => json_encode($filteredData)]);

        $empleado_cliente->update([
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'correo_electronico' => $request['email'],
            'numero_contacto' => $request['numero_contacto'],
            'correos_secundarios' => $request['correos_secundarios'],
            'empresa_id' => $request['empresa_id'],
            'empresas_secundarias' => $empresas_secundarias
        ]);

        $user->update($request->all());

        if ($request->fecha_retiro) {
            $user->estado = 'INACTIVO';
            $user->deleted_at = Carbon::parse($request->fecha_retiro)->format('Y-m-d H:i:s');
            $user->save();
        }

        // Verifica si se proporciona un nuevo archivo PDF para 'rut'
        if ($request->hasFile('documento_examen')) {
            $file = $request->file('documento_examen');
            $filename =  'documento_examen' . "." . $file->getClientOriginalExtension();

            // Elimina el archivo anterior si existe
            if (file_exists(storage_path('app/public/' . $user->cedula . '/' . $filename))) {
                unlink(storage_path('app/public/' . $user->cedula . '/' . $filename));
            }
            // Mueve y guarda el nuevo archivo PDF
            $file->move(storage_path('app/public/' . $user->cedula . '/'), $filename);

            $user->documento_examen = $filename;
            $user->save();
        }

        if ($request->hasFile('documento_afiliacion')) {
            $file = $request->file('documento_afiliacion');
            $filename2 =  'documento_afiliacion' . "." . $file->getClientOriginalExtension();

            // Elimina el archivo anterior si existe
            if (file_exists(storage_path('app/public/' . $user->cedula . '/' . $filename2))) {
                unlink(storage_path('app/public/' . $user->cedula . '/' . $filename2));
            }
            // Mueve y guarda el nuevo archivo PDF
            $file->move(storage_path('app/public/' . $user->cedula . '/'), $filename2);

            $user->documento_afiliacion = $filename2;
            $user->save();
        }


        if ($request->hasFile('documento_contrato')) {
            $file = $request->file('documento_contrato');
            $filename3 =  'documento_contrato' . "." . $file->getClientOriginalExtension();

            // Elimina el archivo anterior si existe
            if (file_exists(storage_path('app/public/' . $user->cedula . '/' . $filename3))) {
                unlink(storage_path('app/public/' . $user->cedula . '/' . $filename3));
            }
            // Mueve y guarda el nuevo archivo PDF
            $file->move(storage_path('app/public/' . $user->cedula . '/'), $filename3);

            $user->documento_contrato = $filename3;
            $user->save();
        }



        if ($request->hasFile('documento_otros')) {
            $file = $request->file('documento_otros');
            $filename4 =  'documento_otros' . "." . $file->getClientOriginalExtension();

            // Elimina el archivo anterior si existe
            if (file_exists(storage_path('app/public/' . $user->cedula . '/' . $filename4))) {
                unlink(storage_path('app/public/' . $user->cedula . '/' . $filename4));
            }
            // Mueve y guarda el nuevo archivo PDF
            $file->move(storage_path('app/public/' . $user->cedula . '/'), $filename4);

            $user->documento_otros = $filename4;
            $user->save();
        }

        return redirect()->route('admin.empleados.index')->with('message', 'El usuario se ha actualizado exitosamente.')->with('color', 'success');
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('ELIMINAR_EMPLEADOS'), Response::HTTP_UNAUTHORIZED);

        $user = User::withTrashed()->find($id);

        $admin = Auth::user()->id;

        if ($admin == $id) {
            return response()->json(['message' => 'No puedes inactivarte.', 'color' => 'danger'], Response::HTTP_BAD_REQUEST);
        }

        //si esta activo inactivar usuario
        if ($user->estado == 'ACTIVO') {
            $user->estado = 'INACTIVO';
            $user->delete();
            $user->save();


            return true;
        }

        $user->estado = 'ACTIVO';
        $user->restore();
        $user->save();

        return true;
    }

    public function empleadosExport()
    {
        $empleados = EmpleadoCliente::with(['empresas', 'usuarios' => function ($query) {
            $query->withTrashed();
        }])->get();

        return Excel::download(new EmpleadosExport($empleados), 'Lista de empleados.xlsx');
    }
}
