@extends('layouts.admin')
@section('title', 'Actualizar empleado')
@section('content')

    <div class="form-group">
        <a class="btn btn-back  border btn-radius px-4" href="{{ route('admin.empleados.index') }}">
            <i class="fas fa-arrow-circle-left"></i> Atrás
        </a>
    </div>


    <div class="row">
        <form method="POST" action="{{ route('admin.empleados.update', $empleado->user_id) }}" class="row">
            @csrf
            @method('PUT')
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user-plus"></i> Actualizar empleado
                    </div>

                    <div class="card-body">


                        @include('admin.empleados.fields')

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
                                <span class="text-arco"><i class="fas fa-info-circle"></i> Deselecciona y elimina la
                                    información de acuerdo a opción seleccionada.</span>
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
                                            @if ($empleado->usuarios == 'null' && $empleado->usuarios == null)
                                                <option value="{{ $key }}"
                                                    {{ in_array($key, json_decode($empleado->usuarios->beneficiario)) ? 'selected' : '' }}>
                                                    {{ $beneficiario }}
                                                </option>
                                            @else
                                                <option value="{{ $key }}">
                                                    {{ $beneficiario }}
                                                </option>
                                            @endif
                                        @endforeach

                                    </select>
                                    @if ($errors->has('beneficiario'))
                                        <span class="text-danger text-sm ">{{ $errors->first('beneficiario') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div id="inputs-beneficiario" class="row">
                                    @if ($empleado->usuarios->informacion_beneficiario)
                                        @foreach ($informacion_beneficiarios as $index => $informacion)
                                            @php $index = intval($index) + 1; @endphp

                                            <div class="col-12 informacion_beneficiario">
                                                <div class="form-floating mb-3">
                                                    <select name="tipo_identificacion{{ $index }}"
                                                        class="form-select input-beneficiario">
                                                        @foreach ($tipos_identificacion as $key => $tipo)
                                                            <option value="{{ $key }}"
                                                                {{ old('tipo_identificacion', $informacion->tipo_identificacion) == $key ? 'selected' : '' }}>
                                                                {{ $tipo }} </option>
                                                        @endforeach
                                                    </select>
                                                    <label for="frecuencias" class="fw-normal">Tipo de
                                                        identificación</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="numero{{ $index }}"
                                                        value="{{ $informacion->numero }}">
                                                    <label class="fw-normal" id="label-beneficiario">Número </label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="nombres{{ $index }}"
                                                        value="{{ $informacion->nombres }}">
                                                    <label class="fw-normal" id="label-beneficiario">Nombre y apellidos
                                                    </label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input class="form-control" type="text" placeholder=""
                                                        name="parentesco{{ $index }}"
                                                        value="{{ $informacion->parentesco }}">
                                                    <label class="fw-normal" id="label-beneficiario">Parentesco </label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="date" name="fecha_nacimiento{{ $index }}"
                                                        value="{{ $informacion->fecha_nacimiento }}" class="form-control"
                                                        placeholder="" />
                                                    <label class="fw-normal">Fecha de
                                                        nacimiento</label>
                                                </div>

                                                <div class="row ml-2">
                                                    <div class="col-xl-2">
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input"
                                                                name="funeraria{{ $index }}" type="checkbox"
                                                                value="{{ $informacion->funeraria }}"
                                                                {{ $informacion->funeraria == 'SI' ? 'checked' : '' }}
                                                                id="funeraria{{ $index }}">
                                                            <label class="form-check-label" for="funeraria">
                                                                ¿Funeraria?
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-1">
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" name="eps{{ $index }}"
                                                                type="checkbox" value="{{ $informacion->eps }}"
                                                                {{ $informacion->eps == 'SI' ? 'checked' : '' }}
                                                                id="eps{{ $index }}">
                                                            <label class="form-check-label" for="funeraria">
                                                                EPS
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4">
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input"
                                                                name="caja_compensacion{{ $index }}"
                                                                type="checkbox"
                                                                value="{{ $informacion->caja_compensacion }}"
                                                                {{ $informacion->caja_compensacion == 'SI' ? 'checked' : '' }}
                                                                id="caja_compensacion{{ $index }}">
                                                            <label class="form-check-label" for="caja_compensacion">
                                                                Caja de compensación
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 py-0">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove">Eliminar</button>
                                                    <hr
                                                        style="height: 0 !important; width: 100%; border-top: 1px dashed rgb(215 215 215);">
                                                </div>

                                                <script>
                                                    var index = {{ $index }};

                                                    document.getElementById('funeraria' + index).addEventListener('change', function() {
                                                        if (this.checked) {
                                                            this.value = 'SI';
                                                        } else {
                                                            this.value = '';
                                                        }
                                                    })

                                                    document.getElementById('eps' + index).addEventListener('change', function() {
                                                        if (this.checked) {
                                                            this.value = 'SI';
                                                        } else {
                                                            this.value = '';
                                                        }
                                                    })

                                                    document.getElementById('caja_compensacion' + index).addEventListener('change', function() {
                                                        if (this.checked) {
                                                            this.value = 'SI';
                                                        } else {
                                                            this.value = '';
                                                        }
                                                    })
                                                </script>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <script src="{{ asset('js/empleados/empleados.js') }}" defer></script>
@endsection
