@extends('layouts.admin')
@section('title', 'Agregar usuario')
@section('content')

    <div class="form-group">
        <a class="btn btn-back  border btn-radius px-4" href="{{ route('admin.users.index') }}">
            <i class="fas fa-arrow-circle-left"></i> Atrás
        </a>
    </div>
    <div class="row">
        <form method="POST" action="{{ route('admin.users.store') }}" class="row" enctype="multipart/form-data">
            @csrf
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-plus"></i> Agregar usuario
                    </div>

                    <div class="card-body"
                        style="max-height:680px; overflow-y:auto; scroll-behavior:smooth;scrollbar-width: thin;">
                        <div class="row">
                            @include('admin.users.fields')
                        </div>
                        <div class="form-group text-end">
                            <button class="btn btn-save btn-radius px-4" type="submit">
                                <i class="fas fa-save"></i> Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-plus"></i> Información beneficiario
                    </div>

                    <div class="card-body"
                        style="max-height:680px; overflow-y:auto; scroll-behavior:smooth;scrollbar-width: thin;">
                        <div class="row">
                            <div class="col-12">
                                <span class="text-arco"><i class="fas fa-info-circle"></i> Elimina la
                                    información de acuerdo a opción deseleccionada.</span>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-floating mb-3">
                                    <div class="row d-flex justify-content-between ">
                                        <div class="col-12">
                                            <label class="fw-normal">
                                                Seleccionar uno o varios beneficiarios:
                                            </label>
                                        </div>
                                    </div>
                                    <select id="beneficiario" multiple="multiple" style="width:100%;"
                                        class="form-select {{ $errors->has('beneficiario') ? 'is-invalid' : '' }} custom-select-border w-100 py-4"
                                        name="beneficiario[]" data-dropup="true" data-container="body">
                                        @foreach ($beneficiario as $key => $beneficiario)
                                            <option value="{{ $key }}"
                                                {{ $user->beneficiario == 'null' || $user->beneficiario == null ? ' ' : (in_array($key, json_decode($user->beneficiario)) ? 'selected' : '') }}>
                                                {{ $beneficiario }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('beneficiario'))
                                        <span class="text-danger text-sm ">{{ $errors->first('beneficiario') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div id="inputs-beneficiario" class="row">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <script src="{{ asset('js/empleados/empleados.js') }}" defer></script>
@endsection
