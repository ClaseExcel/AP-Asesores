<div class="row">

    <div class="col-12 col-xl-6">
        <div class="form-floating mb-3">
            <select name="tipo_identificacion" class="form-select">
                <option value="" {{ old('tipo_identificacion') == '' ? 'selected' : '' }}>Selecciona una opción
                </option>
                <option value=" Cédula de extranjería"
                    {{ old('tipo_identificacion', $empresa->tipo_identificacion) == ' Cédula de extranjería' ? 'selected' : '' }}>
                    Cédula de extranjería (CE)</option>
                <option value="Cédula de ciudadanía"
                    {{ old('tipo_identificacion', $empresa->tipo_identificacion) == 'Cédula de ciudadanía' ? 'selected' : '' }}>
                    Cédula de ciudadanía (CC)</option>
                <option value="Documento de identificación extranjero"
                    {{ old('tipo_identificacion', $empresa->tipo_identificacion) == 'Documento de identificación extranjero' ? 'selected' : '' }}>
                    Documento de identificación extranjero (DIE)</option>
                <option value="Identificación tributaria de otro país"
                    {{ old('tipo_identificacion', $empresa->tipo_identificacion) == 'Identificación tributaria de otro país' ? 'selected' : '' }}>
                    Identificación tributaria de otro país (NE)</option>
                <option value="Número de Identificación Tributaria CO"
                    {{ old('tipo_identificacion', $empresa->tipo_identificacion) == 'Número de Identificación Tributaria CO' ? 'selected' : '' }}>
                    Número de Identificación Tributaria CO (NIT)</option>
                <option value="Pasaporte"
                    {{ old('tipo_identificacion', $empresa->tipo_identificacion) == 'Pasaporte' ? 'selected' : '' }}>
                    Pasaporte (PSPT)</option>
                <option value=" Permiso especial permanencia"
                    {{ old('tipo_identificacion', $empresa->tipo_identificacion) == 'Permiso especial permanencia' ? 'selected' : '' }}>
                    Permiso especial permanencia (PEP)</option>
                <option value=" Permiso por protección temporal"
                    {{ old('tipo_identificacion', $empresa->tipo_identificacion) == 'Permiso por protección temporal' ? 'selected' : '' }}>
                    Permiso por protección temporal (PPT)</option>
                <option value=" Registro civil"
                    {{ old('tipo_identificacion', $empresa->tipo_identificacion) == 'Registro civil' ? 'selected' : '' }}>
                    Registro civil (RC)</option>
                <option value=" Registro Único de Información Fiscal"
                    {{ old('tipo_identificacion', $empresa->tipo_identificacion) == 'Registro Único de Información Fiscal' ? 'selected' : '' }}>
                    Registro Único de Información Fiscal (RIF)</option>
                <option value=" Tarjeta de identidad"
                    {{ old('tipo_identificacion', $empresa->tipo_identificacion) == 'Tarjeta de identidad' ? 'selected' : '' }}>
                    Tarjeta de identidad (TI)</option>
                <option value=" Tarjeta de extranjería"
                    {{ old('tipo_identificacion', $empresa->tipo_identificacion) == 'Tarjeta de extranjería' ? 'selected' : '' }}>
                    Tarjeta de extranjería (TE)</option>
            </select>
            <label for="frecuencias" class="fw-normal">Tipo de identificación <b class="text-danger">*</b></label>
            @if ($errors->has('tipo_identificacion'))
                <span id="tipo_identificacion"
                    class="text-danger text-sm">{{ $errors->first('tipo_identificacion') }}</span>
            @endif
            <span id="tipo_identificacion" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="input-group input-group-lg mb-3" style="height: 58px;">
            <input type="number" class="form-control shadow-none" id="nit" name="NIT" placeholder="NIT"
                aria-label="digito_verificacion" aria-describedby="basic-addon2" value="{{ $empresa->NIT }}">
            <span class="input-group-text" id="digitoVerificacion"
                style="width: 55px;background-color:#D0AA665f;color:#397dae;">
                {{ $empresa->dv ? '- ' . $empresa->dv : '' }}
            </span>
            <input type="hidden" id="digito_verificacion" name="dv" value="{{ $empresa->dv }}">
        </div>
        <span id="NIT" class="text-danger text-sm"></span>
    </div>

    <div class="col-xl-12">
        <div class="form-floating mb-3">
            <input type="text" name="razon_social" value="{{ old('razon_social', $empresa->razon_social) }}"
                class="form-control" placeholder=" " />
            <label for="razon_social" class="fw-normal">Razón social <b class="text-danger">*</b></label>
            <span id="razon_social" class="text-danger text-sm"></span>
        </div>
    </div>

    @include('admin.empresas.campos-opcionales')

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input type="email" name="correo_electronico"
                value="{{ old('correo_electronico', $empresa->correo_electronico) }}" class="form-control"
                placeholder=" " />
            <label for="correo_electronico" class="fw-normal">Correo electrónico <b class="text-danger">*</b></label>
            <span id="correo_electronico" class="text-danger text-sm"></span>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input type="text" id="correos_secundarios" name="correos_secundarios"
                value="{{ old('correos_secundarios', $empresa->correos_secundarios) }}" class="form-control"
                placeholder=" " title="Ingrese los correos electrónicos separados por comas" />
            <label for="correos_secundarios" class="fw-normal">Correos electrónicos secundarios</label>

            <span id="correos_secundarios" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input type="number" name="numero_contacto"
                value="{{ old('numero_contacto', $empresa->numero_contacto) }}" class="form-control" placeholder=" " />
            <label for="numero_contacto" class="fw-normal">Número de contacto de la empresa <b
                    class="text-danger">*</b></label>
            <span id="numero_contacto" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input type="text" id="telefonos_secundarios" name="telefonos_secundarios"
                value="{{ old('telefonos_secundarios', $empresa->telefonos_secundarios) }}" class="form-control"
                placeholder=" " title="Ingrese los teléfonos separados por comas" />
            <label for="telefonos_secundarios" class="fw-normal">Teléfonos secundarios</label>

            @if ($errors->has('telefonos_secundarios'))
                <span id="telefonos_secundarios"
                    class="text-danger">{{ $errors->first('telefonos_secundarios') }}</span>
            @endif
        </div>
    </div>


    <div class="col-xl-12">
        <div class="form-floating mb-3">
            <select name="notifica_calendario" class="form-select">
                <option value="0"
                    {{ old('notifica_calendario', $empresa->notifica_calendario) == '0' ? 'selected' : '' }}>Selecciona
                    una opción
                <option value="1"
                    {{ old('notifica_calendario', $empresa->notifica_calendario) == '1' ? 'selected' : '' }}>SÍ
                <option value="2"
                    {{ old('notifica_calendario', $empresa->notifica_calendario) == '2' ? 'selected' : '' }}>NO
            </select>
            <label for="notifica_calendario" class="fw-normal">Notificar calendario vencimientos</label>
            <span id="notifica_calendario" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-12 col-xl-6">
        <div class="form-floating mb-3">
            <input type="text" name="nombre_contacto"
                value="{{ old('nombre_contacto', $empresa->nombre_contacto) }}" class="form-control"
                placeholder=" " />
            <label for="nombre_contacto" class="fw-normal">Nombre del contacto <b class="text-danger">*</b></label>
            <span id="nombre_contacto" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-12 col-xl-6">
        <div class="form-floating mb-3">
            <input type="number" name="telefono_contacto"
                value="{{ old('telefono_contacto', $empresa->telefono_contacto) }}" class="form-control"
                placeholder=" " />
            <label for="telefono_contacto" class="fw-normal">Número del contacto <b class="text-danger">*</b></label>
            <span id="telefono_contacto" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-floating mb-3">
            <input type="text" name="nombres_usuario_certificado"
                value="{{ old('nombres_usuario_certificado', $empresa->nombres_usuario_certificado) }}"
                class="form-control" placeholder=" " />
            <label for="nombres_usuario_certificado" class="fw-normal">Nombres completos usuario certificados </label>

            @if ($errors->has('nombres_usuario_certificado'))
                <span id="nombres_usuario_certificado"
                    class="text-danger text-sm">{{ $errors->first('nombres_usuario_certificado') }}</span>
            @endif
            <span id="nombres_usuario_certificado" class="text-danger text-sm"></span>
        </div>
    </div>


    <div class="col-12 col-md-6">
        <div class="form-floating mb-3">
            <input type="text" name="cargo_usuario_certificado"
                value="{{ old('cargo_usuario_certificado', $empresa->cargo_usuario_certificado) }}"
                class="form-control" placeholder=" " />
            <label for="cargo_usuario_certificado" class="fw-normal">Cargo de usuario certificados </label>

            @if ($errors->has('cargo_usuario_certificado'))
                <span id="cargo_usuario_certificado"
                    class="text-danger text-sm">{{ $errors->first('cargo_usuario_certificado') }}</span>
            @endif
            <span id="cargo_usuario_certificado" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-floating mb-3">
            <input type="number" name="telefono_usuario_certificado"
                value="{{ old('telefono_usuario_certificado', $empresa->telefono_usuario_certificado) }}"
                class="form-control" placeholder=" " />
            <label for="telefono_usuario_certificado" class="fw-normal">Télefono de usuario certificados </label>

            @if ($errors->has('telefono_usuario_certificado'))
                <span id="telefono_usuario_certificado"
                    class="text-danger text-sm">{{ $errors->first('telefono_usuario_certificado') }}</span>
            @endif
            <span id="telefono_usuario_certificado" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-floating mb-3">
            <input type="email" name="correo_usuario_certificado"
                value="{{ old('correo_usuario_certificado', $empresa->correo_usuario_certificado) }}"
                class="form-control" placeholder=" " />
            <label for="correo_usuario_certificado" class="fw-normal">Correo de usuario certificados</label>

            @if ($errors->has('correo_usuario_certificado'))
                <span id="correo_usuario_certificado"
                    class="text-danger text-sm">{{ $errors->first('correo_usuario_certificado') }}</span>
            @endif
            <span id="correo_usuario_certificado" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-12 form-group mb-3 border rounded bg-light py-2">
        <div class="form-group mb-3">
            <label class="fw-normal" for="firma_usuario_certificado">Agregar firma digital de usuario
                certificados</label>
            <input class="form-control {{ $errors->has('firma_usuario_certificado') ? 'is-invalid' : '' }}"
                type="file" name="firma_usuario_certificado" id="firma4"
                accept="image/jpeg, image/png, image/jpg, image/gif">
            @if ($errors->has('firma_usuario_certificado'))
                <span class="text-danger">{{ $errors->first('firma_usuario_certificado') }}</span>
            @endif
        </div>

        <div class="text-center">
            <img id="avatar_preview4" src="#" alt="Avatar Preview"
                style="display: none; max-width: 120px; max-height: 120px;" class="rounded mx-auto">
            <small id="text_preview4" style="display: none">Vista previa</small>
        </div>
    </div>

    <script>
        // Función genérica para actualizar la vista previa
        function readURL(input, previewId, textPreviewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById(previewId).src = e.target.result;
                    document.getElementById(previewId).style.display = 'block';
                }

                reader.readAsDataURL(input.files[0]);

                // Hacer visible el texto de vista previa
                document.getElementById(textPreviewId).style.display = 'block';
            }
        }

        document.getElementById('firma4').addEventListener('change', function() {
            readURL(this, 'avatar_preview4', 'text_preview4');
        });
    </script>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input type="text" name="direccion_fisica"
                value="{{ old('direccion_fisica', $empresa->direccion_fisica) }}" class="form-control"
                placeholder=" " />
            <label for="direccion_fisica" class="fw-normal">Dirección física <b class="text-danger">*</b></label>
            <span id="direccion_fisica" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-floating mb-3">
            <input type="text" name="ciudad" value="{{ old('ciudad', $empresa->ciudad) }}" class="form-control"
                placeholder=" " />
            <label for="ciudad" class="fw-normal">Ciudad <b class="text-danger">*</b></label>
            @if ($errors->has('ciudad'))
                <span id="ciudad" class="text-danger text-sm">{{ $errors->first('ciudad') }}</span>
            @endif
            <span id="ciudad" class="text-danger text-sm"></span>
        </div>
    </div>


    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <select id="frecuencias" name="frecuencia_id" class="form-select">
                <option value="" {{ old('tipocliente') == '' ? 'selected' : '' }}>Selecciona una opción
                    @foreach ($frecuencias as $id => $nombre)
                <option value="{{ $id }}"
                    {{ old('frecuencia_id', $empresa->frecuencia_id) == $id ? 'selected' : '' }}>
                    {{ $nombre }}</option>
                @endforeach
            </select>
            <label for="frecuencias" class="fw-normal">Frecuencia <b class="text-danger">*</b></label>
            <span id="frecuencia_id" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <select name="tipocliente" class="form-select">
                <option value="" {{ old('tipocliente') == '' ? 'selected' : '' }}>Selecciona un tipo cliente
                </option>
                <option value="persona"
                    {{ old('tipocliente', $empresa->tipocliente) == 'persona' ? 'selected' : '' }}>
                    Persona</option>
                <option value="empresa"
                    {{ old('tipocliente', $empresa->tipocliente) == 'empresa' ? 'selected' : '' }}>
                    Empresa</option>

            </select>
            <label for="frecuencias" class="fw-normal">Tipo cliente <b class="text-danger">*</b></label>
            <span id="tipocliente" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <div class="row d-flex justify-content-between ">
                <div class="col-10">
                    <label class="fw-normal">
                        RUT: <b class="text-danger">*</b>
                    </label>
                </div>
                <div class="col-12">
                    <div class="input-group">
                        <label class="input-group-text bg-transparent" for="rut"><i
                                class="fas fa-file-upload"></i>
                            &nbsp;
                        </label>
                        <input type="file" id="idrut" name="rut" class="form-control"
                            accept="application/pdf" />
                        <span id="rut" class="text-danger text-sm"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <div class="row d-flex justify-content-between ">
                <div class="col-12">
                    <label class="fw-normal">
                        FCC - NIT:
                    </label>
                </div>
                <div class="col">
                    <div class="input-group">
                        <label class="input-group-text bg-transparent" for="contrato"><i
                                class="fas fa-file-upload"></i>
                            &nbsp; </label>
                        <input type="file" id="idcontrato" name="contrato" class="form-control"
                            accept="application/pdf" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <div class="row d-flex justify-content-between ">
                <div class="col-12">
                    <label class="fw-normal">
                        Cámara de comercio:
                    </label>
                </div>
                <div class="col">
                    <div class="input-group">
                        <label class="input-group-text bg-transparent" for="documento_camaracomercio"><i
                                class="fas fa-file-upload"></i>
                            &nbsp; </label>
                        <input type="file" id="iddocumento_camaracomercio" name="documento_camaracomercio" class="form-control"
                            accept="application/pdf" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="form-floating mb-3">
            <div class="row d-flex justify-content-between ">
                <div class="col-12">
                    <label class="fw-normal">
                        Seleccionar un Empleado o varios: <b class="text-danger">*</b>
                    </label>
                </div>
                <div class="col">
                    <div class="btn-group mb-2">
                        <button id="selectAllButtonempleados" type="button"
                            class="btn btn-outline-info btn-xs  btn-radius px-4 me-2"
                            style="border-radius: 5px">Seleccionar
                            Todo</button>
                        <button id="deselectAllButtonempleados" type="button"
                            class="btn btn-outline-info btn-xs btn-radius px-4 "
                            style="border-radius: 5px">Deseleccionar
                            Todo</button>
                    </div>
                </div>
            </div>
            <select name="empleados[]" id="empleados" class="form-select" multiple>
                @foreach ($empleados as $id => $nombre)
                    <option value={{ $id }}
                        {{ $empresa->empleados != null && in_array($id, json_decode($empresa->empleados)) ? 'selected' : '' }}>
                        {{ $id . ' - ' . $nombre }}
                    </option>
                @endforeach
            </select>
            <span id="empleado" class="text-danger text-sm"></span>
        </div>
    </div>

    <div class="col-12 col-md-12">
        <div class="form-floating mb-3">
            <div class="row d-flex justify-content-between ">
                <div class="col-12">
                    <label class="fw-normal">
                        Seleccionar una obligación tributaria DIAN o varias: <b class="text-danger">*</b>
                    </label>
                </div>
                <div class="col">
                    <div class="btn-group mb-2">
                        <button id="selectAllButton" type="button"
                            class="btn btn-outline-info btn-xs  btn-radius px-4 me-2"
                            style="border-radius: 5px">Seleccionar Todo</button>
                        <button id="deselectAllButton" type="button"
                            class="btn btn-outline-info btn-xs btn-radius px-4 "
                            style="border-radius: 5px">Deseleccionar
                            Todo</button>
                    </div>
                </div>

            </div>
            <select name="obligaciones[]" id="obligaciones" class="form-select" multiple>
                @foreach ($obligaciones as $obligacion)
                    <option value="{{ $obligacion->codigo }}"
                        {{ $empresa->obligaciones != null && in_array($obligacion->codigo, json_decode($empresa->obligaciones)) ? 'selected' : '' }}>
                        {{ $obligacion->codigo . ' - ' . $obligacion->nombre }}
                    </option>
                @endforeach
            </select>
            <span id="obligaciones_error" class="text-danger text-sm"></span>
        </div>
    </div>


      <div class="col-12 col-md-12">
        <div class="form-floating mb-3">
            <div class="row d-flex justify-content-between ">
                <div class="col-12">
                    <label class="fw-normal">
                       Cámara de comercio principal: <b class="text-danger">*</b>
                    </label>
                </div>
            </div>
            <select name="camaracomercio_id" id="camaracomercio" class="form-select" multiple>
                  @foreach ($camarascomercio as $camaracomercio)
                    <option value="{{ $camaracomercio->id . ' - ' . $camaracomercio->nombre }}"
                        {{ $empresa->camaracomercio_id == $camaracomercio->id ? 'selected' : '' }}>
                        {{ $camaracomercio->id  . ' - ' . $camaracomercio->nombre }}
                    </option>
                @endforeach
            </select>
            <span id="camaracomercio_id" class="text-danger text-sm"></span>
        </div>
    </div>

    {{-- <script>
        var valorExistente = document.getElementById('camaraexistente').value;

        if (valorExistente) {
            var datalistOptions = document.getElementById('datalistOptionsCamara');
            var options = datalistOptions.getElementsByTagName('option');

            for (var i = 0; i < options.length; i++) {
                var valorDataId = options[i].getAttribute('data-id');
                if (valorDataId == valorExistente) {
                    document.getElementById('camaracomercio').value = options[i].value;
                    break;
                }
            }
        }
    </script> --}}


    <div class="col-12">
        <div class="card border shadow-none">
            <div class="col-12 col-md-12">
                <div class="form-floating mb-3">
                    <div class="row d-flex justify-content-between ">
                        <div class="col-12">
                            <label class="fw-normal">
                                Seleccionar una obligación Municipal o varias: <b class="text-danger">*</b>
                            </label>
                        </div>
                        <div class="col">
                            <div class="btn-group mb-2">
                                <button id="selectAllButton3" type="button"
                                    class="btn btn-outline-info btn-xs  btn-radius px-4 me-2"
                                    style="border-radius: 5px">Seleccionar Todo</button>
                                <button id="deselectAllButton3" type="button"
                                    class="btn btn-outline-info btn-xs btn-radius px-4 "
                                    style="border-radius: 5px">Deseleccionar Todo</button>
                            </div>
                        </div>

                    </div>
                    <select id="obligacionMunicipal" multiple="multiple"
                        class="form-select {{ $errors->has('codigo_obligacionmunicipal') ? 'is-invalid' : '' }} custom-select-border w-100 py-4"
                        name="codigo_obligacionmunicipal[]" required data-dropup="true" data-container="body">
                        @foreach ($obligacionesmunicipalescodigo as $obligacion)
                            <option value="{{ $obligacion->codigo }}"
                                {{ $empresa->codigo_obligacionmunicipal != null && $empresa->codigo_obligacionmunicipal != 'null' && in_array($obligacion->codigo, json_decode($empresa->codigo_obligacionmunicipal)) ? 'selected' : '' }}>
                                {{ $obligacion->codigo . ' - ' . $obligacion->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('codigo_obligacionmunicipal'))
                        <span class="text-danger text-sm ">{{ $errors->first('codigo_obligacionmunicipal') }}</span>
                    @endif
                    <span id="codigo_obligacionmunicipal" class="text-danger text-sm"></span>
                </div>
            </div>

            <div class="col-12 col-md-12">
                <div class="form-floating mb-3">
                    <div class="row d-flex justify-content-between ">
                        <div class="col-12">
                            <label class="fw-normal">
                                Seleccionar un detalle de otras entidades o varias: <b class="text-danger">*</b>
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
                    <select id="OtrasEntidades" multiple="multiple"
                        class="form-select {{ $errors->has('otras_entidades') ? 'is-invalid' : '' }} custom-select-border w-100 py-4"
                        name="otras_entidades[]" required data-dropup="true" data-container="body">
                        @foreach ($otrasentidades as $obligacion)
                            <option value="{{ $obligacion->codigo }}"
                                {{ $empresa->otras_entidades != null && in_array($obligacion->codigo, json_decode($empresa->otras_entidades)) ? 'selected' : '' }}>
                                {{ $obligacion->codigo . ' - ' . $obligacion->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('otras_entidades'))
                        <span class="text-danger text-sm ">{{ $errors->first('otras_entidades') }}</span>
                    @endif
                    <span id="otras_entidades" class="text-danger text-sm"></span>
                </div>
            </div>
        </div>
    </div>
</div>
