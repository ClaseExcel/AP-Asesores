<div class="row">
    <div class="col-12">
        <div class="mb-3">
            <label for="funciones_empleados_indefinido" class="fw-normal">Funciones del empleado <b
                    class="text-danger">*</b></label>
            <textarea id="funciones_empleados_indefinido" name="funciones_empleados_indefinido" rows="1" class="form-control"
                style="height: 150px">{!! old('funciones_empleados_indefinido', '') !!}</textarea>
        </div>
        @error('funciones_empleados_indefinido')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="col-12 col-xl-12">
        <div class="form-floating mb-3">
            <input type="number" id="valor_multa" name="valor_multa" value="{{ old('valor_multa', '') }}"
                class="form-control" placeholder="" />
            <label for="valor_multa" class="fw-normal">Multa acuerdo de confidencialidad </label>
        </div>
    </div>
</div>

<script>
    ClassicEditor
        .create(document.querySelector('#funciones_empleados_indefinido'), {
            toolbar: {
                items: [
                    'bold', 'italic', '|', 'link', '|',
                    'bulletedList', 'numberedList', '|',
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
