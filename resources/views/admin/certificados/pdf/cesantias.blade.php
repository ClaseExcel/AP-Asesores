<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap');

        body,
        p,
        strong {
            font-family: "Inter Tight", sans-serif !important;
        }
    </style>
</head>

<body>
    @php
        $abreviaciones = [
            'Cédula de extranjería' => 'CE',
            'Cédula de ciudadanía' => 'CC',
            'Documento de identificación extranjero' => 'DIE',
            'Identificación tributaria de otro país' => 'NE',
            'Número de Identificación Tributaria CO' => 'NIT',
            'Pasaporte' => 'PSPT',
            'Permiso especial permanencia' => 'PEP',
            'Permiso por protección temporal' => 'PPT',
            'Registro civil' => 'RC',
            'Registro Único de Información Fiscal' => 'RIF',
            'Tarjeta de identidad' => 'TI',
            'Tarjeta de extranjería' => 'TE',
        ];

        $tipoIdentificacionAbreviado =
            $abreviaciones[trim($empresa->tipo_identificacion)] ?? $empresa->tipo_identificacion;
    @endphp

    @if ($empresa->logocliente && $empresa->logocliente != 'default.jpg')
        <p style="text-align:right;">
            <img src="{{ public_path('storage/logo_cliente/' . $empresa->logocliente) }}" alt="logo" width="90px">
        </p>
    @endif

    <p style="text-align:justify !important;">
        Medellín, {{ \Carbon\Carbon::now()->locale('es')->isoFormat('D [de] MMMM [del] YYYY') }} <br><br>

        Señores <br>

        <strong>{{ $empleado->cesantias }}</strong> <br><br><br>

        Asunto: Retiro total de cesantías. <br><br><br>

        La empresa {{ strtoupper($empresa->razon_social) }} con {{ $tipoIdentificacionAbreviado }}.
        {{ $empresa->NIT . ' - ' . $empresa->dv }}
        autoriza a el empleado
        {{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }} identificado con
        {{ \Str::of($empleado->tipo_identificacion)->match('/\((.*?)\)/') }}. {{ $empleado->cedula }} realizar el retiro
        de
        las cesantías. <br><br><br>

        Según lo dispuesto en el Art. 21 de la ley 1429 del 2010 (que modificó el Art. 256 del código sustantivo del
        Trabajo), nos permitimos informarles que hemos autorizado el retiro de las cesantías del colaborador señalado
        más adelante, en las siguientes condiciones: <br><br><br>

        <strong>Nombre del colaborador: </strong> {{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }} <br>
        <strong>Identificación {{ \Str::of($empleado->tipo_identificacion)->match('/\((.*?)\)/') }}:</strong>
        {{ $empleado->cedula }}. <br>
        <strong>Concepto retiro:</strong> {{ $concepto }}. <br><br><br>


        Atentamente, <br><br>

        @if ($empresa->firma_usuario_certificado != null && $empresa->firma_usuario_certificado != 'default.jpg')
            <img src="{{ public_path('storage/usuario_certificado_firma/' . $empresa->firma_usuario_certificado) }}"
                alt="" width="150px"> <br><br>
        @else
            _______________________________ <br>
        @endif
        
        <strong> {{ strtoupper($empresa->nombres_usuario_certificado) }} <br>
            {{ strtoupper($empresa->cargo_usuario_certificado) }} <br>
            {{ $empresa->correo_usuario_certificado }} <br>
            {{ $empresa->telefono_usuario_certificado }}
        </strong>

    </p>

</body>

</html>
