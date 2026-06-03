<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Acta de revisión</title>
    <style>
        body {
            font-family: 'Segoe UI', 'Open Sans', sans-serif;
            font-size: 15px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header img {
            width: 100px;
            margin-bottom: 10px;
        }

        .header h1 {
            color: #D0AA66;
            font-size: 28px;
            margin: 0;
        }

        .info {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .info p {
            margin: 8px 0;
        }
    </style>
</head>

<body>
    @php
        use App\Helpers\HtmlCleaner;
    @endphp

    <div class="header">
        <img src="{{ public_path('./images/logos/logo_contable.png') }}" alt="Logo" style="width:200px;">
        <h1>ACTA DE REVISIÓN</h1>
    </div>

    <div class="info">
        <p><strong>Tipo de visita:</strong> {{ $gestion->tipo_visita }}</p>
        <p><strong>Fecha de la gestión:</strong> {{ $gestion->fecha_visita }}</p>
        <p><strong>Cliente:</strong> {{ $gestion->cliente->razon_social }}</p>
        <p><strong>Persona quien creó la gestión:</strong>
            {{ $gestion->usuario_create->nombres . ' ' . $gestion->usuario_create->apellidos }}</p>
        <p><strong>Última actualización:</strong>
            {{ \Carbon\Carbon::parse($gestion->updated_at)->format('d-m-Y h:i A') }}</p>
    </div>


    @if ($gestion->detalle_visita)
        <div style="background-color:#D0AA66;padding:0.5px!important;border-radius:15px;">
            <h3 style="color: #ffffff;margin-left:5px;">Detalle de la gestión</h3>
        </div>

        <div style="text-align:justify;margin-bottom:15px;">
            <p>{!! HtmlCleaner::clean($gestion->detalle_visita) !!}</p>
        </div>
    @endif

    @if ($gestion->compromisos)
         <div style="background-color:#D0AA66;padding:0.5px!important;border-radius:15px;">
            <h3 style="color: #ffffff;margin-left:5px;">Compromisos AP Asesores Contables Integrales</h3>

        </div>

        <div style="text-align:justify;margin-bottom:15px;">
            <p>{!! HtmlCleaner::clean($gestion->compromisos) !!}</p>
        </div>
    @endif


    @if ($gestion->compromisos_cliente)
         <div style="background-color:#D0AA66;padding:0.5px!important;border-radius:15px;">
            <h3 style="color: #ffffff;margin-left:5px;">Compromisos por parte de la contraparte</h3>
        </div>

        <div style="text-align:justify;margin-bottom:15px;">
            <p>{!! HtmlCleaner::clean($gestion->compromisos_cliente) !!}</p>
        </div>
    @endif


    @if ($gestion->hallazgos)
         <div style="background-color:#D0AA66;padding:0.5px!important;border-radius:15px;">
            <h3 style="color: #ffffff;margin-left:5px;">Observaciones</h3>
        </div>

        <div style="text-align:justify;margin-bottom:15px;">
            <p>{!! HtmlCleaner::clean($gestion->hallazgos) !!}</p>
        </div>
    @endif



</body>

</html>
