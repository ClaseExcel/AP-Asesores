<div class="col-12 col-xl-6">
    <div class="form-floating mb-3">
        <select id="tipo_identificacion" name="tipo_identificacion" class="form-select">
            <option value="" {{ old('tipo_identificacion') == '' ? 'selected' : '' }}>Selecciona una opción
            </option>
            @foreach ($tipos_identificacion as $tipo)
                <option value="{{ $tipo }}"
                    {{ old('tipo_identificacion', $user->tipo_identificacion) == $tipo ? 'selected' : '' }}>
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

<div class="col-md-6">
    <div class="form-floating mb-3">
        <input class="form-control {{ $errors->has('cedula') ? 'is-invalid' : '' }}" type="text" name="cedula"
            id="cedula" value="{{ old('cedula', $user->cedula) }}" required>
        <label class="fw-normal" for="cedula">Cédula <b class="text-danger">*</b></label>
        @if ($errors->has('cedula'))
            <span class="text-danger">{{ $errors->first('cedula') }}</span>
        @endif
    </div>
</div>

<div class="col-md-6">
    <div class="form-floating mb-3">
        <input class="form-control {{ $errors->has('nombres') ? 'is-invalid' : '' }}" type="text" name="nombres"
            id="nombres" value="{{ old('nombres', $user->nombres) }}" required>
        <label class="fw-normal" for="nombres">Nombres <b class="text-danger">*</b></label>
        @if ($errors->has('nombres'))
            <span class="text-danger">{{ $errors->first('nombres') }}</span>
        @endif

    </div>
</div>

<div class="col-md-6">
    <div class="form-floating mb-3">
        <input class="form-control {{ $errors->has('apellidos') ? 'is-invalid' : '' }}" type="text" name="apellidos"
            id="apellidos" value="{{ old('apellidos', $user->apellidos) }}" required>
        <label class="fw-normal" for="apellidos">Apellidos <b class="text-danger">*</b></label>
        @if ($errors->has('apellidos'))
            <span class="text-danger">{{ $errors->first('apellidos') }}</span>
        @endif

    </div>
</div>

<div class="col-12 col-md-6">
    <div class="form-floating mb-3">
        <input type="text" id="lugar_nacimiento" name="lugar_nacimiento"
            value="{{ old('lugar_nacimiento', $user->lugar_nacimiento) }}"
            class="form-control" placeholder=" " />
        <label for="lugar_nacimiento" class="fw-normal"> Lugar de nacimiento </label>
        @if ($errors->has('lugar_nacimiento'))
            <span id="lugar_nacimiento" class="text-danger">{{ $errors->first('lugar_nacimiento') }}</span>
        @endif
    </div>
</div>

<div class="col-12 col-md-6">
    <div class="form-floating mb-3">
        <input type="text" id="nacionalidad" name="nacionalidad"
            value="{{ old('nacionalidad', $user->nacionalidad) }}"
            class="form-control" placeholder=" " />
        <label for="nacionalidad" class="fw-normal"> Nacionalidad </label>
        @if ($errors->has('nacionalidad'))
            <span id="nacionalidad" class="text-danger">{{ $errors->first('nacionalidad') }}</span>
        @endif
    </div>
</div>

<div class="col-xl-12">
    <div class="form-floating mb-3">
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
            value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}" class="form-control" placeholder=""
            required />
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
                {{ old('tipo_contrato', $user->tipo_contrato) == 'Prestación de servicios' ? 'selected' : '' }}>
                Prestación de servicios</option>
            <option value="Aprendiz SENA etapa electiva (Formativa)"
                {{ old('tipo_contrato', $user->tipo_contrato) == 'Aprendiz SENA etapa electiva (Formativa)' ? 'selected' : '' }}>
                Aprendiz SENA etapa electiva (Formativa)</option>
            <option value="Aprendiz SENA etapa práctica"
                {{ old('tipo_contrato', $user->tipo_contrato) == 'Aprendiz SENA etapa práctica' ? 'selected' : '' }}>
                Aprendiz SENA etapa práctica</option>
            <option value="Aprendiz universitario"
                {{ old('tipo_contrato', $user->tipo_contrato) == 'Aprendiz universitario' ? 'selected' : '' }}>
                Aprendiz universitario</option>
            <option value="Estudiante pasantía"
                {{ old('tipo_contrato', $user->tipo_contrato) == 'Estudiante pasantía' ? 'selected' : '' }}>
                Estudiante pasantía</option>
            <option value="Obra o labor"
                {{ old('tipo_contrato', $user->tipo_contrato) == 'Obra o labor' ? 'selected' : '' }}>
                Obra o labor</option>
            <option value="Pensionado"
                {{ old('tipo_contrato', $user->tipo_contrato) == 'Pensionado' ? 'selected' : '' }}>
                Pensionado</option>
            <option value="Término fijo"
                {{ old('tipo_contrato', $user->tipo_contrato) == 'Término fijo' ? 'selected' : '' }}>
                Término fijo</option>
            <option value="Término indefinido"
                {{ old('tipo_contrato', $user->tipo_contrato) == 'Término indefinido' ? 'selected' : '' }}>
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
            <option value="Fijo" {{ old('tipo_salario', $user->tipo_salario) == 'Fijo' ? 'selected' : '' }}>
                Fijo</option>
            <option value="Variable" {{ old('tipo_salario', $user->tipo_salario) == 'Variable' ? 'selected' : '' }}>
                Variable</option>
            <option value="Días u horas"
                {{ old('tipo_salario', $user->tipo_salario) == 'Días u horas' ? 'selected' : '' }}>
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
        <input type="number" id="salario" name="salario" value="{{ old('salario', $user->salario) }}"
            class="form-control" placeholder="" />
        <label for="salario" class="fw-normal">Salario </label>
        @error('salario')
            <p id="salario" class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="col-12 col-xl-12">
    <div class="form-floating mb-3">
        <select name="cesantias" id="cesantias" class="form-select">
            <option value="">Selecciona una opción</option>
            <option value="Porvenir" {{ old('cesantias', $user->cesantias) == 'Porvenir' ? 'selected' : '' }}>
                Porvenir</option>
            <option value="Protección" {{ old('cesantias', $user->cesantias) == 'Protección' ? 'selected' : '' }}>
                Protección</option>
            <option value="Colfondos" {{ old('cesantias', $user->cesantias) == 'Colfondos' ? 'selected' : '' }}>
                Colfondos</option>
            <option value="Fondo nacional del ahorro"
                {{ old('cesantias', $user->cesantias) == 'Fondo nacional del ahorro' ? 'selected' : '' }}>
                Fondo nacional del ahorro</option>
            <option value="Skandia" {{ old('cesantias', $user->cesantias) == 'Skandia' ? 'selected' : '' }}>
                Skandia</option>
            <option value="NO REGISTRA" {{ old('cesantias', $user->cesantias) == 'NO REGISTRA' ? 'selected' : '' }}>
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
            value="{{ old('fecha_contrato', $user->fecha_contrato) }}" class="form-control" placeholder=""
            required />
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
            value="{{ old('fecha_fin_contrato', $user->fecha_fin_contrato) }}"
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
            value="{{ old('fecha_ingreso', $user->fecha_ingreso) }}" class="form-control" placeholder="" required />
        <label for="fecha_ingreso" class="fw-normal">Fecha de ingreso <b class="text-danger">*</b></label>
        @error('fecha_ingreso')
            <p class="text-danger text-sm">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="col-xl-6">
    <div class="form-floating mb-3">
        <input type="date" id="fecha_retiro" name="fecha_retiro"
            value="{{ old('fecha_retiro', $user->fecha_retiro) }}" class="form-control" placeholder="" />
        <label for="fecha_retiro" class="fw-normal">Fecha de retiro </label>
        @error('fecha_retiro')
            <p class="text-danger text-sm">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="col-xl-6">
    <div class="form-floating mb-3">
        <input class="form-control" type="email" placeholder="" name="email" id="email"
            value="{{ old('email', $user->email) }}" required>
        <label class="fw-normal" for="email">Correo <b class="text-danger">*</b></label>
        @error('email')
            <p class="text-danger text-sm">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="col-xl-6">
    <div class="form-floating mb-3">
        <input type="tel" id="numero_contacto" name="numero_contacto" class="form-control"
            value="{{ old('numero_contacto', $user->numero_contacto) }}" placeholder=" " required />
        <label for="numero_contacto" class="fw-normal">Número contacto <b class="text-danger">*</b></label>
        @error('numero_contacto')
            <p class="text-danger text-sm">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="col-xl-6">
    <div class="form-floating mb-3">
        <input class="form-control" type="text" placeholder="" name="direccion" id="direccion"
            value="{{ old('direccion', $user->direccion) }}">
        <label class="fw-normal" for="direccion">Dirección </label>
        @error('direccion')
            <p class="text-danger text-sm">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="col-xl-6">
    <div class="form-floating mb-3">
        <input class="form-control" type="text" placeholder="" name="barrio" id="barrio"
            value="{{ old('barrio', $user->barrio) }}">
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
        <input type="hidden" id="epsexistente" value="{{ $user->EPS }}">
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
            <option value="I" {{ old('nivel_riesgo', $user->nivel_riesgo) == 'I' ? 'selected' : '' }}>
                I</option>
            <option value="II" {{ old('nivel_riesgo', $user->nivel_riesgo) == 'II' ? 'selected' : '' }}>
                II</option>
            <option value="III" {{ old('nivel_riesgo', $user->nivel_riesgo) == 'III' ? 'selected' : '' }}>
                III</option>
            <option value="IV" {{ old('nivel_riesgo', $user->nivel_riesgo) == 'IV' ? 'selected' : '' }}>
                IV</option>
            <option value="V" {{ old('nivel_riesgo', $user->nivel_riesgo) == 'V' ? 'selected' : '' }}>
                V</option>
            <option value="NO APLICA" {{ old('nivel_riesgo', $user->nivel_riesgo) == 'NO APLICA' ? 'selected' : '' }}>
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
        <input type="hidden" id="afpexistente" value="{{ $user->fondo_pension }}">
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
        <input class="form-control" list="datalistCCF" placeholder="Escribe Para Buscar..." name="caja_compensacion"
            id="caja_compensacion" autocomplete="off">
        <datalist id="datalistCCF">
            @foreach ($ccf as $ccf)
                <option value="{{ $ccf->razon_social }}" data-id="{{ $ccf->id }}"></option>
            @endforeach
        </datalist>
        <input type="hidden" id="ccfexistente" value="{{ $user->caja_compensacion }}">
        <label class="fw-normal">Caja de compensación </label>
        @if ($errors->has('caja_compensacion'))
            <span id="caja_compensacion"
                class="text-danger text-sm ">{{ $errors->first('caja_compensacion') }}</span>
        @endif
    </div>
</div>
<div class="col-xl-12">
    {{-- input para guardar numero tarjeta profesional --}}
    <div class="form-floating mb-3">
        <input type="text" id="tarje_profesional" name="tarje_profesional" class="form-control" placeholder=" "
            value="{{ old('tarje_profesional', $user->tarje_profesional) }}"/>
        <label for="tarje_profesional" class="fw-normal">Tarjeta profesional </label>
        @if ($errors->has('tarje_profesional'))
            <span id="tarje_profesional" class="text-danger">{{ $errors->first('tarje_profesional') }}</span>
        @endif
    </div>
    @if (isset($user->id) && $user->firma != 'default.jpg')
        <div class="card-body bg-light">
            <img src="{{ asset('storage/users_firma/' . $user->firma) }}" class="img-thumbnail" alt="avatar"
                style="max-width: 120px; max-height: 120px;">
        </div>
    @endif
    {{-- input para subir imagen de firma --}}
    <div class="col-12 form-group mb-3 border rounded bg-light py-2">
        <div class="form-group mb-3">
            <label class="fw-normal" for="firma">Agregar firma digital</label>
            <input class="form-control {{ $errors->has('firma') ? 'is-invalid' : '' }}" type="file"
                name="firma" id="firma" accept="image/jpeg, image/png, image/jpg, image/gif">
            @if ($errors->has('firma'))
                <span class="text-danger">{{ $errors->first('firma') }}</span>
            @endif
        </div>

        <div class="text-center">
            <img id="avatar_preview" src="#" alt="Avatar Preview"
                style="display: none; max-width: 120px; max-height: 120px;" class="rounded mx-auto">
            <small id="text_preview" style="display: none">Vista previa</small>
        </div>
    </div>
</div>
{{-- vista previa de la imagen de avatar --}}
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('avatar_preview').src = e.target.result;
                document.getElementById('avatar_preview').style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);

            //hacer visible el texto de vista previa
            document.getElementById('text_preview').style.display = 'block';
        }
    }

    document.getElementById('firma').addEventListener('change', function() {
        readURL(this);
    });
</script>

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
        <input class="form-check-input" name="funeraria" type="checkbox" value="{{ $user->funeraria }}"
            {{ $user->funeraria == 'SI' ? 'checked' : '' }} id="funeraria">
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
        <input class="form-control" value="{{ old('contrasena_eps', $user->contrasena_eps) }}" type="text"
            placeholder="" name="contrasena_eps" id="contrasena_eps" autocomplete="contrasena_eps">
        <label class="fw-normal" for="contrasena_eps">Contraseña EPS </label>
        @error('contrasena_eps')
            <p class="text-danger text-sm">{{ $message }}</p>
        @enderror
    </div>
</div>


<div class="col-xl-12">
    <div class="form-floating mb-3">
        <input class="form-control" value="{{ old('password', '') }}" type="password" placeholder=""
            name="password" id="password" autocomplete="password">
        <label class="fw-normal" for="password">Contraseña</label>
        @error('password')
            <p class="text-danger text-sm">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="col-12 col-xl-6">
    <div class="form-floating mb-3">
        <select id="cargos" name="cargo_id" class="form-select" required>
            <option value="">Selecciona un cargo</option>
            @foreach ($cargo as $id => $nombre)
                <option value="{{ old('cargo_id', $id) }}" {{ $user->cargo_id == $id ? 'selected' : '' }}>
                    {{ $nombre }}</option>
            @endforeach
        </select>
        <label for="cargos" class="fw-normal">Cargo <b class="text-danger">*</b></label>

        @if ($errors->has('cargo_id'))
            <p id="cargo_id" class="text-danger">{{ $errors->first('cargo_id') }}</p>
        @endif
    </div>
</div>

<div class="col-xl-6">
    <div class="form-floating mb-3">
        <select class="form-select {{ $errors->has('role_id') ? 'is-invalid' : '' }}" name="role_id" id="role_id"
            required>
            <option value="">Selecciona un rol</option>
            @foreach ($roles as $id => $role)
                <option value="{{ $id }}" {{ old('role_id', $user->role_id) == $id ? 'selected' : '' }}>
                    {{ $role }}</option>
            @endforeach
        </select>
        <label class="fw-normal" for="role_id">Rol <b class="text-danger">*</b></label>
        <br>
        @error('role_id')
            <p class="text-danger text-sm">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="col-12 col-md-6">
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

<div class="col-12 col-md-6">
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

<div class="col-12 col-md-6">
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


<div class="col-12 col-md-6">
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
