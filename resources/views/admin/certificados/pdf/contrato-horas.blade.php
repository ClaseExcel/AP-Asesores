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
        $yearWords = $formatter->format(2026);
        $yearWords = str_replace('í', 'i', $yearWords);

        $duracionMeses = \Carbon\Carbon::parse($empleado->fecha_contrato)->diffInMonths(\Carbon\Carbon::parse($empleado->fecha_fin_contrato));
        $duracionDias = \Carbon\Carbon::parse($empleado->fecha_contrato)->diffInDays(\Carbon\Carbon::parse($empleado->fecha_fin_contrato)) % 30;
        $duracion = $duracionDias . ' días ' . $duracionMeses . ' meses';
    @endphp
    
    @if ($empresa->logocliente && $empresa->logocliente != 'default.jpg')
        <p style="text-align:right;">
            <img src="{{ public_path('storage/logo_cliente/' . $empresa->logocliente) }}" alt="logo" width="90px">
        </p>
    @endif

    <div
        style="font-family: 'Inter Tight', Arial, sans-serif !important; font-size:inherit; line-height:1.4; text-align: justify;">
        <h3>CONTRATO DE TRABAJO POR DÍAS U HORAS</h3>

        Nombre del empleador: <strong>{{ strtoupper($empresa->razon_social) }}</strong><br>
        Tipo y número de identificación: <strong>{{ $tipoIdentificacionAbreviado }}. {{ $empresa->NIT . ' - ' . $empresa->dv }}</strong><br>
        Representante legal: <strong>{{ strtoupper($empresa->representantelegal) }}</strong><br><br>
        Domicilio de la empresa: <strong>{{ strtoupper($empresa->direccion_fisica) }}</strong><br>
        Nombre del (la) trabajador(a): <strong>{{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }}</strong><br>
        Tipo y número de identificación: <strong>  {{ \Str::of($empleado->tipo_identificacion)->match('/\((.*?)\)/') }}. {{ $empleado->cedula }}</strong><br>
        Domicilio del (la) trabajador(a): <strong>{{ strtoupper($empleado->direccion) }}</strong><br>
        Teléfono de contacto: <strong>{{ $empleado->numero_contacto }}</strong><br>
        Fecha y lugar de nacimiento: <strong>{{ $empleado->fecha_nacimiento }}</strong> - <strong>{{ $empleado->lugar_nacimiento }}</strong> <br> 
        Fecha de iniciación del contrato: <strong>{{ $empleado->fecha_contrato }}</strong><br>
        Fecha de fin del contrato: <strong>{{ $empleado->fecha_fin_contrato }}</strong><br>
        Duración: <strong>{{ $duracion }}</strong> <br>
        Nacionalidad: <strong>{{ $empleado->nacionalidad }}</strong><br>
        Cargo del (la) trabajador(a): <strong>{{ strtoupper($empleado->cargo->nombre) }}</strong><br><br>

        Las partes, que suscribimos el presente Contrato de Trabajo por días u horas, lo hacemos fundamentados en la
        Buena
        Fe, y en especial en el respeto a los principios del Derecho de Trabajo. <br><br>

        <strong>{{ strtoupper($empresa->representantelegal) }}</strong> identificado con CC. No. <strong>{{ $empresa->Cedula }}</strong>,
        de Medellín Antioquia, en representación legal de la empresa
        <strong>{{ strtoupper($empresa->razon_social) }}</strong>, identificada
        con {{ $tipoIdentificacionAbreviado }}. No. <strong>{{ $empresa->NIT . ' - ' . $empresa->dv }}</strong> ,
        en mi calidad de empleador, con domicilio comercial del Municipio de {{ strtoupper($empresa->ciudad) }}, quien
        en
        adelante se denominará <strong>EMPLEADOR</strong> y
        <strong>{{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }}</strong>
        identificado(a) con {{ \Str::of($empleado->tipo_identificacion)->match('/\((.*?)\)/') }}. No.
        <strong>{{ $empleado->cedula }}</strong>, quien en
        adelante se denominará <strong>TRABAJADOR(A) A TIEMPO PARCIAL</strong>, quien desempeñara el cargo de
        <strong>{{ strtoupper($empleado->cargo->nombre) }}</strong>,
        acuerdan celebrar el presente <strong>CONTRATO DE TRABAJO POR DÍAS U HORAS</strong>, para ser ejecutado en la
        ciudad
        de {{ strtoupper($empresa->ciudad) }}, el cual se regirá por las siguientes cláusulas: <br><br>

        <strong>PRIMERA:</strong> EL(LA) TRABAJADOR(A) A TIEMPO PARCIAL se compromete a prestar sus servicios a la
        empresa,
        en el
        cargo de <strong>{{ strtoupper($empleado->cargo->nombre) }}</strong> CATORCE DÍAS AL MES. Ambas partes acuerdan
        que
        las
        retenciones al salario se harán
        tomando como base el salario mínimo completo, y los aportes realizados por <strong>EL EMPLEADOR</strong>
        igualmente
        se harán con base
        al salario mínimo mensual decretado por el Gobierno Nacional, ya que ello va en beneficio del trabajador, y
        además
        los portales web de esos organismos y las diferentes “formas” o planillas, no están adecuadas para el salario a
        tiempo parcial. <br><br>

        <strong>SEGUNDA:</strong> Las funciones de EL(LA) TRABAJADOR(A) A TIEMPO PARCIAL son:
        {!! $funciones !!} <br><br>

        <strong>TERCERA:</strong> EL(LA) TRABAJADOR(A) A TIEMPO PARCIAL declara que los datos aportados a <strong>EL
            EMPLEADOR</strong> en su resumen curricular,
        así como las referencias aportadas son ciertos, por lo cual ésta puede proceder a la verificación de dichos
        datos,
        referencias y demás circunstancias que soportan resumen curricular. Si se comprobase que EL(LA) TRABAJADOR(A) A
        TIEMPO PARCIAL aportó datos falsos a EL EMPLEADOR, ello será causal de despido justificado en los términos
        establecidos en
        el Código Sustantivo de Trabajo. <br><br>

        <strong>CUARTA:</strong> EL(LA) TRABAJADOR(A) A TIEMPO PARCIAL se compromete a prestar a <strong>EL EMPLEADOR</strong> los servicios descritos en la
        Cláusula Segunda del presente contrato en la sede de {{ $empresa->direccion_fisica . ' ' . $empresa->ciudad }}.
        El horario de trabajo será convenido por las partes de forma anticipada a la prestación del servicio. <br><br>

        <strong>QUINTA:</strong> <strong>EL EMPLEADOR</strong> se obliga a pagarle a EL(LA) TRABAJADOR(A) A TIEMPO
        PARCIAL y éste así lo acepta, en el local donde funciona la empresa, la alícuota correspondiente a las horas calculadas con base al salario mínimo establecido
        por la ley en moneda de curso legal el último día laborado de cada semana, como contra-prestación por los servicios
        señalados en la Cláusula Segunda. Además, EL(LA) TRABAJADOR(A) A TIEMPO PARCIAL devengará la alícuota que le
        corresponda de todos los beneficios consagrados en el código sustantivo del trabajo. <br><br>

        <strong>SEXTA:</strong> EL(LA) TRABAJADOR(A) A TIEMPO PARCIAL se obliga a resguardar la mercancía y equipos,
        ubicados en la empresa
        donde labora, se obliga a evitar su deterioro, extravío, pérdida o hurto. <br><br>

        <strong>SÉPTIMA:</strong> Las partes acuerdan que es causa justificada de despido el incumplimiento de las
        obligaciones que se encuentran establecidas a cargo de EL(LA) TRABAJADOR(A) A TIEMPO PARCIAL en el presente
        contrato, y las contempladas
        en el código sustantivo del trabajo. <br><br>

        <strong>OCTAVA:</strong> EL(LA) TRABAJADOR(A) A TIEMPO PARCIAL conviene en mantener estricta reserva y absoluta
        confidencialidad en
        la prestación de su servicio a EL EMPLEADOR, absteniéndose de comunicar a terceros cualquier información que
        tenga
        sobre la empresa o sobre su propietario. <br><br>

        <strong>NOVENA:</strong> EL(LA) TRABAJADOR(A) A TIEMPO PARCIAL está residenciado(a) en
        {{ $empleado->direccion }}
        {{ $empleado->barrio }}
        y se obliga a notificar cualquier cambio en su residencia a <strong>EL EMPLEADOR</strong>. <br><br>

        <strong>DÉCIMA:</strong> Para todo aquello que no se encuentre especialmente previsto o acordado por las partes
        en
        el presente
        contrato, rigen las disposiciones del Código Sustantivo del Trabajo y demás leyes especiales. Para los efectos
        del
        presente contrato las partes eligen como domicilio especial a la Ciudad de {{ $empresa->ciudad }}, a cuya
        jurisdicción las partes declaran someterse. <br><br>

        <strong>DÉCIMA PRIMERA:</strong> ACUERDO DE CONFIDENCIALIDAD Entre los suscritos mayor de edad, vecino de
        Medellín,
        <strong>{{ strtoupper($empresa->representantelegal) }}</strong> identificado con la Cédula de
        Ciudadanía
        Número <strong>{{ $empresa->Cedula }}</strong> de
        {{ $empresa->ciudad }} en calidad de representante legal de la empresa {{ $empresa->razon_social }}
        identificada
        con {{ $tipoIdentificacionAbreviado }} No. <strong>{{ $empresa->NIT . ' - ' . $empresa->dv }}</strong>
        obrando en nombre, que en adelante se llamará EL EMPLEADOR Y
        <strong>{{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }}</strong> mayor
        de edad, vecino de {{ $empresa->ciudad }}, identificada con {{ $empleado->tipo_identificacion }} No.
        <strong>{{ $empleado->cedula }}</strong> de {{ $empleado->barrio }} quien obra en su propio nombre
        y que
        en adelante se denominará EL TRABAJADOR, se ha
        convenido adicionar al contrato de trabajo la siguiente cláusula que en adelante harán parte integrante del
        mismo: <br><br>

        <strong>DÉCIMO SEGUNDA.</strong> Entre el TRABAJADOR y el EMPLEADOR se celebra el siguiente acuerdo de
        confidencialidad, el
        cual
        tendrá vigencia durante el tiempo de ejecución del presente contrato, y se extiende en el tiempo, teniendo
        en
        cuenta
        que el TRABAJADOR reconoce que toda la información a la que tuvo acceso en la ejecución del presente es de
        propiedad
        del EMPLEADOR y de naturaleza sensible. <br><br>
        • Que el TRABAJADOR reconoce que la información compartida en virtud del presente acuerdo pertenece
        exclusivamente
        al EMPLEADOR, y la misma es considerada sensible y de carácter restringido en su divulgación, manejo y
        utilización. <br>
        Dicha información es compartida exclusivamente en virtud del presente contrato y se prohíbe su divulgación,
        reproducción, copia y/o comercialización.
        • Que la información de propiedad del EMPLEADOR ha sido desarrollada u obtenido legalmente, como resultado
        de
        sus
        procesos, programas o proyectos y, en consecuencias abarca documentos, datos, tecnología y/o material que
        considera
        único y confidencial, o que es objeto de protección a título de secreto industrial. En este acuerdo se le
        asigna
        el
        carácter de confidencial la información que elabore o desarrolle el TRABAJADOR en la ejecución del presente
        contrato. <br><br>
        • El TRABAJADOR reconoce que el EMPLEADOR puede poner a su disposición ciertas listas de clientes, datos de
        precios,
        fuentes de suministro, técnicas, información computarizada, mapas, los métodos, producto de diseño, la
        información,
        y/o Información propiedad del EMPLEADOR, contratistas o sus clientes, incluyendo sin restricción, secretos
        de
        fabricación, invenciones, patentes, derechos de imagen y materiales con derechos de autor más todo lo que se
        considere Material o Información Confidencial. <br><br>
        • El TRABAJADOR reconoce que esta información tiene un valor económico, real o potencial, que no es
        generalmente
        dado a conocer al público o a los otros que podrían obtener el valor económico de su descubrimiento o empleo
        y
        que
        esta información es sujeta a un esfuerzo razonable por el EMPLEADOR de mantener su secreto y
        confidencialidad.
        Así,
        como puede traer graves perjuicios, litigio y el pago de indemnizaciones ante el uso indiscriminado de la
        información. Asimismo, el TRABAJADOR reconoce que está prohibido realizar duplicación u otra copia del
        Material
        Confidencial. <br>
        EI TRABAJADOR se obliga a devolver inmediatamente se le solicite por parte de la Empresa, todo material
        confidencial
        que se le haya solicitado. El TRABAJADOR notificará a la Empresa cualquier descubrimiento y/o producción
        artística o
        ejecución de trabajo artístico que haya hecho, considerándose esto, como parte del Material Confidencial. EI
        TRABAJADOR se compromete a no utilizar información o Material Confidencial finalizado la relación con el
        EMPLEADOR,
        so pena de incurrir en acciones civiles y penales descritas en la legislación colombiana. <br><br>
        • Para el objetivo de este Acuerdo, también se considerará como Material Confidencial cualquier información,
        observación, datos, material escrito, registro, documento, dibujo, fotografía, videos, ejecución de trabajo
        artístico, disposición, programas de computador, software, multimedia, programas fijos, invención,
        descubrimiento,
        mejora, desarrollo, instrumento, derechos de propiedad intelectual sobre los trabajos artísticos
        desarrollados
        durante la ejecución del contrato, máquina, aparato, aplicación, diseño, trabajo de paternidad literario,
        logo,
        sistema, idea promocional, lista de clientes, necesidad del cliente, práctica, información de precios,
        procesos,
        pruebas, concepto, fórmulas, métodos, información de mercado, técnicas, secreto de fabricación, producto y/o
        la
        investigación relacionada con el desarrollo de investigación real o previsto, productos, organización,
        control
        de
        comercialización, publicidad, negocio o fondos de Empresa, sus afiliados o entidades relacionadas.
        Todo lo anterior, es y será de la Empresa incluso después de terminada la relación con el TRABAJADOR <br><br>
        • El TRABAJADOR cumplirá con las medidas de seguridad que tome la Empresa para proteger la confidencialidad
        de
        cualquier información reservada o secreta de la Empresa. <br><br>
        • El TRABAJADOR irrevocablemente designa al Gerente o quien haga sus veces en la Empresa para realizar todos
        los
        actos necesarios para obtener y/o mantener patentes, derechos de autor y derechos similares a cualquier
        Información
        exclusiva de la Empresa, según las normas colombianas e Internacionales. La Empresa puede disponer
        libremente de
        toda su información o material Confidencial, por lo que el TRABAJADOR no tendrá ninguna autoridad para
        ejercer
        cualquier derecho o privilegios en lo concierne a la Información perteneciente exclusivamente Empresa
        poseída
        por o
        asignada a esta última conforme a acuerdo y las leyes colombianas. <br><br>
        EL TRABAJADOR que viole alguna de las disposiciones antes mencionadas en relación con lo que se considera
        objeto
        de
        la Confidencialidad, ocasionará el pago de una multa de ${{ number_format($multa, 0, ',', '.') }}, sin
        perjuicio de las demás
        acciones
        laborales, comerciales y penales a que haya lugar para la reclamación de indemnización de perjuicios
        ocasionados
        con
        la violación a la Confidencialidad aquí suscrita. <br><br>

        <strong>DÉCIMO TERCERA:</strong> El TRABAJADOR declara que toda la información, desarrollo, descubrimiento,
        invención,
        procedimiento,
        y demás conocimiento que adquiera durante la ejecución del contrato es de propiedad exclusiva del EMPLEADOR,
        y
        que
        su reproducción, donación, transferencia o venta acarrea perjuicios graves para El EMPLEADOR, incluyendo a
        título
        enunciativo, pero no limitativo que el derecho de propiedad intelectual y prohibición de reproducción.
        programación.
        edición, compilación, diseños, logotipos, texto y/o gráficos, son propiedad exclusiva del EMPLEADOR, y que
        su
        reproducción, donación, transferencia a cualquier título o venta por parte del TRABAJADOR quedará sujeto a
        sanciones
        civiles y penales a las que haya lugar. <br><br>

        <strong>DÉCIMO CUARTA:</strong> Las invenciones o descubrimientos realizados por el TRABAJADOR contratado
        para investigar
        pertenecen
        al EMPLEADOR, de conformidad con el artículo 539 del Código de Comercio, así como en los artículos 20 y
        concordantes
        de la ley 23 de 1982 sobre derechos de autor. <br><br>

        <strong>DÉCIMO QUINTA:</strong> Sobre la base de considerar como confidencial y reservada toda información
        que EL TRABAJADOR
        reciba
        del EMPLEADOR o de terceros en razón de su cargo, que incluye, pero sin que se limite a los elementos
        descritos,
        la
        información objeto de derecho de autor, patentes, técnicas, modelos, invenciones, know-how, procesos,
        algoritmos,
        programas ejecutables, investigaciones, detalles de diseño, información financiera, planeación estratégica,
        bases de
        datos, lista de clientes, lista de proveedores, inversionistas, empleados, relaciones de negocios y
        contractuales,
        pronósticos de negocios, procedimiento de entrenamiento y dirección de los modelos, videos, fotografías,
        planes
        de
        mercadeo e cualquier información revelada sobre terceras personas, salvo la que expresamente y por escrito
        se le
        manifieste que no tiene dicho carácter, o la que se tiene disponible para el público en general, EL
        TRABAJADOR
        se
        obliga a
        a) Abstenerse de revelar o usar información relacionada con los trabajos o actividades que desarrolla la
        EMPRESA
        ni
        durante el tiempo de vigencia del contrato de trabajo ni después de finalizado éste hasta por 5 años, ya sea
        con
        terceras personas naturales o jurídicas, ni con personal de la misma EMPRESA no autorizado para conocer
        información
        confidencial salvo autorización expresa del EMPLEADOR. <br>
        b) Entregar al EMPLEADOR cuando finalice el contrato de trabajo todos los archivos en original, copias con
        información confidencial, o cualquier información del empleador, o que haya desarrollo el TRABAJADOR en
        ejecución
        del presente contrato, y que se encuentren en su poder, ya sea que se encuentre en documentos escritos,
        gráficos
        o
        archivos magnéticos como video, audio, CD, USB, online, entre otros. <br>
        c) En caso de violación de esta confidencialidad durante la vigencia del contrato de trabajo y los cinco
        años
        posteriores a la terminación del mismo el trabajador será responsable de los perjuicios económicos que
        genere al
        empleador quién podrá iniciar las acciones penales y civiles correspondientes. <br><br>
        Se hacen dos (2) ejemplares de un solo tenor y al mismo efecto, uno de los cuales se le entrega a LA
        TRABAJADORA
        A
        TIEMPO PARCIAL y el otro queda en posesión de EL EMPLEADOR. En {{ $empresa->ciudad }} el

        {{ ucfirst((new \NumberFormatter('es', \NumberFormatter::SPELLOUT))->format(\Carbon\Carbon::now()->day)) }}
        ({{ \Carbon\Carbon::now()->format('d') }}) del mes
        de
        {{ \Carbon\Carbon::now()->locale('es')->isoFormat('MMMM') }} ({{ \Carbon\Carbon::now()->format('m') }}) del
        año
        {{ $yearWords }} ({{ \Carbon\Carbon::now()->format('Y') }}). <br><br>
    </div>

    <table style="width:100%; margin-top:20px;font-family: 'Inter Tight', Arial, sans-serif !important; font-size:inherit; line-height:1.4; text-align: justify;">
        <tr>
            <td style="width:50%; vertical-align:top; text-align:left;">
                <div>
                    @if($empresa->firmarepresentante != null && $empresa->firmarepresentante != 'default.jpg')
                    <img src="{{ public_path('storage/representante_firma/' . $empresa->firmarepresentante) }}"
                        alt="" width="150px"><br><br>
                    @else
                    _______________________________ <br>
                    @endif 
                    <strong>{{ strtoupper($empresa->representantelegal) }}</strong><br>
                    CC. {{ $empresa->Cedula }}<br>
                    EL EMPLEADOR
                </div>
            </td>
            <td style="width:50%; vertical-align:top; text-align:left;">
                <div>
                    _______________________________<br>
                    <strong>{{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }}</strong><br>
                    {{ \Str::of($empleado->tipo_identificacion)->match('/\((.*?)\)/') }}. {{ $empleado->cedula }}<br>
                    EL(LA) TRABAJADOR(A)
                </div>
            </td>
        </tr>
    </table>

</body>

</html>
