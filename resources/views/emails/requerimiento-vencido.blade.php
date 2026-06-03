<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat" rel="stylesheet">

    <style>
        body {
            font-family: 'Montserrat', sans-serif !important;
        }

        .button {
            padding: 0.7em 2em;
            font-size: 16px;
            background: #222222;
            color: #fff;
            cursor: pointer;
            text-decoration: none;
            border-radius: 50px;
        }
    </style>
</head>

<body>
    <div style="display:flex; justify-content:center;">
        <img src="{{ asset('images/logos/logo_contable.png') }}" alt="" width="200px">
    </div>

    <div class="content">
        <h2 style="color:#D0AA66;text-align:center;">Requerimiento vencido</h2>
        <p>Buen día, esperamos que se encuentre bien <br><br>

            Te informamos que el requerimiento con consecutivo <b>{{ $seguimiento->requerimientos->consecutivo }}</b> ha
            superado su fecha de vencimiento. Por favor, toma las medidas necesarias para su ejecución a la mayor
            brevedad posible. </p>
    </div><br>

    <small>
        Este correo es exclusivamente informativo. <br>
        Saludos, AP Asesores Contables Integrales
    </small><br><br>
    <small>
        <b>AVISO DE CONFIDENCIALIDAD:</b> Este correo electrónico contiene información confidencial y sólo puede ser
        utilizada
        por la persona o compañía a la cual está dirigido. Si no es el destinatario de este correo y lo recibió por
        error comuníquelo de inmediato, respondiendo al remitente y eliminando cualquier copia que pueda tener del
        mismo. Si no es el destinatario, no podrá usar su contenido, de hacerlo podría tener consecuencias legales como
        las contenidas en la Ley 1273 del 5 de enero de 2009 y todas las que le apliquen. Si es el destinatario, le
        corresponde mantener reserva en general sobre la información de este mensaje, sus documentos y/o archivos
        adjuntos, a no ser que exista una autorización explícita.

        Antes de imprimir este correo, considere si es realmente necesario hacerlo, recuerde que puede guardarlo como un
        archivo digital.

        <b>CONFIDENTIALITY NOTICE:</b> This e-mail contains confidential information and may only be used by the person
        or
        company to whom it is addressed. If you are not the intended recipient of this email and you received it in
        error, please notify the sender immediately by replying to the sender and deleting any copies you may have of
        the email. If you are not the addressee, you may not use its contents, and doing so may have legal consequences
        such as those contained in Law 1273 of January 5, 2009 and all those that apply to you. If you are the
        addressee, it is your responsibility to keep the information in this message, its documents and/or attached
        files confidential, unless you have explicit authorization.

        Before printing this email, consider whether it is really necessary to do so, remember that you can save it as a
        digital file.
    </small>
</body>

</html>
