<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            font-family: "Inter Tight", sans-serif !important;
        }
    </style>
</head>

<body>

    @if ($empresa->logocliente && $empresa->logocliente != 'default.jpg')
        <p style="text-align:right;">
            <img src="{{ public_path('storage/logo_cliente/' . $empresa->logocliente) }}" alt="logo" width="90px">
        </p>
    @endif
    <div
        style="font-family: 'Inter Tight', Arial, sans-serif !important; font-size:inherit; line-height:1.4; text-align: justify;">

        {{ $asunto }} - <strong>consecutivo {{ $consecutivo }}</strong>  <br><br>

        Medellín, {{ \Carbon\Carbon::now()->locale('es')->isoFormat('D [de] MMMM [del] YYYY') }} <br><br>

        Señor(a) <br>

        <strong>{{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }}</strong> <br>
        {{ \Str::of($empleado->tipo_identificacion)->match('/\((.*?)\)/') }}. {{ $empleado->cedula }}
        <br><br>

        <h3>Asunto: {{ $asunto }} por incumplimiento al reglamento interno de trabajo.</h3>

        Al iniciar un contrato con una empresa, independientemente de la naturaleza de éste, se debe cumplir con ciertas
        obligaciones y se cuenta con una serie de prohibiciones emanadas directamente desde el ordenamiento jurídico y
        que de no ser cumplidas podrá acarrear sanciones contempladas en las mismas disposiciones legales. <br><br>

        Con la presente se hace saber el(la) trabajador(a)
        <strong>{{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }}</strong>; identificado(a) con
        <strong>{{ $empleado->tipo_identificacion }} {{ $empleado->cedula }}</strong> que ha incumplido con el contrato
        de trabajo que
        tiene activo con nuestra
        empresa al violar ciertas disposiciones del reglamento interno de trabajo que son incorporadas desde la
        legalidad del código sustantivo del trabajo, a saber: <br><br>

        {!!  $descripcion_conducta !!} <br><br>

        Dicha conducta contraviene las normas internas de la empresa y lo dispuesto en el Reglamento Interno de Trabajo
        y en el Código Sustantivo del Trabajo, en especial los artículos: <br>
        - Art. 58 CST: Deberes del trabajador. <br>
        - Art. 60 CST: Prohibiciones. <br>
        - Art. 62 CST: Causales de terminación del contrato por justa causa. <br><br>

        Este tipo de conductas no serán permitidas en la empresa, ya que afectan el normal desarrollo de las labores y
        el cumplimiento de los objetivos. Cabe resaltar que esta falta se ha presentado de manera consecutiva, por lo
        que le solicitamos mejorar su compromiso y responsabilidad laboral, evitando que esta situación se repita. <br>
        Después de analizar los descargos presentados y considerando la gravedad de los hechos, la empresa ha tomado la
        decisión de aplicar la siguiente medida disciplinaria, de acuerdo con lo establecido en el Reglamento Interno de
        Trabajo y el Código Sustantivo del Trabajo: <br> <br>

        <ul>
            @foreach ($medidas as $medida)
                <li>{{ $medida }}</li>
            @endforeach
        </ul>

        <br>

        De acuerdo a nuestro reglamento interno de trabajo y las normas establecidas, acordadas, avaladas se procede
        aplicar lo siguiente: <br><br>

        <strong>CAPÍTULO XVI ESCALA DE FALTAS Y SANCIONES DISCIPLINARIAS</strong> <br><br>

        <strong>ARTÍCULO 36.</strong> Se establecen las siguientes clases de faltas leves, y sus sanciones
        disciplinarias, así: <br><br>

        @if (!empty($img_evidencia))
            <img src="{{ $img_evidencia }}" alt="url_fallo" width="100%">
            <br><br>
        @endif

        En cumplimiento del debido proceso disciplinario (Art. 115 CST y jurisprudencia de la Corte Constitucional), se
        le otorga la oportunidad de presentar sus descargos por escrito o verbalmente, dentro de los próximos tres (3)
        días hábiles, contados a partir de la notificación de este documento. El trabajador podrá estar acompañado de un
        representante del Comité de Convivencia o un compañero de trabajo si lo desea. <br><br>

        Este comportamiento constituye una falta grave a los deberes establecidos en el Reglamento Interno de Trabajo,
        en especial en lo relacionado con el cumplimiento de la jornada laboral, la justificación de ausencias y el
        respeto a los procedimientos internos para la autorización de permisos. <br><br>

        Esperamos sea esta la oportunidad para que cumpla con sus funciones pactadas y de esta manera tener un óptimo
        desempeño conservando el buen ambiente laboral, cumpliendo con las expectativas y productividad esperadas. <br>

    </div>

    <table
        style="width:100%; margin-top:20px;font-family: 'Inter Tight', Arial, sans-serif !important; font-size:inherit; line-height:1.4; text-align: justify;">
        <tr>
            <td style="width:50%; vertical-align:top; text-align:left;">
                <div>
                    Atentamente,<br><br>
            </td>
            <td style="width:50%; vertical-align:top; text-align:left;">
                <div>
                    Recibí, <br><br>
                </div>
            </td>
        </tr>
    </table>

    <table
        style="width:100%; margin-top:20px;font-family: 'Inter Tight', Arial, sans-serif !important; font-size:inherit; line-height:1.4; text-align: justify;">
        <tr>
            <td style="width:50%; vertical-align:top; text-align:left;">
                <div>
                    @if ($empresa->firmarepresentante != null && $empresa->firmarepresentante != 'default.jpg')
                        <img src="{{ public_path('storage/representante_firma/' . $empresa->firmarepresentante) }}"
                            alt="" width="150px"><br><br>
                    @else
                        _______________________________ <br>
                    @endif
                    <strong>{{ strtoupper($empresa->representantelegal) }}</strong><br>
                    Representante Legal <br>
                </div>
            </td>
            <td style="width:50%; vertical-align:top; text-align:left;">
                <div>
                    _______________________________<br>
                    <strong>{{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }}</strong><br>
                    Empleado
                </div>
            </td>
        </tr>
    </table>

</body>

</html>
