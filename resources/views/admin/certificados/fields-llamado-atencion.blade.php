<div class="row">
    <div class="col-12 col-md-12">
        <div class="form-floating mb-3">
            <select name="asunto" id="asunto" class="form-select">
                <option value="">Selecciona una opción</option>
                <option value="Llamado de atención">Llamado de atención</option>
                <option value="Memorando">Memorando</option>
                <option value="Comunicación disciplinaria">Comunicación disciplinaria</option>
            </select>
            <label for="concepto" class="fw-normal">Asunto <b class="text-danger">*</b></label>
        </div>
        @error('asunto')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="col-12 ml-2">
        <div class="mb-3">
            <label class="fw-bold">Medidas disciplinarias <b class="text-danger">*</b></label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="amonestacion_verbal" name="medidas[]"
                    value="Amonestación verbal">
                <label class="form-check-label" for="amonestacion_verbal">Amonestación verbal</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="amonestacion_escrita" name="medidas[]"
                    value="Amonestación escrita">
                <label class="form-check-label" for="amonestacion_escrita">Amonestación escrita</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="suspension_temporal" name="medidas[]"
                    value="Suspensión temporal">
                <label class="form-check-label" for="suspension_temporal">Suspensión temporal</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="terminacion_contrato" name="medidas[]"
                    value="Terminación del contrato">
                <label class="form-check-label" for="terminacion_contrato">Terminación del contrato</label>
            </div>
        </div>
        @error('medidas')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="col-12">
        <div class="mb-3">
            <label for="descripcion_conducta" class="fw-normal">Conducta o incumplimiento <b
                    class="text-danger">*</b></label>
            <textarea id="descripcion_conducta" name="descripcion_conducta" rows="1" class="form-control"
                style="height: 150px">{!! old('descripcion_conducta', '') !!}</textarea>
        </div>
        @error('descripcion_conducta')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="col-12 col-md-8">
        <div class="form-floating mb-3">
            <div class="row d-flex justify-content-between ">
                <div class="col-10">
                    <label class="fw-normal">
                        Imagen falla:
                    </label>
                </div>
                <div class="col-12">
                    <div class="input-group">
                        <label class="input-group-text bg-transparent" for="evidencia"><i
                                class="fas fa-file-upload"></i>
                            &nbsp;
                        </label>
                        <input type="file" id="idevidencia" name="evidencia" class="form-control"
                            accept="image/jpeg, image/png, image/jpg, image/gif" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    ClassicEditor
        .create(document.querySelector('#descripcion_conducta'), {
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