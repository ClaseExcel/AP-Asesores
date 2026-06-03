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

        $formatter = new \NumberFormatter('es', \NumberFormatter::SPELLOUT);
        $salario_entero = (int) round($salario);
        $salario_letras = $formatter->format($salario_entero);

        $currentMonth = \Carbon\Carbon::now()->locale('es')->isoFormat('MMMM');
        $currenYear = \Carbon\Carbon::now()->format('Y');
        $currentMonthNum = \Carbon\Carbon::now()->format('m');

        $yearWords = $formatter->format(2026);
        $yearWords = str_replace('í', 'i', $yearWords); // "veintiséis" -> "veintiseis"
    @endphp

    @if ($empresa->logocliente && $empresa->logocliente != 'default.jpg')
        <p style="text-align:right;">
            <img src="{{ public_path('storage/logo_cliente/' . $empresa->logocliente) }}" alt="logo" width="90px">
        </p>
    @endif

    <p style="text-align:justify !important;">
        Medellín, {{ \Carbon\Carbon::now()->locale('es')->isoFormat('D [de] MMMM [del] YYYY') }} <br><br>

        <strong>Dirigido a: {{ strtoupper($dirigido) }}</strong> <br>
        <strong>Asunto: Certificado Laboral</strong> <br><br>

        Quien suscribe {{ strtoupper($empresa->razon_social) }}, identificado con {{ $tipoIdentificacionAbreviado }}.
        {{ $empresa->NIT . ' - ' . $empresa->dv }},
        Certifica que {{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }}, titular del documento de
        identificación
        {{ \Str::of($empleado->tipo_identificacion)->match('/\((.*?)\)/') }}. {{ $empleado->cedula }} labora con nuestra
        empresa desde el
        {{ \Carbon\Carbon::parse($fecha_ingreso)->locale('es')->isoFormat('D [de] MMMM [del] YYYY') }} @if ($empleado->fecha_retiro)
            hasta el
            {{ \Carbon\Carbon::parse($empleado->fecha_retiro)->locale('es')->isoFormat('D [de] MMMM [del] YYYY') }};
        @else
            hasta la fecha;
        @endif
        desempeñándose bajo el
        cargo de {{ strtoupper($empleado->cargo->nombre) }}, su contrato es celebrado a {{ $empleado->tipo_contrato }}
        y cuenta con todas sus
        prestaciones sociales, devengando los siguientes ingresos mensuales. <br><br><br>

    <div style="font-family: 'Inter Tight', Arial, sans-serif !important; font-size:inherit; line-height:1.4;">
        <ul style="margin:0; padding-left:1.2em; line-height:1.6;">
            <li>Salario Básico ${{ number_format($salario_entero, 0, ',', '.') }} ({{ $salario_letras }} pesos mcte)
            </li>
            {!! str_replace(['<ul>', '</ul>'], '', $otros_ingresos) !!}
        </ul>

        <br><br>

        Se expide a los
        {{ ucfirst((new \NumberFormatter('es', \NumberFormatter::SPELLOUT))->format(\Carbon\Carbon::now()->day)) }}
        ({{ \Carbon\Carbon::now()->format('d') }}) días del mes de {{ $currentMonth }} ({{ $currentMonthNum }}) del
        {{ $yearWords }} ({{ $currenYear }}), a solicitud del
        empleado. <br><br><br>

        Atentamente, <br><br>
    </div>


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
