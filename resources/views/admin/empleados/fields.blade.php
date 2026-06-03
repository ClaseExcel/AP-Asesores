<div class="row">

    <div class="col-12 col-xl-6">
        <div class="form-floating mb-3">
            <select id="tipo_identificacion" name="tipo_identificacion" class="form-select">
                <option value="" {{ old('tipo_identificacion') == '' ? 'selected' : '' }}>Selecciona una opción
                </option>
                @foreach ($tipos_identificacion as $tipo)
                    <option value="{{ $tipo }}"
                        {{ old('tipo_identificacion', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_identificacion : '') == $tipo ? 'selected' : '' }}>
                        {{ $tipo }} </option>
                @endforeach
            </select>
            <label for="frecuencias" class="fw-normal">Tipo de identificación <b class="text-danger">*</b></label>
            @if ($errors->has('tipo_identificacion'))
                <span id="tipo_identificacion"
                    class="text-danger text-sm">{{ $errors->first('tipo_identificacion') }}</span>
            @endif
        </div>
    </div>

    <div class="col-12 col-xl-6">
        <div class="form-floating mb-3">
            <input type="number" id="cedula" name="cedula"
                value="{{ old('cedula', $empleado && $empleado->usuarios ? $empleado->usuarios->cedula : '') }}"
                class="form-control" placeholder=" " required />
            <label for="cedula" class="fw-normal">Cédula <b class="text-danger">*</b></label>
            @if ($errors->has('cedula'))
                <span id="cedula" class="text-danger">{{ $errors->first('cedula') }}</span>
            @endif
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-floating mb-3">
            <input type="text" id="nombres" name="nombres"
                value="{{ old('nombres', $empleado ? $empleado->nombres : '') }}" class="form-control" placeholder=" "
                required />
            <label for="nombres" class="fw-normal">Nombres <b class="text-danger">*</b></label>
            @if ($errors->has('nombres'))
                <span id="nombres" class="text-danger">{{ $errors->first('nombres') }}</span>
            @endif
        </div>

    </div>
    <div class="col-12 col-md-6">
        <div class="form-floating mb-3">
            <input type="text" id="apellidos" name="apellidos"
                value="{{ old('apellidos', $empleado ? $empleado->apellidos : '') }}" class="form-control"
                placeholder=" " required />
            <label for="apellidos" class="fw-normal"> Apellidos <b class="text-danger">*</b></label>
            @if ($errors->has('apellidos'))
                <span id="apellidos" class="text-danger">{{ $errors->first('apellidos') }}</span>
            @endif
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-floating mb-3">
            <input type="text" id="lugar_nacimiento" name="lugar_nacimiento"
                value="{{ old('lugar_nacimiento', $empleado && $empleado->usuarios ? $empleado->usuarios->lugar_nacimiento : '') }}"
                class="form-control" placeholder=" "/>
            <label for="lugar_nacimiento" class="fw-normal"> Lugar de nacimiento </label>
            @if ($errors->has('lugar_nacimiento'))
                <span id="lugar_nacimiento" class="text-danger">{{ $errors->first('lugar_nacimiento') }}</span>
            @endif
        </div>
    </div>

    <div class="col-12 col-md-6">
        <div class="form-floating mb-3">
            <input type="text" id="nacionalidad" name="nacionalidad"
                value="{{ old('nacionalidad', $empleado && $empleado->usuarios ? $empleado->usuarios->nacionalidad : '') }}" class="form-control"
                placeholder=" "/>
            <label for="nacionalidad" class="fw-normal"> Nacionalidad </label>
            @if ($errors->has('nacionalidad'))
                <span id="nacionalidad" class="text-danger">{{ $errors->first('nacionalidad') }}</span>
            @endif
        </div>
    </div>

    <div class="col-xl-12">
        <div class="form-floating mb-3">
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                value="{{ old('fecha_nacimiento', $empleado && $empleado->usuarios ? $empleado->usuarios->fecha_nacimiento : '') }}"
                class="form-control" placeholder="" required />
            <label for="fecha_nacimiento" class="fw-normal">Fecha de nacimiento <b class="text-danger">*</b></label>
            @error('fecha_nacimiento')
                <p class="text-danger text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-12 col-xl-12">
        <div class="form-floating mb-3">
            <select name="tipo_contrato" id="tipo_contrato" class="form-select" required>
                <option value="">Selecciona una opción</option>
                <option value="Prestación de servicios"
                    {{ old('tipo_contrato', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_contrato : '') == 'Prestación de servicios' ? 'selected' : '' }}>
                    Prestación de servicios</option>
                <option value="Aprendiz SENA etapa electiva (Formativa)"
                    {{ old('tipo_contrato', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_contrato : '') == 'Aprendiz SENA etapa electiva (Formativa)' ? 'selected' : '' }}>
                    Aprendiz SENA etapa electiva (Formativa)</option>
                <option value="Aprendiz SENA etapa práctica"
                    {{ old('tipo_contrato', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_contrato : '') == 'Aprendiz SENA etapa práctica' ? 'selected' : '' }}>
                    Aprendiz SENA etapa práctica</option>
                <option value="Aprendiz universitario"
                    {{ old('tipo_contrato', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_contrato : '') == 'Aprendiz universitario' ? 'selected' : '' }}>
                    Aprendiz universitario</option>
                <option value="Estudiante pasantía"
                    {{ old('tipo_contrato', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_contrato : '') == 'Estudiante pasantía' ? 'selected' : '' }}>
                    Estudiante pasantía</option>
                <option value="Obra labor"
                    {{ old('tipo_contrato', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_contrato : '') == 'Obra labor' ? 'selected' : '' }}>
                    Obra labor</option>
                <option value="Pensionado"
                    {{ old('tipo_contrato', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_contrato : '') == 'Pensionado' ? 'selected' : '' }}>
                    Pensionado</option>
                <option value="Término fijo"
                    {{ old('tipo_contrato', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_contrato : '') == 'Término fijo' ? 'selected' : '' }}>
                    Término fijo</option>
                <option value="Término indefinido"
                    {{ old('tipo_contrato', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_contrato : '') == 'Término indefinido' ? 'selected' : '' }}>
                    Término indefinido</option>
            </select>
            <label for="tipo_contrato" class="fw-normal">Tipo de contrato <b class="text-danger">*</b></label>
            @error('tipo_contrato')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-12 col-xl-12">
        <div class="form-floating mb-3">
            <select name="tipo_salario" id="tipo_salario" class="form-select" required>
                <option value="">Selecciona una opción</option>
                <option value="Fijo"
                    {{ old('tipo_salario', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_salario : '') == 'Fijo' ? 'selected' : '' }}>
                    Fijo</option>
                <option value="Variable"
                    {{ old('tipo_salario', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_salario : '') == 'Variable' ? 'selected' : '' }}>
                    Variable</option>
                <option value="Días u horas"
                    {{ old('tipo_salario', $empleado && $empleado->usuarios ? $empleado->usuarios->tipo_salario : '') == 'Días u horas' ? 'selected' : '' }}>
                    Días u horas</option>
            </select>
            <label for="tipo_salario" class="fw-normal">Tipo de salario </label>
            @error('tipo_salario')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-12 col-xl-12">
        <div class="form-floating mb-3">
            <input type="number" id="salario" name="salario"
                value="{{ old('salario', $empleado && $empleado->usuarios ? $empleado->usuarios->salario : '') }}"
                class="form-control" placeholder="" />
            <label for="salario" class="fw-normal">Salario </label>
            @error('salario')
                <p id="salario" class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-12 col-xl-12">
        <div class="form-floating mb-3">
            <select name="cesantias" id="cesantias" class="form-select" required>
                <option value="">Selecciona una opción</option>
                <option value="Porvenir"
                    {{ old('cesantias', $empleado && $empleado->usuarios ? $empleado->usuarios->cesantias : '') == 'Porvenir' ? 'selected' : '' }}>
                    Porvenir</option>
                <option value="Protección"
                    {{ old('cesantias', $empleado && $empleado->usuarios ? $empleado->usuarios->cesantias : '') == 'Protección' ? 'selected' : '' }}>
                    Protección</option>
                <option value="Colfondos"
                    {{ old('cesantias', $empleado && $empleado->usuarios ? $empleado->usuarios->cesantias : '') == 'Colfondos' ? 'selected' : '' }}>
                    Colfondos</option>
                <option value="Fondo nacional del ahorro"
                    {{ old('cesantias', $empleado && $empleado->usuarios ? $empleado->usuarios->cesantias : '') == 'Fondo nacional del ahorro' ? 'selected' : '' }}>
                    Fondo nacional del ahorro</option>
                <option value="Skandia"
                    {{ old('cesantias', $empleado && $empleado->usuarios ? $empleado->usuarios->cesantias : '') == 'Skandia' ? 'selected' : '' }}>
                    Skandia</option>
                <option value="NO REGISTRA"
                    {{ old('cesantias', $empleado && $empleado->usuarios ? $empleado->usuarios->cesantias : '') == 'NO REGISTRA' ? 'selected' : '' }}>
                    NO REGISTRA</option>
            </select>
            <label for="cesantias" class="fw-normal">Cesantías </label>
            @error('cesantias')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input type="date" id="fecha_contrato" name="fecha_contrato"
                value="{{ old('fecha_contrato', $empleado && $empleado->usuarios ? $empleado->usuarios->fecha_contrato : '') }}"
                class="form-control" placeholder="" required />
            <label for="fecha_contrato" class="fw-normal">Fecha de inicio de contrato <b
                    class="text-danger">*</b></label>
            @error('fecha_contrato')
                <p class="text-danger text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

     <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input type="date" id="fecha_fin_contrato" name="fecha_fin_contrato"
                value="{{ old('fecha_fin_contrato', $empleado && $empleado->usuarios ? $empleado->usuarios->fecha_fin_contrato : '') }}"
                class="form-control" placeholder="" />
            <label for="fecha_fin_contrato" class="fw-normal">Fecha de fin de contrato </label>
            @error('fecha_fin_contrato')
                <p class="text-danger text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input type="date" id="fecha_ingreso" name="fecha_ingreso"
                value="{{ old('fecha_ingreso', $empleado && $empleado->usuarios ? $empleado->usuarios->fecha_ingreso : '') }}"
                class="form-control" placeholder="" required />
            <label for="fecha_ingreso" class="fw-normal">Fecha de ingreso <b class="text-danger">*</b></label>
            @error('fecha_ingreso')
                <p class="text-danger text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input type="date" id="fecha_retiro" name="fecha_retiro"
                value="{{ old('fecha_retiro', $empleado && $empleado->usuarios ? $empleado->usuarios->fecha_retiro : '') }}"
                class="form-control" placeholder="" />
            <label for="fecha_retiro" class="fw-normal">Fecha de retiro </label>
            @error('fecha_retiro')
                <p class="text-danger text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-12 col-xl-12">
        <div class="form-floating mb-3">
            <input type="tel" id="numero_contacto" name="numero_contacto"
                value="{{ old('numero_contacto', $empleado ? $empleado->numero_contacto : '') }}"
                class="form-control" placeholder=" " required />
            <label for="numero_contacto" class="fw-normal">Número contacto <b class="text-danger">*</b></label>
            @if ($errors->has('numero_contacto'))
                <span id="numero_contacto" class="text-danger">{{ $errors->first('numero_contacto') }}</span>
            @endif
        </div>
    </div>

    <div class="col-12 col-xl-6">
        <div class="form-floating mb-3">
            <input type="text" id="email" name="email"
                value="{{ old('email', $empleado ? $empleado->correo_electronico : '') }}" class="form-control"
                placeholder=" " required />
            <label for="email" class="fw-normal">Correo electrónico <b class="text-danger">*</b></label>
            @if ($errors->has('email'))
                <span id="email" class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
    </div>
    <div class="col-12 col-xl-6">
        <div class="form-floating mb-3">
            <input type="text" id="correos_secundarios" name="correos_secundarios"
                value="{{ old('correos_secundarios', $empleado ? $empleado->correos_secundarios : '') }}"
                class="form-control" placeholder=" " />
            <label for="correos_secundarios" class="fw-normal">Correos secundarios</label>
            <small>
                <i class="text-primary"><i class="fas fa-info-circle"></i> Ingresar más correos separalos por
                    comas.</i>
            </small>
            @if ($errors->has('correos_secundarios'))
                <span id="correos_secundarios" class="text-danger">
                    {{ $errors->first('correos_secundarios') }}</span>
            @endif
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }} " type="text"
                placeholder="" name="direccion" id="direccion"
                value="{{ old('direccion', $empleado && $empleado->usuarios ? $empleado->usuarios->direccion : '') }}">
            <label class="fw-normal" for="direccion">Dirección </label>
            @error('direccion')
                <p class="text-danger text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input class="form-control {{ $errors->has('barrio') ? 'is-invalid' : '' }} " type="text"
                placeholder="" name="barrio" id="barrio"
                value="{{ old('barrio', $empleado && $empleado->usuarios ? $empleado->usuarios->barrio : '') }}">
            <label class="fw-normal" for="barrio">Barrio </label>
            @error('barrio')
                <p class="text-danger text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input class="form-control" list="datalistEPS" placeholder="Escribe Para Buscar..." name="EPS"
                id="eps" autocomplete="off">
            <datalist id="datalistEPS">
                @foreach ($eps as $eps)
                    <option value="{{ $eps->razon_social }}" data-id="{{ $eps->id }}"></option>
                @endforeach
            </datalist>
            <input type="hidden" id="epsexistente"
                value="{{ $empleado && $empleado->usuarios ? $empleado->usuarios->EPS : '' }}">
            <label class="fw-normal">EPS </label>
            @if ($errors->has('EPS'))
                <span id="EPS" class="text-danger text-sm ">{{ $errors->first('EPS') }}</span>
            @endif
        </div>
    </div>

    <script>
        var valorExistente = document.getElementById('epsexistente').value;

        if (valorExistente) {
            var datalistOptions = document.getElementById('datalistEPS');
            var options = datalistOptions.getElementsByTagName('option');

            for (var i = 0; i < options.length; i++) {
                // var valorDataId = options[i].getAttribute('data-id');
                if (options[i].value == valorExistente) {
                    document.getElementById('eps').value = options[i].value;
                    break;
                }
            }
        }
    </script>

    <div class="col-12 col-xl-6">
        <div class="form-floating mb-3">
            <select name="nivel_riesgo" id="nivel_riesgo" class="form-select">
                <option value="">Selecciona una opción</option>
                <option value="I"
                    {{ old('nivel_riesgo', $empleado && $empleado->usuarios ? $empleado->usuarios->nivel_riesgo : '') == 'I' ? 'selected' : '' }}>
                    I</option>
                <option value="II"
                    {{ old('nivel_riesgo', $empleado && $empleado->usuarios ? $empleado->usuarios->nivel_riesgo : '') == 'II' ? 'selected' : '' }}>
                    II</option>
                <option value="III"
                    {{ old('nivel_riesgo', $empleado && $empleado->usuarios ? $empleado->usuarios->nivel_riesgo : '') == 'III' ? 'selected' : '' }}>
                    III</option>
                <option value="IV"
                    {{ old('nivel_riesgo', $empleado && $empleado->usuarios ? $empleado->usuarios->nivel_riesgo : '') == 'IV' ? 'selected' : '' }}>
                    IV</option>
                <option value="V"
                    {{ old('nivel_riesgo', $empleado && $empleado->usuarios ? $empleado->usuarios->nivel_riesgo : '') == 'V' ? 'selected' : '' }}>
                    V</option>
                <option value="NO APLICA"
                    {{ old('nivel_riesgo', $empleado && $empleado->usuarios ? $empleado->usuarios->nivel_riesgo : '') == 'NO APLICA' ? 'selected' : '' }}>
                    NO APLICA</option>
            </select>
            <label for="nivel_riesgo" class="fw-normal">Nivel de riesgo </label>
            @error('nivel_riesgo')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input class="form-control" list="datalistAFP" placeholder="Escribe Para Buscar..." name="fondo_pension"
                id="fondo_pension" autocomplete="off">
            <datalist id="datalistAFP">
                @foreach ($afp as $afp)
                    <option value="{{ $afp->razon_social }}" data-id="{{ $afp->id }}"></option>
                @endforeach
            </datalist>
            <input type="hidden" id="afpexistente"
                value="{{ $empleado && $empleado->usuarios ? $empleado->usuarios->fondo_pension : '' }}">
            <label class="fw-normal">Fondo de pensión </label>
            @if ($errors->has('fondo_pension'))
                <span id="fondo_pension" class="text-danger text-sm ">{{ $errors->first('fondo_pension') }}</span>
            @endif
        </div>
    </div>

    <script>
        var valorExistente = document.getElementById('afpexistente').value;

        if (valorExistente) {
            var datalistOptions = document.getElementById('datalistAFP');
            var options = datalistOptions.getElementsByTagName('option');

            for (var i = 0; i < options.length; i++) {
                // var valorDataId = options[i].getAttribute('data-id');
                if (options[i].value == valorExistente) {
                    document.getElementById('fondo_pension').value = options[i].value;
                    break;
                }
            }
        }
    </script>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input class="form-control" list="datalistCCF" placeholder="Escribe Para Buscar..."
                name="caja_compensacion" id="caja_compensacion" autocomplete="off">
            <datalist id="datalistCCF">
                @foreach ($ccf as $ccf)
                    <option value="{{ $ccf->razon_social }}" data-id="{{ $ccf->id }}"></option>
                @endforeach
            </datalist>
            <input type="hidden" id="ccfexistente"
                value="{{ $empleado && $empleado->usuarios ? $empleado->usuarios->caja_compensacion : '' }}">
            <label class="fw-normal">Caja de compensación </label>
            @if ($errors->has('caja_compensacion'))
                <span id="caja_compensacion"
                    class="text-danger text-sm ">{{ $errors->first('caja_compensacion') }}</span>
            @endif
        </div>
    </div>

    <script>
        var valorExistente = document.getElementById('ccfexistente').value;

        if (valorExistente) {
            var datalistOptions = document.getElementById('datalistCCF');
            var options = datalistOptions.getElementsByTagName('option');

            for (var i = 0; i < options.length; i++) {
                // var valorDataId = options[i].getAttribute('data-id');
                if (options[i].value == valorExistente) {
                    document.getElementById('caja_compensacion').value = options[i].value;
                    break;
                }
            }
        }
    </script>

    <div class="col-xl-12 ml-2">
        <div class="form-check mb-3">
            <input class="form-check-input" name="funeraria" type="checkbox"
                value="{{ $empleado && $empleado->usuarios ? $empleado->usuarios->caja_compensacion : '' }}"
                {{ ($empleado && $empleado->usuarios ? $empleado->usuarios->caja_compensacion : '') == 'SI' ? 'checked' : '' }}
                id="funeraria">
            <label class="form-check-label" for="funeraria">
                ¿Funeraria?
            </label>
        </div>
    </div>
    <script>
        document.getElementById('funeraria').addEventListener('change', function() {
            if (this.checked) {
                this.value = 'SI';
            } else {
                this.value = '';
            }
        });
    </script>

    <div class="col-xl-12">
        <div class="form-floating mb-3">
            <input class="form-control {{ $errors->has('contrasena_eps') ? 'is-invalid' : '' }}"
                value="{{ old('contrasena_eps', $empleado && $empleado->usuarios ? $empleado->usuarios->contrasena_eps : '') }}"
                type="text" placeholder="" name="contrasena_eps" id="contrasena_eps"
                autocomplete="contrasena_eps">
            <label class="fw-normal" for="contrasena_eps">Contraseña EPS </label>
            @error('contrasena_eps')
                <p class="text-danger text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-12 col-xl-4">
        <div class="form-floating mb-3">
            <select id="cargos" name="cargo_id" class="form-select" required>
                <option value="">Selecciona un cargo</option>
                @foreach ($cargo as $id => $nombre)
                    <option value="{{ old('cargo_id', $id) }}"
                        {{ $empleado && $empleado->usuarios && $empleado->usuarios->cargo_id == $id ? 'selected' : '' }}>
                        {{ $nombre }}</option>
                @endforeach
            </select>
            <label for="cargos" class="fw-normal">Cargo <b class="text-danger">*</b></label>

            @if ($errors->has('cargo_id'))
                <p id="cargo_id" class="text-danger">{{ $errors->first('cargo_id') }}</p>
            @endif
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="form-floating mb-3">
            <select id="roles" name="role_id" class="form-select" required>
                <option value="">Selecciona un rol</option>
                @foreach ($roles as $id => $rol)
                    <option value="{{ old('role_id', $id) }}"
                        {{ $empleado && $empleado->usuarios && $empleado->usuarios->role_id == $id ? 'selected' : '' }}>
                        {{ $rol }}</option>
                @endforeach
            </select>

            <label for="roles" class="fw-normal">Roles <b class="text-danger">*</b></label>

            @if ($errors->has('role_id'))
                <span id="role_id" class="text-danger">{{ $errors->first('role_id') }}</span>
            @endif
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="form-floating">
            <select id="empresas" name="empresa_id" class="form-select" required>
                <option value="">Selecciona una empresa</option>
                @foreach ($empresas as $id => $razon_social)
                    <option value="{{ $id }}"
                        {{ $empleado && $empleado->empresa_id == $id ? 'selected' : '' }}>
                        {{ $razon_social }}
                    </option>
                @endforeach
            </select>

            <label for="empresas" class="fw-normal">Empresa <b class="text-danger">*</b></label>

            @if ($errors->has('empresa_id'))
                <span id="empresa_id" class="text-danger">{{ $errors->first('empresa_id') }}
                </span>
            @endif
        </div>
    </div>
    <div class="col-12 col-xl-12">
        <div class="form-floating" style="margin-bottom: 20px;">
            <div class="row d-flex justify-content-between ">
                <div class="col-12">
                    <label>
                        Empresas secundarias
                    </label> <br>
                    <label class="fw-normal">
                        Seleccionar una Empresa o varias:
                    </label>
                </div>
                <div class="col">
                    <div class="btn-group mb-2">
                        <button id="selectAllButtonEmpresasSecundarias" type="button"
                            class="btn btn-outline-info btn-xs  btn-radius px-4 me-2"
                            style="border-radius: 5px">Seleccionar Todo</button>
                        <button id="deselectAllButtonEmpresasSecundarias" type="button"
                            class="btn btn-outline-info btn-xs btn-radius px-4 "
                            style="border-radius: 5px">Deseleccionar Todo</button>
                    </div>
                </div>
            </div>
            <select name="empresas_secundarias[]" id="empresas_secundarias" class="form-select" multiple>
                @foreach ($empresas as $id => $razon_social)
                    <option value={{ $id }}
                        {{ collect(json_decode($empleado->empresas_secundarias))->contains($id) ? 'selected' : '' }}>
                        {{ $id . ' - ' . $razon_social }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('empresas_secundarias'))
                <span id="empresas_secundarias"
                    class="text-danger">{{ $errors->first('empresas_secundarias') }}</span>
            @endif
        </div>
    </div>

    @if (request()->routeIs('admin.empleados.edit'))
        <div class="col-xl-12">
            <div class="form-floating mb-3">
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                    name="password" id="password" autocomplete="password">
                <label class="fw-normal" for="password">Contraseña</label>
                <small>Dejar vacío si no se quiere cambiar la contraseña</small>
            </div>
        </div>
    @else
        <div class="col-12 col-xl-12">
            <div class="form-floating mb-3">
                <input type="password" id="contraseña" name="password" class="form-control" placeholder=" " />
                <label for="contraseña" class="fw-normal">Contraseña <b class="text-danger">*</b></label>
            </div>
            @if ($errors->has('password'))
                <span id="password" class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
    @endif


    <div class="col-12 col-xl-6">
        <label class="fw-normal" for="role_id">Documento exámen laboral </label>
        <div class="input-group mb-3">
            <label class="input-group-text bg-transparent" for="documento_examen"><i
                    class="fas fa-file-upload"></i></label>
            <input type="file" id="documento_examen" name="documento_examen" class="form-control" />
            @error('documento_examen')
                <p class="text-danger text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-12 col-xl-6">
        <label class="fw-normal" for="documento_afiliacion">Documento de afiliación </label>
        <div class="input-group mb-3">
            <label class="input-group-text bg-transparent" for="documento_afiliacion"><i
                    class="fas fa-file-upload"></i></label>
            <input type="file" id="documento_afiliacion" name="documento_afiliacion" class="form-control" />
            @error('documento_afiliacion')
                <p class="text-danger text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-12 col-xl-6">
        <label class="fw-normal" for="documento_contrato">Documento contrato </label>
        <div class="input-group mb-3">
            <label class="input-group-text bg-transparent" for="documento_contrato"><i
                    class="fas fa-file-upload"></i></label>
            <input type="file" id="documento_contrato" name="documento_contrato" class="form-control" />
            @error('documento_contrato')
                <p class="text-danger text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>


    <div class="col-12 col-xl-6">
        <label class="fw-normal" for="documento_otros">Documento otros </label>
        <div class="input-group mb-3">
            <label class="input-group-text bg-transparent" for="documento_otros"><i
                    class="fas fa-file-upload"></i></label>
            <input type="file" id="documento_otros" name="documento_otros" class="form-control" />
            @error('documento_otros')
                <p class="text-danger text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
