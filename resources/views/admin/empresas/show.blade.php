@extends('layouts.admin')
@section('title', 'Ver empresa')
@section('library')
    @include('cdn.datatables-head')
@endsection
@section('content')

    <style>
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            color: #D0AA66;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }

        .nav-link {
            display: block;
            padding: .5rem 1rem;
            color: #000000;
            text-decoration: none;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
        }

        .nav-link:hover {
            display: block;
            padding: .5rem 1rem;
            color: #D0AA66;

            text-decoration: none;
        }
    </style>

    <div class="form-group">
        <a class="btn btn-back  border btn-radius px-4" href="{{ route('admin.empresas.index') }}">
            <i class="fas fa-arrow-circle-left"></i> Atrás
        </a>

        <a class="btn btn-back  border btn-radius px-4" href="{{ route('admin.empresas.edit', $empresa->id) }}">
            <i class="fas fa-pencil-alt"></i> Editar empresa
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-light">
                    <div class="row">
                        <div class="col-12 p-0 d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                                stroke="currentColor" width="30px">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                            <span class="fs-4">Información de la empresa</span>
                        </div>
                        <div class="col-12 py-0">
                            <hr style="height: 0 !important; width: 100%; border-top: 1px dashed rgb(215 215 215);">
                        </div>
                        <div class="col-xl-6 mb-3">
                            <span class="fs-5 text-help">{{ $empresa->razon_social }}</span> <br>
                            <small>{{ $empresa->tipo_identificacion }}</small><br>
                            <span class="fw-bold text-help-naranja">{{ $empresa->NIT . ' - ' . $empresa->dv }}</span>
                        </div>
                        <div class="col-xl-6 mb-3">
                            <div class="d-flex justify-content-end">
                                {!! $empresa->estado == '1'
                                    ? '<div class="alert-success py-1 px-2 rounded border text-center"><span style="font-family: monospace;"><b>ACTIVO</b></span></div>'
                                    : '<div class="alert-danger py-1 px-2 rounded border ><span style="font-family: monospace;"><b>INACTIVO</b></span></div>' !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="max-height:330px; overflow-y:auto; scroll-behavior:smooth;">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <span>Correo eléctronico <span
                                    class="fw-semibold">{{ $empresa->correo_electronico }}</span></span><br>
                            <span>Número de contacto <span
                                    class="fw-semibold">{{ $empresa->numero_contacto }}</span></span><br>
                            <span>Dirección fisica <span class="fw-semibold">{{ $empresa->direccion_fisica }}</span></span>
                            <br>
                            <span>Ciudad <span
                                    class="fw-semibold">{{ $empresa->ciudad ? $empresa->ciudad : 'Sin información' }}</span></span>
                        </div>
                    </div>
                    <div class="col-12 py-0">
                        <hr style="height: 0 !important; width: 100%; border-top: 1px dashed rgb(215 215 215);">
                    </div>
                    @if ($empresa->nombres_usuario_certificado)
                        <div class="row mb-3">
                            <span class="text-help fs-5">Usuario certificados</span>
                            <span class="fw-normal">Nombres completos de usuario certificados
                                <b>{{ $empresa->nombres_usuario_certificado }}</b></span><br>
                            <span class="fw-normal">Cargo de usuario certificados
                                <b>{{ $empresa->cargo_usuario_certificado }}</b></span><br>
                            <span class="fw-normal">Télefono de usuario certificados
                                <b>{{ $empresa->telefono_usuario_certificado }}</b></span><br>
                            <span class="fw-normal">Correo de usuario certificados
                                <b>{{ $empresa->correo_usuario_certificado }}</b></span><br>
                        </div>
                    @endif

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-azul shadow-none" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                                    aria-controls="collapseOne">
                                    Obligaciones tributarias DIAN
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body"
                                    style="max-height:260px; overflow-y:auto; scroll-behavior:smooth;">
                                    @if ($obligaciones)
                                        <table class="table-sm table-bordered table-striped w-100" id="obligacionesDian">
                                            <thead>
                                                <tr>
                                                    <th width="15%"><i
                                                            class="fa-regular fa-rectangle-list"></i>&nbsp;Código
                                                    </th>
                                                    <th> Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($obligaciones as $item)
                                                    <tr>
                                                        <td class="text-end">{{ $item['codigo'] }}</td>
                                                        <td>{{ $item['nombre'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-center py-4"> <i class="fas fa-circle-info"></i> No tiene
                                            ningúna obligación.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-azul shadow-none" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Declaración de industria y comercio
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body"
                                    style="max-height:260px; overflow-y:auto; scroll-behavior:smooth;">
                                    @if (!empty($empresa->codigo_obligacionmunicipal))
                                        <table class="table-sm table-bordered table-striped w-100"
                                            id="departamentoMunicipioTable">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th width="15%"><i
                                                            class="fa-regular fa-rectangle-list"></i>&nbsp;Código
                                                    </th>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($empresa->codigo_obligacionmunicipal))
                                                    @foreach ($obligacionesMunicipales as $item)
                                                        <tr>
                                                            <td class="text-end">{{ $item['codigo'] }}</td>
                                                            <td>{{ $item['nombre'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-center py-4"> <i class="fas fa-circle-info"></i> No tiene
                                            ningúna declaración
                                            de industria y comercio.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-azul shadow-none" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Cámara de comercio principal
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body"
                                    style="max-height:260px; overflow-y:auto; scroll-behavior:smooth;">
                                    @if (!empty($empresa->camaracomercio_id))
                                        <table class="table-sm table-bordered table-striped w-100"
                                            id="departamentoMunicipioTable">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th width="15%"><i
                                                            class="fa-regular fa-rectangle-list"></i>&nbsp;Código
                                                    </th>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($empresa->camaracomercio_id))
                                                    <tr>
                                                        <td class="text-end">
                                                            {{ $camaraComercioPrincipal->id }}
                                                        </td>
                                                        <td>{{ $camaraComercioPrincipal->nombre }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-center py-4"> <i class="fas fa-circle-info"></i> No
                                            tiene
                                            ningún código de
                                            camara de comercio.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-azul shadow-none" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    Cámaras de comercio establecimientos de comercio
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body"
                                    style="max-height:260px; overflow-y:auto; scroll-behavior:smooth;">
                                    @if (!empty($empresa->camara_comercio_establecimientos))
                                        <table class="table-sm table-bordered table-striped w-100"
                                            id="departamentoMunicipioTable">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th width="15%"><i
                                                            class="fa-regular fa-rectangle-list"></i>&nbsp;Código
                                                    </th>
                                                    <th>Descripción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($empresa->camara_comercio_establecimientos))
                                                    @foreach ($camaraComercio as $item)
                                                        <tr>
                                                            <td class="text-end">{{ $item['id'] }}</td>
                                                            <td>{{ $item['nombre'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-center py-4"> <i class="fas fa-circle-info"></i> No
                                            tiene
                                            ningún código de
                                            camara de cormercio.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($users)
                        <div class="col-12">
                            <hr style="height: 0 !important; width: 100%; border-top: 1px dashed rgb(215 215 215);">
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <span class="fs-5 text-help"><i class="fa-solid fa-people-group"></i>
                                    Empleados</span>
                            </div>

                            <table class="display w-100">
                                @foreach ($users as $item)
                                    <tr>
                                        <td>
                                            <span>{{ $item->nombre_completo }}</span> <br>
                                            <span class="text-secondary">{{ $item->role->title }}</span>
                                        </td>
                                        <td style="width: 10%;">
                                            {!! $item->estado == 'ACTIVO'
                                                ? '<div class="alert-success py-1 px-2 rounded-pill border text-center"><span style="font-family: monospace;"><b>ACTIVO</b></span></div>'
                                                : '<div class="alert-danger py-1 px-2 rounded-pill border ><span style="font-family: monospace;"><b>INACTIVO</b></span></div>' !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            @if ($docList)
                <div class="col mb-5">
                    <div class="card">
                        <div class="card-header text-center bg-help fs-6">
                            <i class="fas fa-paperclip"></i> Documentos adjuntos
                        </div>
                        <div class="card-body p-0" style="max-height:250px; overflow-y:auto; scroll-behavior:smooth;">
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
                                                            <img src="{{ asset($docName) }}" alt=""
                                                                width="100%" style="max-width: 750px;"">
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

                        </div>

                        <div class="card-footer bg-transparent border-0">

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="adicional-tab" data-bs-toggle="tab"
                                data-bs-target="#adicional-tab-pane" type="button" role="tab"
                                aria-controls="adicional-tab-pane" aria-selected="true">Información adicional</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="obligaciones-requerimiento-tab" data-bs-toggle="tab"
                                data-bs-target="#obligaciones-requerimiento-tab-pane" type="button" role="tab"
                                aria-controls="obligaciones-requerimiento-tab-pane" aria-selected="false">Requermientos
                                obligaciones</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="adicional-tab-pane" role="tabpanel"
                            aria-labelledby="adicional-tab" tabindex="0">
                            <div class="card-body responsive">
                                <table class="table-bordered table-striped display nowrap compact"
                                    id="datatable-Adicional" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="20%">
                                                Descripción
                                            </th>
                                            <th width="20%">
                                                Información
                                            </th>
                                            <th width="20%"></th>
                                            <th width="20%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Cédula</td>
                                            <td>{!! $empresa->Cedula ? $empresa->Cedula : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Correos secundarios</td>
                                            <td>
                                                @if (!empty($empresa->correos_secundarios))
                                                    <span title="{{ $empresa->correos_secundarios }}">
                                                        {{ Str::limit($empresa->correos_secundarios, 50, '...') }}
                                                    </span>
                                                @else
                                                    <span class="fst-italic text-secondary">Sin información</span>
                                                    <!-- Opcional: Puedes dejar esto vacío o poner un texto alternativo -->
                                                @endif
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>CIIU</td>
                                            <td>{!! $empresa->ciiu
                                                ? implode(', ', $empresa->ciiu != 'null' && $empresa->ciiu != null ? json_decode($empresa->ciiu) : [])
                                                : '<span class="fst-italic text-secondary">Sin información</span>' !!}
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Código CIIU para municipios</td>
                                            <td>{!! $empresa->ciiu_municipios
                                                ? $empresa->ciiu_municipios
                                                : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>SIGLA</td>
                                            <td>{!! $empresa->sigla ? $empresa->sigla : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Contraseña DIAN</td>
                                            <td>{!! $empresa->contrasenadian
                                                ? $empresa->contrasenadian
                                                : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Pregunta DIAN</td>
                                            <td>{!! $empresa->preguntadian
                                                ? $empresa->preguntadian
                                                : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Firma electrónica DIAN</td>
                                            <td>{!! $empresa->firmadian ? $empresa->firmadian : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php $usuariosCC = json_decode($empresa->usuario_camaracomercio);
                                        $clavesCC = json_decode($empresa->camaracomercioclaveportal); ?>
                                        @if ($usuariosCC)
                                            @foreach ($usuariosCC as $index => $usuarioCC)
                                                <tr>
                                                    <td>Usuario cámara de comercio</td>
                                                    <td>{{ $usuarioCC }}</td>
                                                    <td>Contraseña cámara de comercio</td>
                                                    <td>{{ $clavesCC[$index] ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td>Cámara comercio firma</td>
                                            <td>{!! $empresa->firmacamaracomercio
                                                ? $empresa->firmacamaracomercio
                                                : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php $usuarios = json_decode($empresa->usuario_ica);
                                        $claves = json_decode($empresa->icaclaveportal); ?>

                                        @if ($usuarios)
                                            @foreach ($usuarios as $index => $usuario)
                                                <tr>
                                                    <td>Usuario ICA</td>
                                                    <td>{{ $usuario }}</td>
                                                    <td>ICA contraseña portal</td>
                                                    <td>{{ $claves[$index] ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>Usuario ICA</td>
                                                <td><span class="fst-italic text-secondary">Sin información</span></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                        <?php $usuariosEPS = json_decode($empresa->usuario_eps);
                                        $clavesEPS = json_decode($empresa->usuario_clave_eps); ?>
                                        @if ($usuariosEPS)
                                            @foreach ($usuariosEPS as $index => $usuarioEPS)
                                                <tr>
                                                    <td>Usuario EPS</td>
                                                    <td>{{ $usuarioEPS }}</td>
                                                    <td>Contraseña EPS</td>
                                                    <td>{{ $clavesEPS[$index] ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <?php $usuariosAFP = json_decode($empresa->usuario_afp);
                                        $clavesAFP = json_decode($empresa->clave_afp); ?>
                                        @if ($usuariosAFP)
                                            @foreach ($usuariosAFP as $index => $usuarioAFP)
                                                <tr>
                                                    <td>Usuario AFP</td>
                                                    <td>{{ $usuarioAFP }}</td>
                                                    <td>Contraseña AFP</td>
                                                    <td>{{ $clavesAFP[$index] ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <?php $usuariosPILA = json_decode($empresa->usuario_pila);
                                        $clavesPILA = json_decode($empresa->clave_pila); ?>
                                        @if ($usuariosPILA)
                                            @foreach ($usuariosPILA as $index => $usuarioPILA)
                                                <tr>
                                                    <td>Usuario Operador de PILA</td>
                                                    <td>{{ $usuarioPILA }}</td>
                                                    <td>Contraseña Operador de PILA</td>
                                                    <td>{{ $clavesPILA[$index] ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td>ARL</td>
                                            <td>{!! $empresa->arl ? $empresa->arl : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Clave ARL</td>
                                            <td>{!! $empresa->clavearl ? $empresa->clavearl : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>APORTES - enlace operativo</td>
                                            <td>{!! $empresa->aportes ? $empresa->aportes : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>CCF</td>
                                            <td>{!! $empresa->ccf ? $empresa->ccf : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Usuario/clave EPS</td>
                                            <td>{!! $empresa->usuario_clave_eps
                                                ? $empresa->usuario_clave_eps
                                                : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Usuario/clave UGPP</td>
                                            <td>{!! $empresa->usuario_clave_ugpp
                                                ? $empresa->usuario_clave_ugpp
                                                : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Usuario FACT/nómina electrónica</td>
                                            <td>{!! $empresa->usuario_fac_nomina
                                                ? $empresa->usuario_fac_nomina
                                                : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Usuario sistema contable</td>
                                            <td>{!! $empresa->usuario_sistema_contable
                                                ? $empresa->usuario_sistema_contable
                                                : '<span class="fst-italic text-secondary">Sin información</span>' !!}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="obligaciones-requerimiento-tab-pane" role="tabpanel"
                            aria-labelledby="obligaciones-requerimiento-tab" tabindex="0">
                            <div class="card-body">
                                <table class="table-bordered table-striped display nowrap compact"
                                    id="datatable-Adicional1" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="50%">
                                                Descripción
                                            </th>
                                            <th>
                                                Información
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clasificaciones as $clasificacion)
                                            <tr>
                                                <td><b>Año</b></td>
                                                <td>{{ $clasificacion->anio }}</td>
                                            </tr>
                                            <tr>
                                                <td>¿Pertenece al régimen simple de tributación? </td>
                                                <td>{{ $clasificacion->regimen_simple_tributacion }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ingresos gravados </td>
                                                <td>${{ number_format($clasificacion->ingresos_gravados, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ingresos exentos </td>
                                                <td>${{ number_format($clasificacion->ingresos_exentos, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ingresos excluidos </td>
                                                <td>${{ number_format($clasificacion->ingresos_excluidos, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ingresos no gravados </td>
                                                <td>${{ number_format($clasificacion->ingresos_no_gravados, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Devoluciones </td>
                                                <td>${{ number_format($clasificacion->devoluciones, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total ingresos </td>
                                                <td>${{ number_format($clasificacion->total_ingresos, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Actividad 1 </td>
                                                <td>{{ $clasificacion->actividad_1 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Actividad 2 </td>
                                                <td>{{ $clasificacion->actividad_2 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Actividad 3 </td>
                                                <td>{{ $clasificacion->actividad_3 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Actividad 4 </td>
                                                <td>{{ $clasificacion->actividad_4 }}</td>
                                            </tr>
                                            <tr>
                                                <td>¿Realiza operaciones exentas? </td>
                                                <td>{{ $clasificacion->operaciones_excentas }}</td>
                                            </tr>
                                            <tr>
                                                <td>¿Realiza actividades de exportación o
                                                    importación? </td>
                                                <td>{{ $clasificacion->actividades_exp_imp }}</td>
                                            </tr>
                                            <tr>
                                                <td>¿Es gran contribuyente? </td>
                                                <td>{{ $clasificacion->gran_contribuyente }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ingresos brutos fiscales del
                                                    año anterior </td>
                                                <td>${{ number_format($clasificacion->ingresos_brutos_fiscales_anio_anterior, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>¿Debe presentar el formato de conciliación
                                                    fiscal? </td>
                                                <td>{{ $clasificacion->formato_conciliacion_fiscal }}</td>
                                            </tr>
                                            <tr>
                                                <td>Activos brutos a diciembre
                                                    31 del año anterior</td>
                                                <td>${{ number_format($clasificacion->activos_brutos_diciembre_anio_anterior, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ingresos brutos a diciembre
                                                    31 del año anterior </td>
                                                <td>${{ number_format($clasificacion->ingreso_brutos_diciembre_anio_anterior, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>¿Está obligado a tener revisor fiscal? </td>
                                                <td>{{ $clasificacion->revisor_fiscal }}</td>
                                            </tr>
                                            <tr>
                                                <td>Patrimonio bruto a
                                                    diciembre 31 del año anterior</td>
                                                <td>${{ number_format($clasificacion->patrimonio_brutos_diciembre_anio_anterior, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Ingresos brutos a
                                                    diciembre del 31 año anterior </td>
                                                <td>${{ number_format($clasificacion->ingreso_brutos_tributario_diciembre_anio_anterior, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>¿Las declaraciones tributarias deben ser firmadas por
                                                    el contador? </td>
                                                <td>{{ $clasificacion->declaracion_tributaria_firma_contador }}</td>
                                            </tr>
                                        @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        function toggleDiv(divId) {
            var div = document.getElementById(divId);
            if (div.style.display === "none") {
                div.style.display = "block";
            } else {
                div.style.display = "none";
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            table = new DataTable('#datatable-Adicional', {
                language: {
                    url: "{{ asset('/js/datatable/Spanish.json') }}",
                },
                layout: {
                    topStart: ['search'],
                    topEnd: ['pageLength'],
                    bottomEnd: {
                        paging: {
                            type: 'simple_numbers',
                            numbers: 5,
                        }
                    }
                },
                ordering: true,
                //ordenar por la columna 0 de forma ascendente
                order: [
                    [5, 'desc']
                ],
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            table = new DataTable('#datatable-Adicional1', {
                language: {
                    url: "{{ asset('/js/datatable/Spanish.json') }}",
                },
                layout: {
                    topStart: ['search'],
                    topEnd: ['pageLength'],
                    bottomEnd: {
                        paging: {
                            type: 'simple_numbers',
                            numbers: 5,
                        }
                    }
                },
                ordering: true,
                //ordenar por la columna 0 de forma ascendente
                order: [
                    [5, 'desc']
                ],
            });
        });
    </script>
@endsection
