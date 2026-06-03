<div class="row">
    <div class="col-12 col-xl-12">
        <div class="form-floating mb-3">
            <input type="text" id="dirigido" name="dirigido" value="{{ old('dirigido', '') }}" class="form-control"
                placeholder="" />
            <label for="dirigido" class="fw-normal">Quién va dirigido <b class="text-danger">*</b></label>
            @error('dirigido')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input type="number" id="salario_empleado" name="salario_empleado"
                value="{{ old('salario_empleado', '') }}" class="form-control" placeholder="" />
            <label for="salario_empleado" class="fw-normal">Salario </label>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="form-floating mb-3">
            <input type="date" id="fecha_ingreso_empleado" name="fecha_ingreso_empleado"
                value="{{ old('fecha_ingreso_empleado', '') }}" class="form-control" placeholder=""  />
            <label for="fecha_ingreso_empleado" class="fw-normal">Fecha de ingreso empleado</label>
            @error('fecha_ingreso_empleado')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label for="otros_ingresos" class="fw-normal">Otros ingresos </label>
            <textarea id="otros_ingresos" name="otros_ingresos" rows="1" class="form-control" style="height: 150px">{!! old('otros_ingresos', '') !!}</textarea>
        </div>
    </div>
</div>


<script>
    ClassicEditor
        .create(document.querySelector('#otros_ingresos'), {
            toolbar: {
                items: [
                    'bold', 'italic', '|', 'link', '|',
                    'bulletedList', '|',
                    'undo', 'redo'
                ],
                shouldNotGroupWhenFull: true
            },
            link: {
                decorators: {
                    openInNewTab: {
                        mode: 'manual',
                        label: 'Abre en una ventana nueva',
                        defaultValue: true,
                        attributes: {
                            target: '_blank',
                            rel: 'noopener noreferrer'
                        }
                    }
                }
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
