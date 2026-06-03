<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ComunicadoMail;
use App\Models\Comunicado;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class ComunicadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('ACCEDER_COMUNICADOS'), Response::HTTP_UNAUTHORIZED);

        if ($request->ajax()) {
            $comunicados =  Comunicado::with('user')->select('comunicados.*');


            return DataTables::of($comunicados)
                ->addColumn('clientes', function ($comunicados) {
                    $clientesIds = json_decode($comunicados->clientes);
                    if ($clientesIds) {
                        $clientesNombres = Empresa::whereIn('id', $clientesIds)->pluck('razon_social')->toArray();
                    }

                    return $clientesIds ? implode(', ', $clientesNombres) : '-';
                })
                ->addColumn('usuarios', function ($comunicados) {
                    $usuariosId = json_decode($comunicados->usuarios);
                    if ($usuariosId) {
                        $usuariosNombres = User::whereIn('id', $usuariosId)
                            ->select(DB::raw("CONCAT(nombres, ' ', apellidos) as nombre_completo"))
                            ->pluck('nombre_completo')->toArray();
                    }

                    return $usuariosId ? implode(', ', $usuariosNombres) : '-';
                })
                ->addColumn('correos_enviados', function ($comunicados) {
                    $correos = json_decode($comunicados->correos_enviados);
                    return implode(', ', $correos);
                })
                ->make(true);
        }

        $clientes = Empresa::orderBy('razon_social')->select('id', 'razon_social')->where('estado', 1)->whereJsonContains('empleados', (string)Auth::user()->id)->get();
        $usuarios = User::orderBy('nombres')->select('id', 'nombres', 'apellidos')->get();

        if (Auth::user()->role_id == 1) {
            $clientes = Empresa::orderBy('razon_social')->select('id', 'razon_social')->where('estado', 1)->get();
        }

        return view('admin.comunicados.index', compact('clientes', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required',
            'clientes' => 'required_if:tipo,1',
            'usuarios' => 'required_if:tipo,2',
            'comunicado' => 'required',
        ], [
            'tipo.required' => 'Selecciona a quién se va a dar el comunicado,',
            'clientes.required_if' => 'Debes seleccionar como minimo un cliente.',
            'usuarios.required_if' => 'Debes seleccionar como minimo un usuario',
            'comunicado.required' => 'El comunicado es obligatorio.',
        ]);

        try {

            $correos = [];
            if ($request->clientes) {
                $empresas = Empresa::whereIn('id', $request->input('clientes'))->select('correo_electronico')->get();

                foreach ($empresas as $empresa) {
                    $correos[] = $empresa->correo_electronico;
                }
            }

            if ($request->usuarios) {
                $usuarios = User::whereIn('id', $request->input('usuarios'))->select('email')->get();

                foreach ($usuarios as $usuario) {
                    $correos[] = $usuario->email;
                }
            }

            $clienteNotificacion = json_encode($request->input('clientes'));
            $usuarioNotificacion = json_encode($request->input('usuarios'));
            $userId = Auth::id();

            $request = $request->merge([
                'clientes' => $clienteNotificacion,
                'usuarios' => $usuarioNotificacion,
                'user_id' => $userId,
                'correos_enviados' => json_encode($correos),
            ]);

            $comunicado = Comunicado::create($request->all());

            //Ruta donde se guardan los documentos
            $fileBasePath = storage_path('app/public/comunicados');

            $documents = [
                'documento_uno',
                'documento_dos',
            ];

            //Valida documentos y los actualiza
            foreach ($documents as $documentPath) {
                $this->load_file_create($request, $documentPath, $fileBasePath, $comunicado->id);
            }

            foreach ($correos as $correo) {
                Mail::send('emails.comunicado', [
                    'comunicado' => $request->comunicado,
                ], function ($message) use ($correo, $comunicado) {
                    $message->to($correo)->subject('Balanty Consultores te cuenta 🔔 - Comunicado N°' . $comunicado->id);

                    // Lista de campos de documentos
                    $camposDocumentos = [
                        'documento_uno',
                        'documento_dos',
                    ];

                    $comunicado = Comunicado::find($comunicado->id);
                    foreach ($camposDocumentos as $campo) {
                        if (!empty($comunicado->$campo)) {
                            $ruta = storage_path('app/public/comunicados/' . $campo . '/' . $comunicado->$campo);
                            if (file_exists($ruta)) {
                                $message->attach($ruta, [
                                    'as' => basename($ruta), // nombre del archivo
                                ]);
                            }
                        }
                    }
                });
            }
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['message' => 'Ocurrió un error al enviar el comunicado: ' . $e->getMessage(), 'color' => 'danger'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function load_file_create($request, $path, $basePath, $comunicado)
    {

        if ($request->file($path)) {
            $file = $request->file($path);
            $filename = uniqid() . '-' . date('Y-m-d') . '.' . $file->getClientOriginalExtension();
            $fullPath = $basePath . '/' . $path . '/' . $filename;

            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            $file->move($basePath . '/' . $path, $filename);
            Comunicado::where('id', $comunicado)->update([$path => $filename]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comunicado = Comunicado::find($id);

        $clientes = json_decode($comunicado->clientes);
        if ($comunicado->clientes != 'null' && $comunicado->clientes) {
            $clientesNombres = Empresa::whereIn('id', $clientes)->pluck('razon_social')->toArray();
            $comunicado->clientes = implode(', ', $clientesNombres);
        }

        $usuarios = json_decode($comunicado->usuarios);
        if ($comunicado->usuarios != 'null' && $comunicado->usuarios) {
            $usuariosNombres = Empresa::whereIn('id', $usuarios)->pluck('razon_social')->toArray();
            $comunicado->usuarios = implode(', ', $usuariosNombres);
        }

        $correos = json_decode($comunicado->correos_enviados);
        $comunicado->correos_enviados = implode(', ', $correos);

        $docList = [];

        if ($comunicado->documento_uno) {
            $docList['documento_uno'] = 'storage/comunicados/documento_uno/' . $comunicado->documento_uno;
        }
        if ($comunicado->documento_dos) {
            $docList['documento_dos'] = 'storage/comunicados/documento_dos/' . $comunicado->documento_dos;
        }

        return view('admin.comunicados.show', compact('comunicado', 'docList'));
    }
}
