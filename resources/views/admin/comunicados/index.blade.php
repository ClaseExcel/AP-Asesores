@extends('layouts.admin')
@section('title', 'Comunicados')
@section('library')
    @include('cdn.datatables-head')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <style>
        .cursor-pointer {
            cursor: help;
        }

        .select2 {
            width: 100% !important;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-list"></i> Lista de comunicados
                </div>

                <div class="card-body">
                    <div class="">
                        <table class="table-bordered table-striped display nowrap compact" id="datatable-Comunicados"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Clientes:</th>
                                    <th>Usuarios:</th>
                                    <th>Correos:</th>
                                    <th>Usuario que notifica:</th>
                                    <th>Fecha de envió:</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @can('CREAR_COMUNICADOS')
            <div class="col-12 col-xl-6">
                <form action="{{ route('admin.comunicados.store') }}" method="POST" enctype="multipart/form-data"
                    id="crear-comunicado">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-plus-circle"></i> Nuevo Comunicado
                        </div>

                        <div class="card-body row">
                            <div class="col-12 col-xl-12">
                                <div class="form-floating mb-3">
                                    <select name="tipo" id="tipoSelect" class="form-select">
                                        <option value="">Selecciona una opción</option>
                                        <option value="1"> Clientes</option>
                                        <option value="2"> Usuarios</option>
                                    </select>
                                    <label for="tipo" class="fw-normal">Comunicado para <b
                                            class="text-danger">*</b>:</label>
                                    <span id="tipo" class="text-danger"></span>
                                </div>

                            </div>

                            <div class="col-12 col-md-12" id="usuarios-select" style="display: none;">
                                <div class="form-floating mb-3">
                                    <div class="row d-flex justify-content-between ">
                                        <div class="col-12">
                                            <label class="fw-normal">
                                                Seleccionar uno o varios usuarios: <b class="text-danger">*</b>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <div class="btn-group mb-2">
                                                <button id="selectAllButton5" type="button"
                                                    class="btn btn-outline-info btn-xs  btn-radius px-4 me-2"
                                                    style="border-radius: 5px">Seleccionar Todo</button>
                                                <button id="deselectAllButton5" type="button"
                                                    class="btn btn-outline-info btn-xs btn-radius px-4 "
                                                    style="border-radius: 5px">Deseleccionar Todo</button>
                                            </div>
                                        </div>
                                    </div>
                                    <select id="multiple-checkboxes5" multiple="multiple"
                                        class="form-select custom-select-border py-4" name="usuarios[]" data-dropup="true"
                                        data-container="body">
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}">
                                                {{ $usuario->nombres . ' ' . $usuario->apellidos }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="usuarios" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="col-12 col-md-12" id="clientes-select" style="display: none;">
                                <div class="form-floating mb-3">
                                    <div class="row d-flex justify-content-between ">
                                        <div class="col-12">
                                            <label class="fw-normal">
                                                Seleccionar uno o varios clientes: <b class="text-danger">*</b>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <div class="btn-group mb-2">
                                                <button id="selectAllButton4" type="button"
                                                    class="btn btn-outline-info btn-xs  btn-radius px-4 me-2"
                                                    style="border-radius: 5px">Seleccionar Todo</button>
                                                <button id="deselectAllButton4" type="button"
                                                    class="btn btn-outline-info btn-xs btn-radius px-4 "
                                                    style="border-radius: 5px">Deseleccionar Todo</button>
                                            </div>
                                        </div>
                                    </div>
                                    <select id="multiple-checkboxes4" multiple="multiple"
                                        class="form-select custom-select-border w-100 py-4" name="clientes[]" data-dropup="true"
                                        data-container="body">
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">
                                                {{ $cliente->razon_social }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="clientes" class="text-danger"></span>
                                </div>
                            </div>

                            <div class=" col-xl-12 mb-3">
                                <label for="comunicado" class="fw-normal">Comunicado <b class="text-danger">*</b></label>
                                <textarea id="comunicado" name="comunicado" rows="1" class="form-control" style="height: 150px"></textarea>
                                <span id="error-comunicado" class="text-danger"></span>
                            </div>

                            <div class="col-12 col-xl-6">
                                <div class="input-group mb-3">
                                    <label class="input-group-text bg-transparent" for="documento_uno"><i
                                            class="fas fa-file-upload"></i></label>
                                    <input type="file" id="documento_uno" name="documento_uno" class="form-control" />
                                </div>
                            </div>

                            <div class="col-12 col-xl-6">
                                <div class="input-group mb-3">
                                    <label class="input-group-text bg-transparent" for="documento_dos"><i
                                            class="fas fa-file-upload"></i></label>
                                    <input type="file" id="documento_dos" name="documento_dos" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group text-end">
                                <button class="btn btn-save btn-radius px-4" type="submit" id="btn-guardar-comunicado">
                                    <i class="fa-solid fa-paper-plane"></i> Enviar
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        @endcan
    </div>




@endsection


@section('scripts')
    @parent
    <script src="{{ asset('js/comunicados/comunicado.js') }}" defer></script>
    <script>
        let table;

        document.addEventListener("DOMContentLoaded", function() {
            table = new DataTable('#datatable-Comunicados', {
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
                    [0, 'desc']
                ],
                responsive: true,
                // columnDefs: [

                // ],
                // searching: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.comunicados.index') }}",
                dataType: 'json',
                type: "POST",
                columns: [{
                        data: 'id',
                        name: 'id',
                        visible: false,
                    },
                    {
                        data: 'clientes',
                        name: 'clientes',
                        className: 'cursor-pointer',
                    },
                    {
                        data: 'usuarios',
                        name: 'usuarios',
                    },
                    {
                        data: 'correos_enviados',
                        name: 'correos_enviados',
                    },
                    {
                        data: 'user.nombres',
                        name: 'user.nombres',
                        render: function(data, type, row) {
                            return row.user ? row.user.nombres + ' ' + row.user.apellidos : '';
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            return data ? moment(data).format('DD/MM/YYYY h:mm a') : '';
                        }
                    },
                    {
                        data: 'id',
                        name: 'ver',
                        render: function(data, type, row) {
                            let buttonInfo =
                                `<a class="btn-ver px-2 py-0" href="{{ url('admin/comunicados') }}/${data}" title="Ver más información">
                                    <i class="fas fa-eye"></i>
                                </a>`;

                            return buttonInfo;
                        },
                    }
                ],
                // select: {
                //     style: 'multi',
                //     className: 'selected-row',
                // },
                initComplete: function() {

                } //intiComplete

            });

        });
    </script>
@endsection
