@extends('layouts.admin')
@section('title', ' Info: ' . $empleado_cliente->nombres . ' ' . $empleado_cliente->apellidos)
@section('content')

    <div class="form-group">
        <a class="btn  btn-back  border btn-radius px-4" href="{{ route('admin.empleados.index') }}">
            <i class="fas fa-arrow-circle-left"></i> Atrás
        </a>

        <a class="btn btn-back  border btn-radius px-4" href="{{ route('admin.empleados.edit', $user->id) }}">
            <i class="fas fa-pencil-alt"></i> Editar empleado
        </a>
    </div>

    <div class="row">
        <div class="col-xl-8">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-arco">
                            <span class="fs-5 mb-3">Información del empleado</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <span class="fs-5">{{ $user->nombres }} {{ $user->apellidos }}</span> <br>
                                    <span class="fs-6 fw-bold">{{ $user->cedula }}</span> <br>
                                    <span>{{ $empleado_cliente->empresas->razon_social }}</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="badge bg-arco-yellow text-uppercase"> {{ $user->role->title }} </span>
                                    <span class="badge {{ $user->estado == 'ACTIVO' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $user->estado }} </span> <br>
                                    <span
                                        class="fst-italic">{{ \Carbon\Carbon::parse($user->fecha_nacimiento)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}</span><br>
                                </div>
                            </div>


                            <hr style="height: 0 !important; width: 100%; border-top: 1px dashed rgb(215 215 215);">


                            <div class="row d-flex align-items-center">
                                <div class="col-xl-4">
                                    <span class="text-arco">Salario</span><br>
                                    <span class="fs-5 fst-italic">${{ number_format($user->salario, 0, ',', '.') }}</span>
                                </div>
                                <div class="col-xl-4">
                                    <span class="text-arco">Fecha de inicio de contrato </span><br>
                                    <span class="fs-5 fst-italic">{{ $user->fecha_contrato }}</span>

                                </div>
                                <div class="col-xl-4">
                                    <span class="text-arco">Fecha de ingreso </span><br>
                                    <span class="fs-5 fst-italic">{{ $user->fecha_ingreso }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body d-flex flex-column">
                            <div class="row">
                                <div class="col auto">
                                    <b>Nivel de riesgo</b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->nivel_riesgo }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col auto">
                                    <b>¿Funeraria? </b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->funeraria ? $user->funeraria : 'NO' }}
                                </div>
                            </div>

                            <hr style="height: 0 !important; width: 100%; border-top: 1px dashed rgb(215 215 215);">

                            <div class="row">
                                <div class="col auto">
                                    <b> Correo eléctronico</b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col auto">
                                    <b>Correos secundarios</b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $empleado_cliente->correos_secundarios }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col auto">
                                    <b> Número contacto</b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->numero_contacto }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col auto">
                                    <b> Dirección</b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->direccion }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col auto">
                                    <b>Barrio</b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->barrio }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body d-flex flex-column">
                            <div class="row">
                                <div class="col auto">
                                    <b>Empresas secundarias</b>
                                </div>
                                <div class="col auto text-end">
                                    @foreach ($empresas_secundarias as $index => $empresa)
                                        <span>{{ $empresa['razon_social'] }}@if ($index < count($empresas_secundarias) - 1)
                                                ,
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col auto">
                                    <b>Tipo de contrato</b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->tipo_contrato }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col auto">
                                    <b>EPS </b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->EPS }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col auto">
                                    <b>Contraseña EPS </b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->contrasena_eps }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col auto">
                                    <b>Fondo de pensión </b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->fondo_pension }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col auto">
                                    <b>Caja de compensación </b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->caja_compensacion }}
                                </div>
                            </div>

                            <hr style="height: 0 !important; width: 100%; border-top: 1px dashed rgb(215 215 215);">

                            <div class="row">
                                <div class="col auto">
                                    <b>Fecha de retiro </b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->fecha_retiro ? $user->fecha_retiro : 'Sin fecha de retiro' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col auto">
                                    <b>Censantías </b>
                                </div>
                                <div class="col auto text-end">
                                    {{ $user->cesantias }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            @if ($docList)
                <div class="col-12 mb-5">
                    <div class="card" style="height: 300px">
                        <div class="card-header text-center bg-transparent text-dark fs-6">
                            <i class="fas fa-paperclip"></i> Documentos adjuntos
                        </div>
                        <table class="table table-hover table-sm">
                            <tbody>
                                @foreach ($docList as $key => $docName)
                                    <tr>
                                        <td class="pl-4 border border-top-0 border-left-0 border-right-0">
                                            {{ basename($docName) }}
                                        </td>
                                        <td class=" border border-top-0 border-left-0 border-right-0 text-center">

                                            {{-- Descarga directa si la extensión es zip o rar --}}
                                            @if (pathinfo($docName, PATHINFO_EXTENSION) == 'zip' ||
                                                    pathinfo($docName, PATHINFO_EXTENSION) == 'rar' ||
                                                    pathinfo($docName, PATHINFO_EXTENSION) == 'xlsx' ||
                                                    pathinfo($docName, PATHINFO_EXTENSION) == 'xls')
                                                <a type="button" class="btn-ver px-3" href="{{ asset($docName) }}"
                                                    download>
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @else
                                                <!-- Button trigger modal -->
                                                <a type="button" class="btn-ver px-3" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $key }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif


                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $key }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Documento
                                                        {{ basename($docName) }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-0 d-flex justify-content-center">

                                                    @if (pathinfo($docName, PATHINFO_EXTENSION) == 'pdf')
                                                        <iframe src="{{ asset($docName) }}"
                                                            style="width:100%;height:637px;" frameborder="0">
                                                        </iframe>
                                                    @else
                                                        <img src="{{ asset($docName) }}"alt="" width="100%"
                                                            style="max-width: 750px;"">
                                                    @endif

                                                </div>
                                                <div class="modal-footer border-0">
                                                    <a class="btn btn-save text-white shadow-none mx-auto"
                                                        href="{{ asset($docName) }}" download>
                                                        <i class="fas fa-arrow-alt-circle-down"></i>
                                                        Descargar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="card-footer bg-transparent border-0">

                        </div>
                    </div>
                </div>
            @endif
        </div>

        <style>
            .max-text-resume {
                height: 380px;
                overflow-y: auto;
                overflow-x: hidden;
                scroll-behavior: smooth;
                /* cambiar color scroll bar a azul */
                scrollbar-width: thin;
            }
        </style>
        @if ($docListLlamados)
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-circle-exclamation"></i> Llamados de atención
                    </div>
                    <div class="card-body max-text-resume">
                        <table class="table table-hover table-sm">
                            <tbody>
                                @foreach ($docListLlamados as $doc)
                                    <tr>
                                        <td class="pl-4 border border-top-0 border-left-0 border-right-0">
                                            {{ $doc['consecutivo'] }}
                                        </td>
                                        <td class="pl-4 border border-top-0 border-left-0 border-right-0">
                                            {{ $doc['asunto'] }}
                                        </td>
                                        <td class="pl-4 border border-top-0 border-left-0 border-right-0">
                                            {{ basename($doc['url_documento']) }}
                                        </td>
                                        <td class="pl-4 border border-top-0 border-left-0 border-right-0">
                                            {{ $doc['created_at'] }}
                                        </td>
                                        <td class=" border border-top-0 border-left-0 border-right-0 text-center">

                                            {{-- Descarga directa si la extensión es zip o rar --}}
                                            @if (pathinfo($doc['url_documento'], PATHINFO_EXTENSION) == 'zip' ||
                                                    pathinfo($doc['url_documento'], PATHINFO_EXTENSION) == 'rar' ||
                                                    pathinfo($doc['url_documento'], PATHINFO_EXTENSION) == 'xlsx' ||
                                                    pathinfo($doc['url_documento'], PATHINFO_EXTENSION) == 'xls')
                                                <a type="button" class="btn-ver px-3"
                                                    href="{{ asset($doc['url_documento']) }}" download>
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @else
                                                <!-- Button trigger modal -->
                                                <a type="button" class="btn-ver px-3" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $loop->index }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif


                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $loop->index }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Documento
                                                        {{ basename($doc['url_documento']) }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-0 d-flex justify-content-center">

                                                    @if (pathinfo($doc['url_documento'], PATHINFO_EXTENSION) == 'pdf')
                                                        <iframe src="{{ asset($doc['url_documento']) }}"
                                                            style="width:100%;height:637px;" frameborder="0">
                                                        </iframe>
                                                    @else
                                                        <img src="{{ asset($doc['url_documento']) }}"alt=""
                                                            width="100%" style="max-width: 750px;"">
                                                    @endif

                                                </div>
                                                <div class="modal-footer border-0">
                                                    <a class="btn btn-save text-white shadow-none mx-auto"
                                                        href="{{ asset($doc['url_documento']) }}" download>
                                                        <i class="fas fa-arrow-alt-circle-down"></i>
                                                        Descargar
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>



@endsection
