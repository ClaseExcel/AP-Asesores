<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ActionButtonTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\restablecerContrasena;
use App\Models\AdministradorasActiva;
use App\Models\Cargo;
use App\Models\LlamadoAtencion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UsersController extends Controller
{

    use ActionButtonTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('GESTIONAR_USUARIOS'), Response::HTTP_UNAUTHORIZED);

        if ($request->ajax()) {
            $users =  User::with('role')->select('users.*')->whereNotIn('role_id', [7])->withTrashed();

            return DataTables::of($users)
                ->addColumn('actions', function ($users) {
                    // Lógica para generar las acciones para cada registro de users
                    return $this->getActionButtons('admin.users', 'USUARIOS', $users->id, $users->estado);
                })
                ->rawColumns(['actions']) //para que se muestr el codigo html en la tabla
                ->make(true);
        }

        return view('admin.users.index');
    }

    public function create()
    {
        abort_if(Gate::denies('CREAR_USUARIOS'), Response::HTTP_UNAUTHORIZED);

        $cargo = Cargo::orderBy('nombre')->pluck('nombre', 'id');
        $roles = Role::orderBy('title')->whereNotIn('title', ['Cliente', 'Génerico'])->pluck('title', 'id');
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

        return view('admin.users.create', compact('roles', 'eps', 'afp', 'ccf', 'tipos_identificacion', 'cargo', 'beneficiario'),  ['user' => new User]);
    }

    public function store(StoreUserRequest $request)
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
        $request = $request->merge(['beneficiario' => str_replace(['\\', ''], '', $beneficiario)]);

        if ($request->fecha_retiro) {
            $request = $request->merge(['estado' => 'INACTIVO']);
            $request = $request->merge(['deleted_at' => Carbon::parse($request->fecha_retiro)->format('Y-m-d H:i:s')]);
        }
        $firma = $request->file('firma');

        try {
            Mail::to($request['email'])->send(new restablecerContrasena($request['email'], $request['password']));

            if ($firma == null) {
                $firmaName = 'default.jpg';
                $request['firma'] = $firmaName;
                $user = User::create($request->all());
            } else {
                // Generar un nombre único para el archivo
                $firmaName = Str::uuid() . '.' . $firma->extension();
                $firma->storeAs('users_firma', $firmaName, 'public');
                //guardar en usuario
                $user = User::create($request->all());
                $user->firma = $firmaName;
            }
        } catch (\Exception $e) {
            Log::error($e);
            session(['message' => 'Hubo un problema al enviar el correo, el usuario no ha sido creado', 'color' => 'warning']);
            return redirect()->route('admin.users.index');
        }

        $user->save();

        // Verifica si se proporciona un nuevo archivo PDF para 'rut'
        if ($request->hasFile('documento_examen')) {
            $file = $request->file('documento_examen');
            $filename =  'documento_examen' . "." . $file->getClientOriginalExtension();

            // Elimina el archivo anterior si existe
            if (file_exists(storage_path('app/public/' . $request->cedula . '/' . $filename))) {
                unlink(storage_path('app/public/' . $request->cedula . '/' . $filename));
            }
            // Mueve y guarda el nuevo archivo PDF
            $file->move(storage_path('app/public/' . $request->cedula . '/'), $filename);

            $user->documento_examen = $filename;
            $user->save();
        }

        if ($request->hasFile('documento_afiliacion')) {
            $file = $request->file('documento_afiliacion');
            $filename2 =  'documento_afiliacion' . "." . $file->getClientOriginalExtension();

            // Elimina el archivo anterior si existe
            if (file_exists(storage_path('app/public/' . $request->cedula . '/' . $filename2))) {
                unlink(storage_path('app/public/' . $request->cedula . '/' . $filename2));
            }
            // Mueve y guarda el nuevo archivo PDF
            $file->move(storage_path('app/public/' . $request->cedula . '/'), $filename2);

            $user->documento_afiliacion = $filename2;
            $user->save();
        }


        if ($request->hasFile('documento_contrato')) {
            $file = $request->file('documento_contrato');
            $filename3 =  'documento_contrato' . "." . $file->getClientOriginalExtension();

            // Elimina el archivo anterior si existe
            if (file_exists(storage_path('app/public/' . $request->cedula . '/' . $filename3))) {
                unlink(storage_path('app/public/' . $request->cedula . '/' . $filename3));
            }
            // Mueve y guarda el nuevo archivo PDF
            $file->move(storage_path('app/public/' . $request->cedula . '/'), $filename3);

            $user->documento_contrato = $filename3;
            $user->save();
        }



        if ($request->hasFile('documento_otros')) {
            $file = $request->file('documento_otros');
            $filename4 =  'documento_otros' . "." . $file->getClientOriginalExtension();

            // Elimina el archivo anterior si existe
            if (file_exists(storage_path('app/public/' . $request->cedula . '/' . $filename4))) {
                unlink(storage_path('app/public/' . $request->cedula . '/' . $filename4));
            }
            // Mueve y guarda el nuevo archivo PDF
            $file->move(storage_path('app/public/' . $request->cedula . '/'), $filename4);

            $user->documento_otros = $filename4;
            $user->save();
        }

        session(['message' => 'El usuario se ha creado exitosamente.', 'color' => 'success']);
        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {

        abort_if(Gate::denies('EDITAR_USUARIOS'), Response::HTTP_UNAUTHORIZED);

        $cargo = Cargo::orderBy('nombre')->pluck('nombre', 'id');
        $user = User::withTrashed()->find($id);
        $roles = Role::orderBy('title')->whereNotIn('title', ['Cliente', 'Génerico'])->pluck('title', 'id');
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
            'Compañero permanente',
            'Hijos/a',
            'Padre/madre',
            'Hijastro/tra',
        ];

        if ($user->informacion_beneficiario) {
            $informacion_beneficiarios = json_decode($user->informacion_beneficiario);
        } else {
            $informacion_beneficiarios = [];
        }


        $user->load('role');

        return view('admin.users.edit', compact('roles', 'user', 'eps', 'afp', 'ccf', 'tipos_identificacion', 'cargo', 'beneficiario', 'informacion_beneficiarios'));
    }

    public function update(UpdateUserRequest $request, $id)
    {

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

        $user = User::withTrashed()->find($id);
        $firma = $request->file('firma');
        if ($firma != null) {
            //obtener el nombre del firma del usuario
            $firmaName = $user->firma;

            //eliminar el firma anterior
            if ($firmaName != 'default.jpg') {
                //unlink de //storage public users-firma
                unlink(public_path('storage/users_firma/' . $firmaName));
            }
            // Generar un nombre único para el archivo
            $firmaName = Str::uuid() . '.' . $firma->extension();
            $firma->storeAs('users_firma', $firmaName, 'public');

            //reemplazar el firma  
            $user->firma = $firmaName;

            //actualizar el firma del usuario
            $user->update();
        }

        $user->update($request->except('firma'));

        if ($request->fecha_retiro) {
            $user->estado = 'INACTIVO';
            $user->deleted_at = Carbon::parse($request->fecha_retiro)->format('Y-m-d H:i:s');
        }

        $user->save();

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

        return redirect()->route('admin.users.index')->with('message', 'El usuario se ha editado exitosamente.')->with('color', 'success');;
    }

    public function show($id)
    {
        abort_if(Gate::denies('VER_USUARIOS'), Response::HTTP_UNAUTHORIZED);

        $user = User::withTrashed()->find($id);
        $documentosLlamados = LlamadoAtencion::where('empleado_id', $id)->get();
        $user->load('role');

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

        return view('admin.users.show', compact('user', 'docList', 'docListLlamados'));
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('ELIMINAR_USUARIOS'), Response::HTTP_UNAUTHORIZED);

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

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
