$(document).ready(function () {
    // Inicializar el campo select múltiple con Select2 de las otras entidades
    $("#multiple-checkboxes4").select2({
        dropdownCssClass: 'custom-dropdown', // Clase CSS personalizada para el menú desplegable
        containerCssClass: 'custom-container', // Clase CSS personalizada para el contenedor del select
        closeOnSelect: false // Evitar que se cierre al seleccionar
    });
    // Agregar funcionalidad al botón "Seleccionar Todo"
    $("#selectAllButton4").on("click", function () {
        $("#multiple-checkboxes4").find("option").prop("selected", true);
        $("#multiple-checkboxes4").trigger(
            "change"); // Actualizar el select2 después de la selección
    });
    // Agregar funcionalidad al botón "Deseleccionar Todo"
    $("#deselectAllButton4").on("click", function () {
        $("#multiple-checkboxes4").find("option").prop("selected", false);
        $("#multiple-checkboxes4").trigger(
            "change"); // Actualizar el select2 después de la desselección
    });

    // Inicializar el campo select múltiple con Select2 de las otras entidades
    $("#multiple-checkboxes5").select2({
        dropdownCssClass: 'custom-dropdown', // Clase CSS personalizada para el menú desplegable
        containerCssClass: 'custom-container', // Clase CSS personalizada para el contenedor del select
        closeOnSelect: false // Evitar que se cierre al seleccionar
    });
    // Agregar funcionalidad al botón "Seleccionar Todo"
    $("#selectAllButton5").on("click", function () {
        $("#multiple-checkboxes5").find("option").prop("selected", true);
        $("#multiple-checkboxes5").trigger(
            "change"); // Actualizar el select2 después de la selección
    });
    // Agregar funcionalidad al botón "Deseleccionar Todo"
    $("#deselectAllButton5").on("click", function () {
        $("#multiple-checkboxes5").find("option").prop("selected", false);
        $("#multiple-checkboxes5").trigger(
            "change"); // Actualizar el select2 después de la desselección
    });

});

let editor;

ClassicEditor
    .create(document.querySelector('#comunicado'), {
        toolbar: {
            items: [
                'bold', 'italic', '|', 'link', '|',
                'bulletedList', 'numberedList', '|',
                'undo', 'redo',
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
    .then(newEditor => {
        editor = newEditor;
    })
    .catch(error => {
        console.error(error);
    });


$('#btn-guardar-comunicado').click(function (event) {
    event.preventDefault(); // Evitar el envío normal del formulario
    const formulario = document.getElementById('crear-comunicado');

    var clientes = $('#multiple-checkboxes4 option:selected').map(function () {
        return $(this).text().trim();
    }).get();

    var usuarios = $('#multiple-checkboxes5 option:selected').map(function () {
        return $(this).text().trim();
    }).get();

    var comunicado = editor.getData();
    let mensaje;
    
    if ($('#multiple-checkboxes4').length > 1) {
        mensaje = '<strong>Clientes seleccionados:</strong> <br> ' + clientes + '<br><br>';
        mensaje += '<strong>Comunicado:</strong> ' + comunicado;
    } else {
        mensaje = '<strong>Usuarios seleccionados:</strong> <br> ' + usuarios + '<br><br>';
        mensaje += '<strong>Comunicado:</strong> ' + comunicado;
    }


    Swal.fire({
        title: "¿Estás seguro de enviar esta información al comunicado?",
        html: `
                    <div style="max-height: 300px; overflow-y: auto;"> ${mensaje} </div>
                    `,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#69c34e",
        scrollbarPadding: false, // Evita que SweetAlert manipule el padding de la página
        heightAuto: false,
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {

            var formData = new FormData(formulario); // Crear un objeto FormData
            // Reemplazar el valor del campo 'comunicado' en el FormData
            formData.set('comunicado', comunicado);

            Swal.fire({
                title: 'Enviando correo...',
                icon: 'info',
                showConfirmButton: false,
                position: 'top',
                toast: true,
                timer: 1500,
                didOpen: () => {
                    // Elevar el z-index para que esté por encima del modal Bootstrap
                    const swalContainer = Swal.getPopup().parentNode;
                    swalContainer.style.zIndex = '20000';
                }
            });

            // Enviar los datos usando fetch
            $.ajax({
                url: $(this).attr('action'), // URL del endpoint
                type: 'POST',
                data: formData,
                contentType: false, // No establecer el tipo de contenido
                processData: false, // No procesar los datos
                success: function (response) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }

                    });
                    Toast.fire({
                        icon: "success",
                        title: "Comunicado enviado exitosamente."
                    });

                    // Reiniciar el formulario después del envío exitoso
                    formulario.reset();
                    $('#multiple-checkboxes4').val(null).trigger('change');
                    $('#multiple-checkboxes5').val(null).trigger('change');
                    document.getElementById('clientes-select').style.display = 'none';
                    document.getElementById('usuarios-select').style.display = 'none';
                    // Limpiar el editor CKEditor
                    editor.setData('');
                    // Recargar la tabla DataTable
                    table.ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {

                    $('#clientes').text('');
                    $('#usuarios').text('');
                    $('#tipo').text('');
                    $('#error-comunicado').text('');

                    if (jqXHR.status === 422) { // Verifica si es un error de validación
                        const errors = jqXHR.responseJSON.errors; // Captura los errores

                        // Muestra el mensaje de error en el elemento correspondiente
                        if (errors.clientes) {
                            $('#clientes').text(errors.clientes[0]);
                        }
                        if (errors.usuarios) {
                            $('#usuarios').text(errors.usuarios[0]);
                        }
                        if (errors.tipo) {
                            $('#tipo').text(errors.tipo[0]);
                        }
                        if (errors.comunicado) {
                            $('#error-comunicado').text(errors.comunicado[0]);
                        }
                    }

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }

                    });
                    Toast.fire({
                        icon: "error",
                        title: jqXHR.responseJSON.message ||
                            "Error al enviar el comunicado."
                    });

                    console.error('Error:', textStatus, errorThrown);
                }
            });
        }
    });
});

$('#tipoSelect').change(function () {
    if ($(this).val() == 1) {
        document.getElementById('clientes-select').style.display = 'block';
        document.getElementById('usuarios-select').style.display = 'none';
    } else {
        document.getElementById('usuarios-select').style.display = 'block';
        document.getElementById('clientes-select').style.display = 'none';
    }

});