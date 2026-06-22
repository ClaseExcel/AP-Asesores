<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat" rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif !important;
        }
    </style>
</head>

<body>
    <div style="display:flex; justify-content:center;">
        <img src="{{ asset('images/logos/logo_contable.png') }}" alt="" width="200px">
    </div>

    <div class="content" style="color:#616161 !important;">
        <p>
            Estimado/a <strong>{{ $cliente }}</strong>: <br><br>

            En atención a su solicitud, pongo a su disposición la cotización correspondiente a la línea de
            negocio de <strong>{{ $linea_negocio }}</strong>,
            elaborada con base en los requerimientos que nos compartió. <br><br>

            Se adjunta el documento con el desglose de precios, condiciones comerciales y alcance del servicio/producto.
            Quedo a su entera disposición para resolver cualquier duda, ampliar información o realizar los ajustes que
            considere necesarios. <br><br>

            @if ($observacion)
                Adicionalmente, incluyo observaciones acerca de la cotización: <br><br>

                {!! $observacion !!}
            @endif

            Agradezco de antemano su atención y confianza. <br><br>

            Cordialmente, AP Asesores Contables Integrales
        </p>
    </div><br>

    <small>
        Este correo es exclusivamente informativo. <br>
    </small><br><br>
    <small>
        <b>AVISO DE CONFIDENCIALIDAD:</b> Este correo electrónico contiene información de caracter confidencial. Si no
        es el destinatario de este correo y lo recibió por error comuníquelo de inmediato, respondiendo a
        apasesorescontables@gmail.com y eliminando cualquier copia que pueda tener del mismo. Si no es el destinatario,
        no
        podrá
        usar su contenido, de hacerlo podría tener consecuencias legales como las contenidas en la Ley 1273 del 5 de
        enero de 2009 y todas las que le apliquen. Si es el destinatario, le corresponde mantener reserva en general
        sobre la información de este mensaje, sus documentos y/o archivos adjuntos, a no ser que exista una autorización
        explícita. Antes de imprimir este correo, considere si es realmente necesario hacerlo, recuerde que puede
        guardarlo como un archivo digital.

    </small><br><br>
    <small>
        <b>CONFIDENTIALITY NOTICE:</b> This email contains confidential information. If you are not the intended
        recipient of this email and received it in error, please notify us immediately by responding to
        apasesorescontables@gmail.com and delete any copies you may have. If you are not the intended recipient, you are
        not
        allowed to use its content; doing so may have legal consequences as outlined in Law 1273 of January 5, 2009, and
        any applicable laws. If you are the intended recipient, you must maintain confidentiality regarding this
        message's information, documents, and/or attached files unless explicit authorization is given. Before printing
        this email, consider whether it is indispensable; remember that you can save it as a digital file.
    </small>
</body>

</html>
