<div class="row">
    <div class="col-12">
        <div class="form-floating mb-3 text-center">
            <button type="button" id="toggleCampos" class="btn btn-back  border btn-radius px-4 ">
                <i class="fas fa-eye"></i> Ver/Ocultar Campos opcionales
            </button>
        </div>
    </div>
</div>
<div class="row campos-ocultos">
    <div class="card border">
        <div class="card-body row">
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="number" id="Cedula" name="Cedula" value="{{ old('Cedula', $empresa->Cedula) }}"
                        class="form-control" placeholder=" " />
                    <label for="Cedula" class="fw-normal">Cédula </label>

                    @if ($errors->has('Cedula'))
                        <span id="Cedula" class="text-danger">{{ $errors->first('Cedula') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="sigla" name="sigla" value="{{ old('sigla', $empresa->sigla) }}"
                        class="form-control" placeholder=" " />
                    <label for="sigla" class="fw-normal">SIGLA </label>

                    @if ($errors->has('sigla'))
                        <span id="sigla" class="text-danger">{{ $errors->first('sigla') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-12 col-md-12">
                <div class="form-floating mb-3">
                    <input type="text" id="representantelegal" name="representantelegal"
                        value="{{ old('representantelegal', $empresa->representantelegal) }}" class="form-control"
                        placeholder=" " />
                    <label for="representantelegal" class="fw-normal">Nombre representante legal </label>

                    @if ($errors->has('representantelegal'))
                        <span id="representantelegal"
                            class="text-danger">{{ $errors->first('representantelegal') }}</span>
                    @endif
                </div>
            </div>

            @if (isset($empresa->id) && $empresa->firmarepresentante != 'default.jpg')
                <div class="card-body bg-light">
                    <img src="{{ asset('storage/representante_firma/' . $empresa->firmarepresentante) }}"
                        class="img-thumbnail" alt="avatar" style="max-width: 120px; max-height: 120px;">
                </div>
            @endif
            <div class="col-12 form-group mb-3 border rounded bg-light py-2">
                <div class="form-group mb-3">
                    <label class="fw-normal" for="firmarepresentante">Agregar firma digital representante legal</label>
                    <input class="form-control {{ $errors->has('firmarepresentante') ? 'is-invalid' : '' }}"
                        type="file" name="firmarepresentante" id="firma"
                        accept="image/jpeg, image/png, image/jpg, image/gif">
                    @if ($errors->has('firmarepresentante'))
                        <span class="text-danger">{{ $errors->first('firmarepresentante') }}</span>
                    @endif
                </div>

                <div class="text-center">
                    <img id="avatar_preview" src="#" alt="Avatar Preview"
                        style="display: none; max-width: 120px; max-height: 120px;" class="rounded mx-auto">
                    <small id="text_preview" style="display: none">Vista previa</small>
                </div>
            </div>

            @if (isset($empresa->id) && $empresa->logocliente != 'default.jpg')
                <div class="card-body bg-light">
                    <img src="{{ asset('storage/logo_cliente/' . $empresa->logocliente) }}" class="img-thumbnail"
                        alt="avatar" style="max-width: 120px; max-height: 120px;">
                </div>
            @endif
            <div class="col-12 form-group mb-3 border rounded bg-light py-2">
                <div class="form-group mb-3">
                    <label class="fw-normal" for="logocliente">Agregar logo empresa</label>
                    <input class="form-control {{ $errors->has('logocliente') ? 'is-invalid' : '' }}" type="file"
                        name="logocliente" id="firma3" accept="image/jpeg, image/png, image/jpg, image/gif">
                    @if ($errors->has('logocliente'))
                        <span class="text-danger">{{ $errors->first('logocliente') }}</span>
                    @endif
                </div>

                <div class="text-center">
                    <img id="avatar_preview3" src="#" alt="Avatar Preview"
                        style="display: none; max-width: 120px; max-height: 120px;" class="rounded mx-auto">
                    <small id="text_preview3" style="display: none">Vista previa</small>
                </div>
            </div>
            {{-- vista previa de las imagenes --}}
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

                // Añadir los event listeners para cada input
                document.getElementById('firma').addEventListener('change', function() {
                    readURL(this, 'avatar_preview', 'text_preview');
                });

                document.getElementById('firma3').addEventListener('change', function() {
                    readURL(this, 'avatar_preview3', 'text_preview3');
                });
            </script>

            <div class="col-xl-12">
                <div class="form-floating mb-3">
                    <div class="row d-flex justify-content-between ">
                        <div class="col-12">
                            <label class="fw-normal">
                                Seleccionar uno o varios CIIU:
                            </label>
                        </div>
                        <div class="col">
                            <div class="btn-group mb-2">
                                <button id="selectAllButtonCiiu" type="button"
                                    class="btn btn-outline-info btn-xs  btn-radius px-4 me-2"
                                    style="border-radius: 5px">Seleccionar Todo</button>
                                <button id="deselectAllButtonCiiu" type="button"
                                    class="btn btn-outline-info btn-xs btn-radius px-4 "
                                    style="border-radius: 5px">Deseleccionar Todo</button>
                            </div>
                        </div>

                    </div>
                    <select id="ciiu" multiple="multiple" style="width:100%;"
                        class="form-select {{ $errors->has('ciiu') ? 'is-invalid' : '' }} custom-select-border w-100 py-4"
                        name="ciiu[]" data-dropup="true" data-container="body">

                        @foreach ($ciiu as $ciiu)
                            @if ($empresa->ciiu != 'null')
                                <option value="{{ $ciiu->codigo }}"
                                    {{ $empresa->ciiu != null && in_array($ciiu->codigo, json_decode($empresa->ciiu)) ? 'selected' : '' }}>
                                    {{ $ciiu->codigo . ' - ' . $ciiu->nombre }}

                                </option>
                            @else
                                <option value="{{ $ciiu->codigo }}"> {{ $ciiu->codigo . ' - ' . $ciiu->nombre }}
                                </option>
                            @endif
                        @endforeach

                    </select>
                    @if ($errors->has('ciiu'))
                        <span class="text-danger text-sm ">{{ $errors->first('ciiu') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-xl-12">
                <div class="form-floating mb-3">
                    <div class="row d-flex justify-content-between ">
                        <div class="col-12">
                            <label class="fw-normal">
                                Seleccionar uno o varios códigos de cámaras de comercio establecimientos de comercio:
                            </label>
                        </div>
                        <div class="col">
                            <div class="btn-group mb-2">
                                <button id="selectAllButtonCamaraComercio" type="button"
                                    class="btn btn-outline-info btn-xs  btn-radius px-4 me-2"
                                    style="border-radius: 5px">Seleccionar Todo</button>
                                <button id="deselectAllButtonCamaraComercio" type="button"
                                    class="btn btn-outline-info btn-xs btn-radius px-4 "
                                    style="border-radius: 5px">Deseleccionar Todo</button>
                            </div>
                        </div>

                    </div>
                    <select id="camara_comercio_establecimientos" multiple="multiple" style="width:100%;"
                        class="form-select {{ $errors->has('camara_comercio_establecimientos') ? 'is-invalid' : '' }} custom-select-border w-100 py-4"
                        name="camara_comercio_establecimientos[]" data-dropup="true" data-container="body">
                        @foreach ($camarascomercio as $camarascomercio)
                            @if ($empresa->camara_comercio_establecimientos != 'null')
                                <option value="{{ $camarascomercio->id }}"
                                    {{ $empresa->camara_comercio_establecimientos != null && in_array($camarascomercio->id, json_decode($empresa->camara_comercio_establecimientos)) ? 'selected' : '' }}>
                                    {{ $camarascomercio->id . ' - ' . $camarascomercio->nombre }}
                                </option>
                            @else
                                <option value="{{ $camarascomercio->id }}">
                                    {{ $camarascomercio->id . ' - ' . $camarascomercio->nombre }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @if ($errors->has('camara_comercio_establecimientos'))
                        <span
                            class="text-danger text-sm ">{{ $errors->first('camara_comercio_establecimientos') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="contrasenadian" name="contrasenadian"
                        value="{{ old('contrasenadian', $empresa->contrasenadian) }}" class="form-control"
                        placeholder=" " />
                    <label for="contrasenadian" class="fw-normal">Contraseña DIAN </label>

                    @if ($errors->has('contrasenadian'))
                        <span id="contrasenadian" class="text-danger">{{ $errors->first('contrasenadian') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="preguntadian" name="preguntadian"
                        value="{{ old('preguntadian', $empresa->preguntadian) }}" class="form-control"
                        placeholder=" " />
                    <label for="preguntadian" class="fw-normal">Pregunta DIAN </label>

                    @if ($errors->has('preguntadian'))
                        <span id="preguntadian" class="text-danger">{{ $errors->first('preguntadian') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="firmadian" name="firmadian"
                        value="{{ old('firmadian', $empresa->firmadian) }}" class="form-control" placeholder=" " />
                    <label for="firmadian" class="fw-normal">Firma electronica DIAN </label>

                    @if ($errors->has('firmadian'))
                        <span id="firmadian" class="text-danger">{{ $errors->first('firmadian') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="camaracomercioclaveportal" name="camaracomercioclaveportal"
                        value="{{ old('camaracomercioclaveportal', $empresa->camaracomercioclaveportal) }}"
                        class="form-control" placeholder=" " />
                    <label for="camaracomercioclaveportal" class="fw-normal">Cámara comercio clave portal </label>

                    @if ($errors->has('camaracomercioclaveportal'))
                        <span id="camaracomercioclaveportal"
                            class="text-danger">{{ $errors->first('camaracomercioclaveportal') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="firmacamaracomercio" name="firmacamaracomercio"
                        value="{{ old('firmacamaracomercio', $empresa->firmacamaracomercio) }}" class="form-control"
                        placeholder=" " />
                    <label for="firmacamaracomercio" class="fw-normal">Cámara comercio firma </label>

                    @if ($errors->has('firmacamaracomercio'))
                        <span id="firmacamaracomercio"
                            class="text-danger">{{ $errors->first('firmacamaracomercio') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="arl" name="arl" value="{{ old('arl', $empresa->arl) }}"
                        class="form-control" placeholder=" " />
                    <label for="arl" class="fw-normal">ARL</label>

                    @if ($errors->has('arl'))
                        <span id="arl" class="text-danger">{{ $errors->first('arl') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="clavearl" name="clavearl"
                        value="{{ old('clavearl', $empresa->clavearl) }}" class="form-control" placeholder=" " />
                    <label for="clavearl" class="fw-normal">Clave ARL </label>

                    @if ($errors->has('clavearl'))
                        <span id="clavearl" class="text-danger">{{ $errors->first('clavearl') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="aportes" name="aportes"
                        value="{{ old('aportes', $empresa->aportes) }}" class="form-control" placeholder=" " />
                    <label for="aportes" class="fw-normal">APORTES - enlace operativo</label>

                    @if ($errors->has('aportes'))
                        <span id="aportes" class="text-danger">{{ $errors->first('aportes') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="ccf" name="ccf" value="{{ old('ccf', $empresa->ccf) }}"
                        class="form-control" placeholder=" " />
                    <label for="ccf" class="fw-normal">CCF</label>

                    @if ($errors->has('ccf'))
                        <span id="ccf" class="text-danger">{{ $errors->first('ccf') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="usuario_clave_eps" name="usuario_clave_eps"
                        value="{{ old('usuario_clave_eps', $empresa->usuario_clave_eps) }}" class="form-control"
                        placeholder=" " />
                    <label for="usuario_clave_eps" class="fw-normal">Usuario / clave EPS</label>

                    @if ($errors->has('usuario_clave_eps'))
                        <span id="usuario_clave_eps"
                            class="text-danger">{{ $errors->first('usuario_clave_eps') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="usuario_clave_ugpp" name="usuario_clave_ugpp"
                        value="{{ old('usuario_clave_ugpp', $empresa->usuario_clave_ugpp) }}" class="form-control"
                        placeholder=" " />
                    <label for="usuario_clave_ugpp" class="fw-normal">Usuario / clave UGPP</label>

                    @if ($errors->has('usuario_clave_ugpp'))
                        <span id="usuario_clave_ugpp"
                            class="text-danger">{{ $errors->first('usuario_clave_ugpp') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="usuario_fac_nomina" name="usuario_fac_nomina"
                        value="{{ old('usuario_fac_nomina', $empresa->usuario_fac_nomina) }}" class="form-control"
                        placeholder=" " />
                    <label for="usuario_fac_nomina" class="fw-normal">Usuario FACT / nómina electronica</label>

                    @if ($errors->has('usuario_fac_nomina'))
                        <span id="usuario_fac_nomina"
                            class="text-danger">{{ $errors->first('usuario_fac_nomina') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="clave_fact_nomina" name="clave_fact_nomina"
                        value="{{ old('clave_fact_nomina', $empresa->clave_fact_nomina) }}" class="form-control"
                        placeholder=" " />
                    <label for="clave_fact_nomina" class="fw-normal">Clave FACT / nómina electronica</label>

                    @if ($errors->has('clave_fact_nomina'))
                        <span id="clave_fact_nomina"
                            class="text-danger">{{ $errors->first('clave_fact_nomina') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="usuario_sistema_contable" name="usuario_sistema_contable"
                        value="{{ old('usuario_sistema_contable', $empresa->usuario_sistema_contable) }}"
                        class="form-control" placeholder=" " />
                    <label for="usuario_sistema_contable" class="fw-normal">Usuario sistema contable</label>

                    @if ($errors->has('usuario_sistema_contable'))
                        <span id="usuario_sistema_contable"
                            class="text-danger">{{ $errors->first('usuario_sistema_contable') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="clave_sistema_contable" name="clave_sistema_contable"
                        value="{{ old('clave_sistema_contable', $empresa->clave_sistema_contable) }}"
                        class="form-control" placeholder=" " />
                    <label for="clave_sistema_contable" class="fw-normal">Clave sistema contable</label>

                    @if ($errors->has('clave_sistema_contable'))
                        <span id="clave_sistema_contable"
                            class="text-danger">{{ $errors->first('clave_sistema_contable') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-xl-6">
                <div class="form-floating mb-3">
                    <input type="text" id="ciiu_municipios" name="ciiu_municipios"
                        value="{{ old('ciiu_municipios', $empresa->ciiu_municipios) }}" class="form-control"
                        placeholder=" " />
                    <label for="ciiu_municipios" class="fw-normal">Código CIIU para municipios </label>

                    @if ($errors->has('ciiu_municipios'))
                        <span id="ciiu_municipios" class="text-danger">{{ $errors->first('ciiu_municipios') }}</span>
                    @endif
                </div>
            </div>

                @if (request()->routeIs('admin.empresas.edit'))
                <div class="row">
                    @if ($usuarios_ica)
                        <div class="col-6 px-0">
                            @foreach ($usuarios_ica as $usuario_ica)
                                <div class="col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="usuario_ica" name="usuario_ica[]"
                                            value="{{ old('usuario_ica', $usuario_ica) }}" class="form-control"
                                            placeholder=" " />
                                        <label for="usuario_ica" class="fw-normal">Usuario ICA portal </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-6 px-0">
                            @foreach ($clave_ica as $clave)
                                <div class="col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="icaclaveportal" name="icaclaveportal[]"
                                            value="{{ old('icaclaveportal', $clave) }}" class="form-control"
                                            placeholder=" " />
                                        <label for="icaclaveportal" class="fw-normal">ICA contraseña portal </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col-xl-6">
                            <div class="form-floating mb-3">
                                <input type="text" id="usuario_ica" name="usuario_ica[]"
                                    value="{{ old('usuario_ica', '') }}" class="form-control" placeholder=" " />
                                <label for="usuario_ica" class="fw-normal">Usuario ICA portal </label>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-floating mb-3">
                                <input type="text" id="icaclaveportal" name="icaclaveportal[]"
                                    value="{{ old('icaclaveportal', '') }}" class="form-control" placeholder=" " />
                                <label for="icaclaveportal" class="fw-normal">ICA contraseña portal </label>
                            </div>
                        </div>
                    @endif
                </div>

                <div id="inputs-container-ica">

                </div>

                <div class="col-12 mb-3" id="button-ica">
                    <button class="btn btn-success btn-sm" type="button" id="add-input-ica">Agregar usuario
                        ICA</button>
                </div>

                <div class="row">
                    @if ($usuarios_eps)
                        <div class="col-6 px-0">
                            @foreach ($usuarios_eps as $usuario_eps)
                                <div class="col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="usuario_eps" name="usuario_eps[]"
                                            value="{{ old('usuario_eps', $usuario_eps) }}" class="form-control"
                                            placeholder=" " />
                                        <label for="usuario_eps" class="fw-normal">Usuario EPS </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-6 px-0">
                            @foreach ($clave_eps as $clave)
                                <div class="col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="usuario_clave_eps" name="usuario_clave_eps[]"
                                            value="{{ old('usuario_clave_eps', $clave) }}" class="form-control"
                                            placeholder=" " />
                                        <label for="usuario_clave_eps" class="fw-normal">Contraseña EPS</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col-xl-6">
                            <div class="form-floating mb-3">
                                <input type="text" id="usuario_eps" name="usuario_eps[]"
                                    value="{{ old('usuario_eps', '') }}" class="form-control" placeholder=" " />
                                <label for="usuario_eps" class="fw-normal">Usuario EPS </label>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-floating mb-3">
                                <input type="text" id="usuario_clave_eps" name="usuario_clave_eps[]"
                                    value="{{ old('usuario_clave_eps', '') }}" class="form-control"
                                    placeholder=" " />
                                <label for="usuario_clave_eps" class="fw-normal">Contraseña EPS</label>
                            </div>
                        </div>
                    @endif
                </div>

                <div id="inputs-container-eps">

                </div>

                <div class="col-12 mb-3" id="button-eps">
                    <button class="btn btn-success btn-sm" type="button" id="add-input-eps">Agregar usuario
                        EPS</button>
                </div>

                <div class="row">
                    @if ($usuarios_afp)
                        <div class="col-6 px-0">
                            @foreach ($usuarios_afp as $usuario_afp)
                                <div class="col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="usuario_afp" name="usuario_afp[]"
                                            value="{{ old('usuario_afp', $usuario_afp) }}" class="form-control"
                                            placeholder=" " />
                                        <label for="usuario_afp" class="fw-normal">Usuario AFP </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-6 px-0">
                            @foreach ($clave_afp as $clave)
                                <div class="col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="clave_afp" name="clave_afp[]"
                                            value="{{ old('clave_afp', $clave) }}" class="form-control"
                                            placeholder=" " />
                                        <label for="clave_afp" class="fw-normal">Contraseña AFP</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col-xl-6">
                            <div class="form-floating mb-3">
                                <input type="text" id="usuario_afp" name="usuario_afp[]"
                                    value="{{ old('usuario_afp', '') }}" class="form-control" placeholder=" " />
                                <label for="usuario_afp" class="fw-normal">Usuario AFP </label>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-floating mb-3">
                                <input type="text" id="clave_afp" name="clave_afp[]"
                                    value="{{ old('clave_afp', '') }}" class="form-control" placeholder=" " />
                                <label for="clave_afp" class="fw-normal">Contraseña AFP</label>
                            </div>
                        </div>
                    @endif
                </div>

                <div id="inputs-container-afp">

                </div>

                <div class="col-12 mb-3" id="button-afp">
                    <button class="btn btn-success btn-sm" type="button" id="add-input-afp">Agregar usuario
                        AFP</button>
                </div>

                <div class="row">
                    @if ($usuarios_pila)
                        <div class="col-6 px-0">
                            @foreach ($usuarios_pila as $usuario_pila)
                                <div class="col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="usuario_pila" name="usuario_pila[]"
                                            value="{{ old('usuario_pila', $usuario_pila) }}" class="form-control"
                                            placeholder=" " />
                                        <label for="usuario_pila" class="fw-normal">Usuario Operador de PILA</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-6 px-0">
                            @foreach ($clave_pila as $clave)
                                <div class="col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="clave_pila" name="clave_pila[]"
                                            value="{{ old('clave_pila', $clave) }}" class="form-control"
                                            placeholder=" " />
                                        <label for="clave_pila" class="fw-normal">Contraseña Operador de PILA</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col-xl-6">
                            <div class="form-floating mb-3">
                                <input type="text" id="usuario_pila" name="usuario_pila[]"
                                    value="{{ old('usuario_pila', '') }}" class="form-control" placeholder=" " />
                                <label for="usuario_pila" class="fw-normal">Usuario Operador de PILA </label>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-floating mb-3">
                                <input type="text" id="clave_pila" name="clave_pila[]"
                                    value="{{ old('clave_pila', '') }}" class="form-control" placeholder=" " />
                                <label for="clave_pila" class="fw-normal">Contraseña Operador de PILA</label>
                            </div>
                        </div>
                    @endif
                </div>

                <div id="inputs-container-pila">

                </div>

                <div class="col-12 mb-3" id="button-pila">
                    <button class="btn btn-success btn-sm" type="button" id="add-input-pila">Agregar usuario
                        Operador de PILA</button>
                </div>


                  <div class="row">
                    @if ($usuarios_camaracomercio)
                        <div class="col-6 px-0">
                            @foreach ($usuarios_camaracomercio as $usuario_camaracomercio)
                                <div class="col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="usuario_camaracomercio" name="usuario_camaracomercio[]"
                                            value="{{ old('usuario_camaracomercio', $usuario_camaracomercio) }}" class="form-control"
                                            placeholder=" " />
                                        <label for="usuario_camaracomercio" class="fw-normal">Usuario Cámara de Comercio</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-6 px-0">
                            @foreach ($clave_camaracomercio as $clave)
                                <div class="col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="camaracomercioclaveportal" name="camaracomercioclaveportal[]"
                                            value="{{ old('camaracomercioclaveportal', $clave) }}" class="form-control"
                                            placeholder=" " />
                                        <label for="camaracomercioclaveportal" class="fw-normal">Contraseña Cámara de Comercio</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col-xl-6">
                            <div class="form-floating mb-3">
                                <input type="text" id="usuario_camaracomercio" name="usuario_camaracomercio[]"
                                    value="{{ old('usuario_camaracomercio', '') }}" class="form-control" placeholder=" " />
                                <label for="usuario_camaracomercio" class="fw-normal">Usuario Cámara de Comercio</label>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-floating mb-3">
                                <input type="text" id="camaracomercioclaveportal" name="camaracomercioclaveportal[]"
                                    value="{{ old('camaracomercioclaveportal', '') }}" class="form-control" placeholder=" " />
                                <label for="camaracomercioclaveportal" class="fw-normal">Contraseña Cámara de Comercio</label>
                            </div>
                        </div>
                    @endif
                </div>

                <div id="inputs-container-camaracomercio">

                </div>

                <div class="col-12 mb-3" id="button-camaracomercio">
                    <button class="btn btn-success btn-sm" type="button" id="add-input-camaracomercio">Agregar usuario
                        Cámara de Comercio</button>
                </div>
            @else
                <div class="col-xl-6">
                    <div class="form-floating mb-3">
                        <input type="text" id="usuario_ica" name="usuario_ica[]"
                            value="{{ old('usuario_ica', $empresa->usuario_ica) }}" class="form-control"
                            placeholder=" " />
                        <label for="usuario_ica" class="fw-normal">Usuario ICA portal </label>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-floating mb-3">
                        <input type="text" id="icaclaveportal" name="icaclaveportal[]"
                            value="{{ old('icaclaveportal', $empresa->icaclaveportal) }}" class="form-control"
                            placeholder=" " />
                        <label for="icaclaveportal" class="fw-normal">ICA contraseña portal </label>
                    </div>
                </div>


                <div id="inputs-container-ica">
                    <!-- Aquí se agregarán los nuevos inputs -->

                </div>

                <div class="col-12 mb-3" id="button-ica">
                    <button class="btn btn-success btn-sm" type="button" id="add-input-ica">Agregar usuario
                        ICA</button>
                </div>

                <div class="col-xl-6">
                    <div class="form-floating mb-3">
                        <input type="text" id="usuario_eps" name="usuario_eps[]"
                            value="{{ old('usuario_eps', $empresa->usuario_eps) }}" class="form-control"
                            placeholder=" " />
                        <label for="usuario_eps" class="fw-normal">Usuario EPS </label>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-floating mb-3">
                        <input type="text" id="usuario_clave_eps" name="usuario_clave_eps[]"
                            value="{{ old('usuario_clave_eps', $empresa->usuario_clave_eps) }}" class="form-control"
                            placeholder=" " />
                        <label for="usuario_clave_eps" class="fw-normal">Contraseña EPS</label>
                    </div>
                </div>


                <div id="inputs-container-eps">
                    <!-- Aquí se agregarán los nuevos inputs -->

                </div>

                <div class="col-12 mb-3" id="button-eps">
                    <button class="btn btn-success btn-sm" type="button" id="add-input-eps">Agregar usuario
                        EPS</button>
                </div>

                <div class="col-xl-6">
                    <div class="form-floating mb-3">
                        <input type="text" id="usuario_afp" name="usuario_afp[]"
                            value="{{ old('usuario_afp', $empresa->usuario_afp) }}" class="form-control"
                            placeholder=" " />
                        <label for="usuario_afp" class="fw-normal">Usuario AFP </label>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-floating mb-3">
                        <input type="text" id="clave_afp" name="clave_afp[]"
                            value="{{ old('clave_afp', $empresa->clave_afp) }}" class="form-control"
                            placeholder=" " />
                        <label for="clave_afp" class="fw-normal">Contraseña AFP</label>
                    </div>
                </div>


                <div id="inputs-container-afp">
                    <!-- Aquí se agregarán los nuevos inputs -->

                </div>

                <div class="col-12 mb-3" id="button-afp">
                    <button class="btn btn-success btn-sm" type="button" id="add-input-afp">Agregar usuario
                        AFP</button>
                </div>

                 <div class="col-xl-6">
                    <div class="form-floating mb-3">
                        <input type="text" id="usuario_pila" name="usuario_pila[]"
                            value="{{ old('usuario_pila', $empresa->usuario_pila) }}" class="form-control"
                            placeholder=" " />
                        <label for="usuario_pila" class="fw-normal">Usuario Operador de PILA </label>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-floating mb-3">
                        <input type="text" id="clave_pila" name="clave_pila[]"
                            value="{{ old('clave_pila', $empresa->clave_pila) }}" class="form-control"
                            placeholder=" " />
                        <label for="clave_pila" class="fw-normal">Contraseña Operador de PILA</label>
                    </div>
                </div>


                <div id="inputs-container-pila">
                    <!-- Aquí se agregarán los nuevos inputs -->

                </div>

                <div class="col-12 mb-3" id="button-pila">
                    <button class="btn btn-success btn-sm" type="button" id="add-input-pila">Agregar usuario
                        Operador de PILA</button>
                </div>

                 <div class="col-xl-6">
                    <div class="form-floating mb-3">
                        <input type="text" id="usuario_camaracomercio" name="usuario_camaracomercio[]"
                            value="{{ old('usuario_camaracomercio', $empresa->usuario_camaracomercio) }}" class="form-control"
                            placeholder=" " />
                        <label for="usuario_camaracomercio" class="fw-normal">Usuario Cámara de Comercio </label>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="form-floating mb-3">
                        <input type="text" id="camaracomercioclaveportal" name="camaracomercioclaveportal[]"
                            value="{{ old('camaracomercioclaveportal', $empresa->camaracomercioclaveportal) }}" class="form-control"
                            placeholder=" " />
                        <label for="camaracomercioclaveportal" class="fw-normal">Contraseña Cámara de Comercio</label>
                    </div>
                </div>


                <div id="inputs-container-camaracomercio">
                    <!-- Aquí se agregarán los nuevos inputs -->

                </div>

                <div class="col-12 mb-3" id="button-camaracomercio">
                    <button class="btn btn-success btn-sm" type="button" id="add-input-camaracomercio">Agregar usuario
                        Cámara de Comercio</button>
                </div>
            @endif
        </div>
    </div>
</div>
