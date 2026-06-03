$(document).ready(function () {
    // Inicializar el campo select múltiple con Select2
    $("#multiple-checkboxes").select2({
        dropdownCssClass: 'custom-dropdown', // Clase CSS personalizada para el menú desplegable
        containerCssClass: 'custom-container', // Clase CSS personalizada para el contenedor del select
        closeOnSelect: false // Evitar que se cierre al seleccionar
    });
    // Agregar funcionalidad al botón "Seleccionar Todo"
    $("#selectAllButton").on("click", function () {
        $("#multiple-checkboxes").find("option").prop("selected", true);
        $("#multiple-checkboxes").trigger("change"); // Actualizar el select2 después de la selección
    });
    // Agregar funcionalidad al botón "Deseleccionar Todo"
    $("#deselectAllButton").on("click", function () {
        $("#multiple-checkboxes").find("option").prop("selected", false);
        $("#multiple-checkboxes").trigger("change"); // Actualizar el select2 después de la desselección
    });
    $("#empresas_secundarias").select2({
        dropdownCssClass: 'custom-dropdown', // Clase CSS personalizada para el menú desplegable
        containerCssClass: 'custom-container', // Clase CSS personalizada para el contenedor del select
        closeOnSelect: false // Evitar que se cierre al seleccionar
    });
    // Agregar funcionalidad al botón "Seleccionar Todo"
    $("#selectAllButtonEmpresasSecundarias").on("click", function () {
        $("#empresas_secundarias").find("option").prop("selected", true);
        $("#empresas_secundarias").trigger("change"); // Actualizar el select2 después de la selección
    });
    // Agregar funcionalidad al botón "Deseleccionar Todo"
    $("#deselectAllButtonEmpresasSecundarias").on("click", function () {
        $("#empresas_secundarias").find("option").prop("selected", false);
        $("#empresas_secundarias").trigger("change"); // Actualizar el select2 después de la desselección
    });
});

$(document).ready(function () {
    $("#beneficiario").select2({
        dropdownCssClass: 'custom-dropdown', // Clase CSS personalizada para el menú desplegable
        containerCssClass: 'custom-container', // Clase CSS personalizada para el contenedor del select
        closeOnSelect: false // Evitar que se cierre al seleccionar
    });
});

$('#beneficiario').change(function () {
    // Obtener el valor seleccionado
    var selectedValue = $(this).val();

    var inputs = document.getElementsByClassName("input-beneficiario");
    var cantidad = inputs.length + 1;

    // Verificar si se ha seleccionado alguna opción
    if (selectedValue.length >= cantidad) {
        $('#inputs-beneficiario').append(`
            <div class="col-12 informacion_beneficiario">
                <div class="form-floating mb-3">
                    <select name="tipo_identificacion`+ cantidad + `" class="form-select input-beneficiario">
                        <option value="">Selecciona una opción </option>
                        <option value="0">Cédula de extranjería (CE)</option>
                        <option value="1">Cédula de ciudadanía (CC) </option>
                        <option value="2">Documento de identificación extranjero (DIE) </option>
                        <option value="3">Identificación tributaria de otro país (NE) </option>
                        <option value="4">Número de Identificación Tributaria CO (NIT) </option>
                        <option value="5">Pasaporte (PSPT) </option>
                        <option value="6">Permiso especial permanencia (PEP) </option>
                        <option value="7">Permiso por protección temporal (PPT) </option>
                        <option value="8">Registro civil (RC) </option>
                        <option value="9">Registro Único de Información Fiscal (RIF) </option>
                        <option value="10">Tarjeta de identidad (TI)</option>
                        <option value="11">Tarjeta de extranjería (TE) </option>
                    </select>
                    <label for="frecuencias" class="fw-normal">Tipo de identificación</label>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control" type="text" placeholder="" name="numero`+ cantidad + `" value="">
                    <label class="fw-normal" id="label-beneficiario">Número </label>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control" type="text" placeholder="" name="nombres`+ cantidad + `" value="">
                    <label class="fw-normal" id="label-beneficiario">Nombre y apellidos </label>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control" type="text" placeholder="" name="parentesco`+ cantidad + `" value="">
                    <label class="fw-normal" id="label-beneficiario">Parentesco </label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" name="fecha_nacimiento`+ cantidad + `" value="" class="form-control" placeholder=""/>
                    <label class="fw-normal">Fecha de nacimiento</label>
                </div>

                <div class="row ml-2">
                    <div class="col-xl-2">
                        <div class="form-check mb-3">
                            <input class="form-check-input" name="funeraria`+ cantidad + `" type="checkbox" value="" id="funeraria` + cantidad + `">
                            <label class="form-check-label" for="funeraria">
                                ¿Funeraria?
                            </label>
                        </div>
                    </div>

                    <div class="col-xl-1">
                        <div class="form-check mb-3">
                            <input class="form-check-input" name="eps`+ cantidad + `" type="checkbox" value="" id="eps` + cantidad + `">
                            <label class="form-check-label" for="funeraria">
                                EPS
                            </label>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="form-check mb-3">
                        <input class="form-check-input" name="caja_compensacion`+ cantidad + `" type="checkbox" value="" id="caja_compensacion` + cantidad + `">
                        <label class="form-check-label" for="caja_compensacion">
                            Caja de compensación
                        </label>
                    </div>
                </div>
                   
                </div>

                <div class="col-12 py-0">
                    <button type="button" class="btn btn-danger btn-sm remove">Eliminar</button>
                    <hr style="height: 0 !important; width: 100%; border-top: 1px dashed rgb(215 215 215);">
                </div>
            </div> 

            
        `);

        document.getElementById('funeraria' + cantidad).addEventListener('change', function () {
            if (this.checked) {
                this.value = 'SI';
            } else {
                this.value = '';
            }
        })

        document.getElementById('eps' + cantidad).addEventListener('change', function () {
            if (this.checked) {
                this.value = 'SI';
            } else {
                this.value = '';
            }
        })

        document.getElementById('caja_compensacion' + cantidad).addEventListener('change', function () {
            if (this.checked) {
                this.value = 'SI';
            } else {
                this.value = '';
            }
        })
    } 
});

$('#inputs-beneficiario').on('click', '.remove', function () {
    $(this).closest('.informacion_beneficiario').remove();
});