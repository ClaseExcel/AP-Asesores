@extends('layouts.admin')
@section('title', 'Generar documento')
@section('library')
    @include('cdn.datatables-head')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-file-arrow-down"></i> Generar documento
                </div>
                <div class="card-body">
                    <form class="row" action="{{ route('admin.generar-certificados.getDocumento') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <input type="number" id="cedula_empleado" name="cedula_empleado"
                                    value="{{ old('cedula_empleado', '') }}" class="form-control" placeholder="" required />
                                <label for="cedula_empleado" class="fw-normal">Cédula empleado <b
                                        class="text-danger">*</b></label>
                            </div>
                        </div>


                        <div class="col-12 col-md-6">
                            <div class="form-floating mb-3">
                                <select name="tipo_documento" id="tipo_documento" class="form-select" required disabled>
                                    <option value="">Selecciona una opción</option>
                                    @foreach ($tipo_documentos as $key => $tipo)
                                        <option value="{{ $key }}"
                                            {{ old('tipo_documento', '') == $key ? 'selected' : '' }}>{{ $tipo }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="tipo_documento" class="fw-normal">Tipo de documento <b
                                        class="text-danger">*</b></label>
                                @error('tipo_documento')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div id="cesantias" style="display: none;">
                            @include('admin.certificados.fields-cesantias')
                        </div>

                        <div id="fijo-horas" style="display: none;">
                            @include('admin.certificados.fields-termino-fijo-horas')
                        </div>

                        <div id="indefinido" style="display: none;">
                            @include('admin.certificados.fields-termino-indefinido')
                        </div>

                        <div id="carta-laboral" style="display: none;">
                            @include('admin.certificados.fields-carta-laboral')
                        </div>

                        <div id="llamado" style="display: none;">
                            @include('admin.certificados.fields-llamado-atencion')
                        </div>

                        <div class="form-group text-end">
                            <button class="btn btn-save btn-radius px-4" type="submit" disabled id="btn-generar-documento">
                                Generar
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Consultar información del usuario al terminar de escribir la cédula
        $('#cedula_empleado').on('blur', function() {
            var cedula = $(this).val();
            document.getElementById('tipo_documento').disabled = true;
            document.getElementById('btn-generar-documento').disabled = true;
            if (cedula) {
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    url: "{{ route('admin.generar-certificados.getEmpleado') }}",
                    type: 'POST',
                    data: {
                        cedula: cedula
                    },
                    success: function(response) {
                        if (response) {
                            empleado = JSON.parse(response);
                            document.getElementById('salario_empleado').value = empleado.salario;
                            document.getElementById('fecha_ingreso_empleado').value = empleado
                                .fecha_ingreso;
                            document.getElementById('tipo_documento').disabled = false;
                            document.getElementById('btn-generar-documento').disabled = false;
                        }
                    },
                    error: function(xhr) {
                        document.getElementById('tipo_documento').disabled = true;
                        document.getElementById('btn-generar-documento').disabled = true;

                        Swal.fire({
                            title: "Error",
                            text: xhr.responseJSON.message,
                            icon: "error",
                        });
                    }
                });
            }
        });

        let cesantias = document.getElementById('cesantias');
        let fijoHoras = document.getElementById('fijo-horas');
        let indefinido = document.getElementById('indefinido');
        let cartaLaboral = document.getElementById('carta-laboral');
        let llamado = document.getElementById('llamado');

        $('#tipo_documento').change(function() {
            if ($(this).val() == 1) { //cesantias
                cesantias.style.display = 'block';
                fijoHoras.style.display = 'none';
                indefinido.style.display = 'none';
                cartaLaboral.style.display = 'none';
                llamado.style.display = 'none';
            } else if ($(this).val() == 2) { //carta laboral
                cesantias.style.display = 'none';
                fijoHoras.style.display = 'none';
                indefinido.style.display = 'none';
                cartaLaboral.style.display = 'block';
                llamado.style.display = 'none';
            } else if ($(this).val() == 3 || $(this).val() == 5) { //temino fijo o horas u días
                cesantias.style.display = 'none';
                fijoHoras.style.display = 'block';
                indefinido.style.display = 'none';
                cartaLaboral.style.display = 'none';
                llamado.style.display = 'none';
            } else if ($(this).val() == 4) { //llamado de atención
                cesantias.style.display = 'none';
                fijoHoras.style.display = 'none';
                indefinido.style.display = 'none';
                cartaLaboral.style.display = 'none';
                llamado.style.display = 'block';
            } else if ($(this).val() == 6) { //termino indefinido
                cesantias.style.display = 'none';
                fijoHoras.style.display = 'none';
                indefinido.style.display = 'block';
                cartaLaboral.style.display = 'none';
                llamado.style.display = 'none';
            } else {
                cesantias.style.display = 'none';
                fijoHoras.style.display = 'none';
                indefinido.style.display = 'none';
                cartaLaboral.style.display = 'none';
                llamado.style.display = 'none';
            }
        });

        var tipoDocumento = document.getElementById('tipo_documento').value;

        if (tipoDocumento == 1) { //cesantias
            document.getElementById('tipo_documento').disabled = false;
            document.getElementById('btn-generar-documento').disabled = false;
            cesantias.style.display = 'block';
            fijoHoras.style.display = 'none';
            indefinido.style.display = 'none';
            cartaLaboral.style.display = 'none';
            llamado.style.display = 'none';
        } else if (tipoDocumento == 2) { //carta laboral
            document.getElementById('tipo_documento').disabled = false;
            document.getElementById('btn-generar-documento').disabled = false;
            cesantias.style.display = 'none';
            fijoHoras.style.display = 'none';
            indefinido.style.display = 'none';
            cartaLaboral.style.display = 'block';
            llamado.style.display = 'none';
        } else if (tipoDocumento == 3 || tipoDocumento == 5) { //temino fijo o horas u días
            document.getElementById('tipo_documento').disabled = false;
            document.getElementById('btn-generar-documento').disabled = false;
            cesantias.style.display = 'none';
            fijoHoras.style.display = 'block';
            indefinido.style.display = 'none';
            cartaLaboral.style.display = 'none';
            llamado.style.display = 'none';
        } else if (tipoDocumento == 4) { //llamado de atención
            document.getElementById('tipo_documento').disabled = false;
            document.getElementById('btn-generar-documento').disabled = false;
            cesantias.style.display = 'none';
            fijoHoras.style.display = 'none';
            indefinido.style.display = 'none';
            cartaLaboral.style.display = 'none';
            llamado.style.display = 'block';
        } else if (tipoDocumento == 6) { //termino indefinido
            document.getElementById('tipo_documento').disabled = false;
            document.getElementById('btn-generar-documento').disabled = false;
            cesantias.style.display = 'none';
            fijoHoras.style.display = 'none';
            indefinido.style.display = 'block';
            cartaLaboral.style.display = 'none';
            llamado.style.display = 'none';
        } else {
            cesantias.style.display = 'none';
            fijoHoras.style.display = 'none';
            indefinido.style.display = 'none';
            cartaLaboral.style.display = 'none';
            llamado.style.display = 'none';
        }
    </script>

@endsection
