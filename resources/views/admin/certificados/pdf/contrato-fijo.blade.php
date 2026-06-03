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

        $salario_entero = (int) round($empleado->salario);
        $salario_letras = $formatter->format($salario_entero);

        $duracionMeses = \Carbon\Carbon::parse($empleado->fecha_contrato)->diffInMonths(
            \Carbon\Carbon::parse($empleado->fecha_fin_contrato),
        );
        $duracionDias =
            \Carbon\Carbon::parse($empleado->fecha_contrato)->diffInDays(
                \Carbon\Carbon::parse($empleado->fecha_fin_contrato),
            ) % 30;
        $duracion = $duracionDias . ' días ' . $duracionMeses . ' meses';

        $salario_minimo = 1750905;
        $dos_salarios_minimos = 2 * $salario_minimo;
    @endphp

    @if ($empresa->logocliente && $empresa->logocliente != 'default.jpg')
        <p style="text-align:right;">
            <img src="{{ public_path('storage/logo_cliente/' . $empresa->logocliente) }}" alt="logo" width="90px">
        </p>
    @endif
    <div
        style="font-family: 'Inter Tight', Arial, sans-serif !important; font-size:inherit; line-height:1.4; text-align: justify;">
        <h3>CONTRATO DE TRABAJO A TÉRMINO FIJO.</h3>

        Nombre del empleador: <strong>{{ strtoupper($empresa->razon_social) }}</strong><br>
        Tipo y número de identificación: <strong>{{ $tipoIdentificacionAbreviado }}.
            {{ $empresa->NIT . ' - ' . $empresa->dv }}</strong><br>
        Domicilio de la empresa: <strong>{{ strtoupper($empresa->direccion_fisica) }}</strong><br>
        Nombre del (la) trabajador(a):
        <strong>{{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }}</strong><br>
        Tipo y número de identificación: <strong> {{ \Str::of($empleado->tipo_identificacion)->match('/\((.*?)\)/') }}.
            {{ $empleado->cedula }}</strong><br>
        Domicilio del (la) trabajador(a): <strong>{{ strtoupper($empleado->direccion) }}</strong><br>
        Teléfono de contacto: <strong>{{ $empleado->numero_contacto }}</strong><br>
        Fecha y lugar de nacimiento: <strong>{{ $empleado->fecha_nacimiento }}</strong> -
        <strong>{{ $empleado->lugar_nacimiento }}</strong><br>
        Fecha de iniciación del contrato: <strong>{{ $empleado->fecha_contrato }}</strong><br>
        Fecha de fin del contrato: <strong>{{ $empleado->fecha_fin_contrato }}</strong><br>
        Duración: <strong>{{ $duracion }}</strong> <br>
        Nacionalidad: <strong>{{ $empleado->nacionalidad }}</strong><br>
        Cargo del (la) trabajador(a): <strong>{{ strtoupper($empleado->cargo->nombre) }}</strong><br><br>


        Las partes, que suscribimos el presente Contrato de Trabajo a Término Fijo, lo hacemos fundamentados en la Buena
        Fe, y en especial en el respeto a <strong>{{ strtoupper($empresa->razon_social) }}</strong> identificado(a) con
        {{ $tipoIdentificacionAbreviado }}. No. <strong>{{ $empresa->NIT . ' - ' . $empresa->dv }}</strong>
        @if ($empresa->tipocliente == 'Natural')
            de <strong>(ingresar lugar de la identificación)</strong>,
        @endif
        en mi calidad de empleador, con domicilio comercial del Municipio de {{ $empresa->ciudad }} quien en adelante
        se denominará EMPLEADOR
        y <strong>{{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }}</strong> identificado(a) con
        {{ \Str::of($empleado->tipo_identificacion)->match('/\((.*?)\)/') }}. No.
        <strong>{{ $empleado->cedula }}</strong> residente en la {{ $empleado->direccion }} quien en adelante se
        denominará TRABAJADOR, quien desempeñará el cargo de
        {{ strtoupper($empleado->cargo->nombre) }} acuerdan celebrar el presente <strong>CONTRATO INDIVIDUAL DE TRABAJO
            A
            TÈRMINO FIJO</strong>, para ser
        ejecutado en la ciudad de <strong>{{ $empresa->ciudad }}</strong>, el cual se regirá por las siguientes
        cláusulas: <br><br>


        <strong>PRIMERA:</strong> EL EMPLEADOR contrata los servicios personales del TRABAJADOR y éste se obliga:
        <br><br> a) A
        poner al
        servicio del EMPLEADOR toda su capacidad normal de trabajo, en forma exclusiva, en el desempeño de las funciones
        propias del oficio mencionado y en las labores anexas y complementarias del mismo, de conformidad con las
        órdenes e instrucciones que le imparta EL EMPLEADOR o sus representantes, las funciones y procedimientos
        establecidos para este, observando en su cumplimiento, la diligencia, honestidad, eficacia y el cuidado
        necesarios. <br><br>

        Y b) A no prestar directa ni indirectamente servicios laborales a otros EMPLEADORES, ni a trabajar
        por cuenta propia en el mismo oficio, en las instalaciones de la empresa y horarios laborales, durante la
        vigencia de este contrato. <br><br>

        <strong>FUNCIONES:</strong> {!! $funciones !!} <br>

        <strong>SEGUNDA:</strong> Las partes declaran que en el presente contrato se entienden incorporadas, en lo
        pertinente, las
        disposiciones legales que regulan las relaciones entre la empresa y sus trabajadores, en especial, las del
        contrato de trabajo para el oficio que se suscribe, fuera de las obligaciones consignadas en los reglamentos de
        trabajo y de higiene y seguridad industrial de la empresa. <br><br>

        <strong>TERCERA:</strong> En relación con la actividad propia del EL EMPLEADO, éste la ejecutará dentro de las
        siguientes
        modalidades que implican claras obligaciones para EL EMPLEADO así: <br><br>

        <strong>OBLIGACIONES DEL TRABAJADOR:</strong> <br><br>

        <ul>
            <li> Observar rigurosamente las normas que le fije la empresa para la realización de la labor a que se
                refiere el
                presente contrato.</li>
            <li> Guardar absoluta reserva, salvo autorización expresa de la empresa, de todas aquellas informaciones que
                lleguen
                a su conocimiento, en razón de su trabajo, y que sean por naturaleza privadas.</li>
            <li>
                Ejecutar por sí mismo las funciones asignadas y cumplir estrictamente las instrucciones, manuales,
                procesos y
                procedimientos que le sean dadas por la empresa, o por quienes la representen, respecto del desarrollo
                de sus
                actividades.
            </li>
            <li>
                Cuidar permanentemente los intereses, instalaciones, muebles y equipos de oficina, de cómputo, enseres,
                vehículos, maquinaria, herramientas, materias primas, material de empaque y productos elaborados de la
                empresa.
                Dedicar la totalidad de su jornada de trabajo a cumplir a cabalidad con las funciones establecidas de
                acuerdo al
                cargo.
            </li>
            <li>
                Programar y elaborar diariamente su trabajo de forma eficiente.
            </li>
            <li>
                Asistir puntualmente a las reuniones y capacitaciones programadas por el empleador en aras de mejorar la
                formación del trabajador, la productividad y calidad de la empresa.
            </li>
            <li>
                Conservar completa armonía y comprensión con los clientes, proveedores, autoridades de vigilancia y
                control, con
                sus superiores y compañeros de trabajo, en sus relaciones personales y en la ejecución de su labor.
                Cumplir permanentemente sus labores con espíritu de lealtad, compañerismo, colaboración y disciplina con
                la
                empresa.
            </li>
            <li>
                Avisar oportunamente y por escrito a la empresa, todo cambio en su dirección, teléfono o ciudad de
                residencia.
            </li>
        </ul> <br>

        <strong>PROHIBICIONES DEL TRABAJADOR:</strong>

        <ul>
            <li>
                Ejecutar actividades diferentes a las propias de su oficio en horas de trabajo, para terceros ya fueren
                remuneradas o no, o para su provecho personal.
            </li>
            <li>
                Pedir o recibir dinero de los clientes de la EMPRESA y darles un destino diferente a ellos o no
                entregarlo en su
                debida oportunidad en la oficina de la EMPRESA.
            </li>
            <li>
                Todo acto de violencia, deslealtad, injuria, malos tratos o grave indisciplina en que incurra EL
                TRABAJADOR en
                sus labores contra LA EMPRESA, el personal directivo, sus compañeros de trabajo o sus superiores,
                clientes o
                proveedores.
            </li>
            <li>
                Los retrasos reiterados en la iniciación de la jornada de trabajo sin una justa causa que lo amerite.
            </li>
            <li>
                La inasistencia para laborar sin una excusa suficiente que lo justifique.
            </li>
        </ul>

        <br><br>

        <strong>CUARTA:</strong> Se remunerará con un Salario Básico mensual de
        <strong>{{ $salario_letras }} (${{ number_format($salario_entero, 0, ',', '.') }})</strong>
        @if ($empleado->salario < $dos_salarios_minimos)
            más auxilio de transporte de <strong>doscientos cuarenta y nueve mil noventa y cinco pesos
                ($249.095)</strong>
        @endif, pagaderos quincenalmente. Dentro de este pago se encuentra incluida la
        remuneración de los descansos dominicales y festivos de que tratan los capítulos I y II del título VII del
        Código Sustantivo del Trabajo. <br><br>

        <strong>PARÁGRAFO PRIMERO.</strong> Las partes hacen constar que en esta remuneración queda incluido el pago de
        los servicios que
        EL TRABAJADOR se obliga a realizar durante el tiempo estipulado en el presente contrato. <br><br>

        <strong>PARÁGRAFO SEGUNDO.</strong> Si EL TRABAJADOR prestare su servicio en día dominical o festivo, sin previa
        autorización por
        escrito del EMPLEADOR, no tendrá derecho a reclamar remuneración alguna por este día. <br><br>

        <strong>PARÁGRAFO CUARTO.</strong> Cuando por causa emanada directa o indirectamente de la relación contractual
        existan
        obligaciones de tipo económico a cargo del TRABAJADOR y a favor del EMPLEADOR, éste procederá a efectuar las
        deducciones a que hubiere lugar en cualquier tiempo y, más concretamente, a la terminación del presente
        contrato, así lo autoriza desde ahora EL TRABAJADOR, entendiendo expresamente las partes que la presente
        autorización cumple las condiciones, de orden escrita previa, aplicable para cada caso. <br><br>

        <strong>QUINTA: </strong> Las partes en el citado contrato acuerdan expresamente que lo entregado en dinero o en
        especie por parte
        del EMPLEADOR al TRABAJADOR por concepto de beneficios cualquiera sea su denominación de acuerdo con el artículo
        15 de la ley 50 de 1990 no constituyen salario, en especial: los auxilios o contribuciones que otorgue el
        empleador por concepto de alimentación para el trabajador, de bonificaciones extraordinarias y demás auxilios
        otorgados por mera liberalidad del empleador. <br><br>
        <strong>PARÁGRAFO PRIMERO.</strong> Cualquier beneficio que se entregue al trabajador sólo se le otorgará como
        mera liberalidad del empleador, por tanto, no constituye salario, ni pago laboral que sea base para el cálculo y
        pago de
        prestaciones sociales, aportes parafiscales, a cajas de compensación, SENA, o ICBF, entre otros; como tampoco es
        base para la determinación de las contribuciones o aportes al Sistema de Seguridad Social Integral, tales como:
        salud, pensión, riesgos profesionales, fondo de solidaridad, etc. Las partes acuerdan desde ahora que en ningún
        caso los pagos que se entreguen como auxilios o beneficios constituyen salario o son base para las cotizaciones,
        contribuciones o aportes antes descritos. <br><br>

        <strong>SEXTA:</strong> Todo trabajo suplementario o en horas extras y todo trabajo en domingo o festivo en los
        que legalmente
        debe concederse descanso, se remunerará conforme a la ley, así como los correspondientes recargos nocturnos,
        aclarando que no serán tenidos en cuenta para cotizaciones, pagos de seguridad social, liquidaciones, entre
        otros, esto siempre se hará sobre el salario básico empleado en el presente contrato. Para el reconocimiento y
        pago del trabajo suplementario, dominical o festivo, EL EMPLEADOR o sus representantes deben autorizarlo
        previamente por escrito. Cuando la necesidad de este trabajo se presente de manera imprevista o inaplazable,
        deberá ejecutarse y darse cuenta de el por escrito o en forma verbal, a la mayor brevedad al EMPLEADOR o a sus
        representantes. EL EMPLEADOR, en consecuencia, no reconocerá ningún trabajo suplementario o en días de descanso
        legalmente obligatorio que no haya sido autorizado previamente o avisado inmediatamente, como queda dicho.
        <br><br>

        <strong>SEPTIMA:</strong> EL TRABAJADOR se obliga a laborar la jornada ordinaria en los turnos y dentro de las
        horas señalados
        por EL EMPLEADOR, pudiendo hacer éste ajustes o cambios de horario cuando lo estime conveniente. Por el acuerdo
        expreso o tácito de las partes, podrán repartirse las horas de la jornada ordinaria en la forma prevista en el
        artículo 164 del Código Sustantivo del Trabajo, modificado por el artículo 23 de la Ley 50 de 1990, teniendo en
        cuenta que los tiempos de descanso entre las secciones de la jornada no se computan dentro de la misma, según el
        artículo 167 ibídem. Así mismo el empleador y el trabajador podrán acordar que la jornada semanal de cuarenta y
        siete (47) horas se realice mediante jornadas diarias flexibles de trabajo, distribuidas en máximo seis (6) días
        a la semana con un (1) día de descanso obligatorio, que podrá coincidir con el domingo. En éste, el número de
        horas de trabajo diario podrá repartirse de manera variable durante la respectiva semana y podrá ser de mínimo
        cuatro (4) horas continuas y hasta diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario,
        cuando el número de horas de trabajo no exceda el promedio de cuarenta y siete (47) horas semanales dentro de la
        jornada ordinaria de 6 a.m. a 10 p.m. <br><br>

        @php
            $yearWordsContrato = $formatter->format(\Carbon\Carbon::parse($empleado->fecha_ingreso)->format('Y'));
            $yearWordsContrato = str_replace('í', 'i', $yearWordsContrato);
        @endphp

        <strong>OCTAVA:</strong> Este contrato es un contrato a término fijo a partir del día
        {{ ucfirst(new \NumberFormatter('es', \NumberFormatter::SPELLOUT)->format(\Carbon\Carbon::parse($empleado->fecha_ingreso)->day)) }}
        ({{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d') }})
        mes
        {{ ucfirst(\Carbon\Carbon::parse($empleado->fecha_ingreso)->locale('es')->isoFormat('MMMM')) }}
        ({{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('m') }}) del
        año
        {{ $yearWordsContrato }}
        ({{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('Y') }}) y con una duración de (3) meses y
        permanecerá
        mientras subsistan las causas
        que le dieron origen a ese contrato. <br><br>

        <strong>PARÁGRAFO.</strong> Los primeros dieciocho (18) días del presente contrato se consideran como período de
        prueba y, por consiguiente, cualquiera de las partes podrá terminar el
        contrato unilateralmente, en cualquier momento durante dicho período. <br><br>


        <strong>NOVENA: </strong> Son justas causas para dar por terminado unilateralmente este contrato por cualquiera
        de las partes,
        las enumeradas en el artículo 7º del Decreto 2351 de 1965; y, además, por parte del EMPLEADOR, las faltas que
        para el efecto se califiquen como graves contempladas en el reglamento interno de trabajo y en el espacio
        reservado para cláusulas adicionales en el presente contrato. <br><br>

        <strong>DÉCIMA:</strong> Este contrato ha sido redactado estrictamente de acuerdo con la ley y la jurisprudencia
        y será
        interpretado de buena fe y en consonancia con el Código Sustantivo del Trabajo cuyo objeto, definido en su
        artículo 1º, es lograr la justicia en las relaciones entre empleadores y trabajadores dentro de un espíritu de
        coordinación económica y equilibrio social. <br><br>

        <strong>DÉCIMA PRIMERA:</strong> ACUERDO DE CONFIDENCIALIDAD Entre los suscritos mayor de edad, vecino de
        Medellín
        <strong>{{ strtoupper($empresa->razon_social) }}</strong> identificado(a) con
        {{ $tipoIdentificacionAbreviado }}. No. <strong>{{ $empresa->NIT . ' - ' . $empresa->dv }}</strong>
        @if ($empresa->tipocliente == 'Natural')
            de <strong>(ingresar lugar de la cédula)</strong>,
        @endif obrando en nombre, que en
        adelante se llamará EL EMPLEADOR Y
        <strong>{{ strtoupper($empleado->nombres . ' ' . $empleado->apellidos) }}</strong> mayor de
        edad, vecino de Medellín, identificado(a) con
        {{ \Str::of($empleado->tipo_identificacion)->match('/\((.*?)\)/') }}. No.
        <strong>{{ $empleado->cedula }}</strong>, quien obra en su propio nombre y que en adelante se denominará EL
        TRABAJADOR, se ha convenido adicionar al contrato de trabajo la siguiente cláusula que en adelante harán
        parte
        integrante del mismo. <br><br>

        <strong>DÉCIMO SEGUNDA:</strong> Entre el TRABAJADOR y el EMPLEADOR se celebra el siguiente acuerdo de
        confidencialidad, el cual tendrá vigencia durante el tiempo de ejecución del presente contrato, y se extiende en
        el tiempo, teniendo
        en cuenta que el TRABAJADOR reconoce que toda la información a la que tuvo acceso en la ejecución del presente
        es
        de propiedad del EMPLEADOR y de naturaleza sensible. <br><br>

        <ul>
            <li>Que el TRABAJADOR reconoce que la información compartida en virtud del presente acuerdo pertenece
                exclusivamente al EMPLEADOR, y la misma es considerada sensible y de carácter restringido en su
                divulgación,
                manejo y utilización. Dicha información es compartida exclusivamente en virtud del presente contrato y
                se
                prohíbe su divulgación, reproducción, copia y/o comercialización.</li>
            <li>
                Que la información de propiedad del EMPLEADOR ha sido desarrollada u obtenido legalmente, como resultado
                de
                sus procesos, programas o proyectos y, en consecuencias abarca documentos, datos, tecnología y/o
                material
                que
                considera único y confidencial, o que es objeto de protección a título de secreto industrial. En este
                acuerdo se
                le asigna el carácter de confidencial la información que elabore o desarrolle el TRABAJADOR en la
                ejecución
                del
                presente contrato.
            </li>
            <li>
                El TRABAJADOR reconoce que el EMPLEADOR puede poner a su disposición ciertas listas de clientes, datos
                de
                precios, fuentes de suministro, técnicas, información computarizada, mapas, los métodos, producto de
                diseño,
                la
                información, y/o Información propiedad del EMPLEADOR, contratistas o sus clientes, incluyendo sin
                restricción,
                secretos de fabricación, invenciones, patentes, derechos de imagen y materiales con derechos de autor
                más
                todo
                lo que se considere Material o Información Confidencial.
            </li>
            <li>
                El TRABAJADOR reconoce que esta información tiene un valor económico, real o potencial, que no es
                generalmente
                dado a conocer al público o a los otros que podrían obtener el valor económico de su descubrimiento o
                empleo
                y
                que esta información es sujeta a un esfuerzo razonable por el EMPLEADOR de mantener su secreto y
                confidencialidad. Así, como puede traer graves perjuicios, litigio y el pago de indemnizaciones ante el
                uso
                indiscriminado de la información. Asimismo, el TRABAJADOR reconoce que está prohibido realizar
                duplicación u
                otra copia del Material Confidencial. <br>
                EI TRABAJADOR se obliga a devolver inmediatamente se le solicite por parte de la Empresa, todo material
                confidencial que se le haya solicitado. El TRABAJADOR notificará a la Empresa cualquier descubrimiento
                y/o
                producción artística o ejecución de trabajo artístico que haya hecho, considerándose esto, como parte
                del
                Material Confidencial. EI TRABAJADOR se compromete a no utilizar información o Material Confidencial
                finalizado
                la relación con el EMPLEADOR, so pena de incurrir en acciones civiles y penales descritas en la
                legislación
                colombiana.
            </li>
            <li>
                Para el objetivo de este Acuerdo, también se considerará como Material Confidencial cualquier
                información,
                observación, datos, material escrito, registro, documento, dibujo, fotografía, videos, ejecución de
                trabajo
                artístico, disposición, programas de computador, software, multimedia, programas fijos, invención,
                descubrimiento, mejora, desarrollo, instrumento, derechos de propiedad intelectual sobre los trabajos
                artísticos
                desarrollados durante la ejecución del contrato, máquina, aparato, aplicación, diseño, trabajo de
                paternidad
                literario, logo, sistema, idea promocional, lista de clientes, necesidad del cliente, práctica,
                información
                de
                precios, procesos, pruebas, concepto, fórmulas, métodos, información de mercado, técnicas, secreto de
                fabricación, producto y/o la investigación relacionada con el desarrollo de investigación real o
                previsto,
                productos, organización, control de comercialización, publicidad, negocio o fondos de Empresa, sus
                afiliados
                o
                entidades relacionadas.
            </li>
        </ul> <br><br>

        Todo lo anterior, es y será de la Empresa incluso después de terminada la relación con el TRABAJADOR

        <br><br>

        <ul>
            <li>El TRABAJADOR cumplirá con las medidas de seguridad que tome la Empresa para proteger la
                confidencialidad
                de
                cualquier información reservada o secreta de la Empresa.</li>
            <li>
                El TRABAJADOR irrevocablemente designa al Gerente o quien haga sus veces en la Empresa para realizar
                todos
                los
                actos necesarios para obtener y/o mantener patentes, derechos de autor y derechos similares a cualquier
                Información exclusiva de la Empresa, según las normas colombianas e Internacionales. La Empresa puede
                disponer
                libremente de toda su información o material Confidencial, por lo que el TRABAJADOR no tendrá ninguna
                autoridad
                para ejercer cualquier derecho o privilegios en lo concierne a la Información perteneciente
                exclusivamente
                Empresa poseída por o asignada a esta última conforme a acuerdo y las leyes colombianas.
            </li>
            <li>
                EL TRABAJADOR que viole alguna de las disposiciones antes mencionadas en relación con lo que se
                considera
                objeto
                de la Confidencialidad, ocasionará el pago de una multa de ${{ number_format($multa, 0, ',', '.') }},
                sin perjuicio de las
                demás
                acciones laborales, comerciales y penales a que haya lugar para la reclamación de indemnización de
                perjuicios
                ocasionados con la violación a la Confidencialidad aquí suscrita.
            </li>
        </ul> <br><br>

        <strong>DÉCIMO TERCERA:</strong>
        El TRABAJADOR declara que toda la información, desarrollo, descubrimiento, invención,
        procedimiento, y demás conocimiento que adquiera durante la ejecución del contrato es de propiedad exclusiva
        del
        EMPLEADOR, y que su reproducción, donación, transferencia o venta acarrea perjuicios graves para El
        EMPLEADOR,
        incluyendo a título enunciativo, pero no limitativo que el derecho de propiedad intelectual y prohibición de
        reproducción. programación. edición, compilación, diseños, logotipos, texto y/o gráficos, son propiedad
        exclusiva del EMPLEADOR, y que su reproducción, donación, transferencia a cualquier título o venta por parte
        del
        TRABAJADOR quedará sujeto a sanciones civiles y penales a las que haya lugar. <br><br>

        <strong>DÉCIMO CUARTA:</strong>
        Las invenciones o descubrimientos realizados por el TRABAJADOR contratado para investigar
        pertenecen al EMPLEADOR, de conformidad con el artículo 539 del Código de Comercio, así como en los
        artículos 20
        y concordantes de la ley 23 de 1982 sobre derechos de autor. <br><br>

        <strong>DÉCIMO QUINTA:</strong>
        Sobre la base de considerar como confidencial y reservada toda información que EL TRABAJADOR
        reciba del EMPLEADOR o de terceros en razón de su cargo, que incluye, pero sin que se limite a los elementos
        descritos, la información objeto de derecho de autor, patentes, técnicas, modelos, invenciones, know-how,
        procesos, algoritmos, programas ejecutables, investigaciones, detalles de diseño, información financiera,
        planeación estratégica, bases de datos, lista de clientes, lista de proveedores, inversionistas, empleados,
        relaciones de negocios y contractuales, pronósticos de negocios, procedimiento de entrenamiento y dirección
        de
        los modelos, videos, fotografías, planes de mercadeo e cualquier información revelada sobre terceras
        personas,
        salvo la que expresamente y por escrito se le manifieste que no tiene dicho carácter, o la que se tiene
        disponible para el público en general, EL TRABAJADOR se obliga a <br><br>

        a) Abstenerse de revelar o usar información relacionada con los trabajos o actividades que desarrolla la
        EMPRESA
        ni durante el tiempo de vigencia del contrato de trabajo ni después de finalizado éste hasta por 5 años, ya
        sea
        con terceras personas naturales o jurídicas, ni con personal de la misma EMPRESA no autorizado para conocer
        información confidencial salvo autorización expresa del EMPLEADOR. <br><br>

        b) Entregar al EMPLEADOR cuando finalice el contrato de trabajo todos los archivos en original, copias con
        información confidencial, o cualquier información del empleador, o que haya desarrollo el TRABAJADOR en
        ejecución del presente contrato, y que se encuentren en su poder, ya sea que se encuentre en documentos
        escritos, gráficos o archivos magnéticos como video, audio, CD, USB, online, entre otros. <br><br>

        c) En caso de violación de esta confidencialidad durante la vigencia del contrato de trabajo y los cinco
        años
        posteriores a la terminación del mismo el trabajador será responsable de los perjuicios económicos que
        genere al
        empleador quién podrá iniciar las acciones penales y civiles correspondientes. <br><br>

        <strong>DÉCIMO SEXTA:</strong> <br>

        <strong>Exclusividad laboral:</strong> Durante la vigencia de este acuerdo y mientras el trabajador preste el
        servicio laboral al empleador, el trabajador se compromete a trabajar exclusivamente para el empleador y no
        realizará actividades laborales para ningún otro empleador, ya sea remunerado o no, que estén directa o
        indirectamente relacionadas con las funciones y responsabilidades desempeñadas para el empleador. <br><br>

        <strong> Prohibición de contratos con terceros:</strong> El trabajador se compromete a no firmar otro contrato
        de trabajo ni
        ningún otro tipo de contrato, como el de prestación de servicios u otro de carácter civil, comercial o
        administrativo (estatal), relacionado con la actividad para la cual fue contratado por el empleador, durante
        la vigencia de este acuerdo. <br><br>

        <strong> Prohibición de actividades por cuenta propia o a través de interpuesta persona:</strong>
        Adicionalmente, el trabajador secompromete a no realizar la misma actividad o similar por cuenta propia o a
        través de interpuesta persona.
        Así mismo, queda expresamente prohibida la constitución de personas jurídicas, tales como sociedades
        comerciales, empresas unipersonales o de cualquier naturaleza, con el propósito de desarrollar la actividad para
        la cual
        fue contratado por el empleador o relacionado directa o indirectamente con la actividad principal o subsidiaria
        que desarrolla el empleador. <br><br>

        <strong>Consecuencias del incumplimiento:</strong> El incumplimiento de las disposiciones de exclusividad
        establecidas en este acuerdo constituirá una falta grave desarrollada por el trabajador, dado que la
        exclusividad acordada en
        este instrumento es esencial para proteger los intereses comerciales del empleador, y su divulgación y/o uso
        indebido resulta absolutamente lesivo para este.
        Además, se tiene en cuenta que el trabajador tiene acceso a información, experiencia o conocimientos
        especializados que son fundamentales para las operaciones de la empresa; por ello, cualquier acción
        contraria a este acuerdo se considerará una violación sustancial del contrato de trabajo y constituirá una justa
        causa
        para la terminación del contrato de trabajo por parte del empleador conforme a lo establecido en el artículo 62
        del CST. <br><br>

        <strong>Gravedad de vulnerar la exclusividad para el empleador:</strong> El empleador subraya que la
        exclusividad es esencial
        para la protección de sus intereses comerciales y estratégicos. La información, conocimientos y habilidades
        proporcionados por el trabajador son de suma importancia y confidencialidad, y cualquier vulneración de la
        exclusividad compromete gravemente la posición competitiva del empleador en el mercado; por ende, la
        violación de esta cláusula puede afectar la confianza y la relación comercial con clientes, socios y otros
        stakeholders, generando perjuicios económicos y daños irreparables a la reputación del empleador.
        Indemnización por violación de exclusividad y competencia desleal. El trabajador reconoce que cualquier
        actuar en violación de las disposiciones de exclusividad podrá generar indemnización de perjuicios a favor del
        empleador por presunta conducta de competencia desleal, de acuerdo con lo establecido en la Ley 256 de 1996
        y otras normas comerciales y civiles. <br><br>

        <strong> Vigencia de la cláusula de exclusividad:</strong> Esta cláusula de exclusividad opera únicamente
        durante la vigencia
        del contrato de trabajo y perderá efecto una vez terminada la relación laboral entre las partes. <br><br>

        <strong>DÉCIMA SÉPTIMA: </strong> Este contrato ha sido redactado estrictamente de acuerdo con la ley y la
        jurisprudencia y
        será interpretado de buena fe y en consonancia con el Código Sustantivo del Trabajo cuyo objeto, definido en su
        artículo 1º, es lograr la justicia en las relaciones entre empleadores y trabajadores dentro de un espíritu
        de coordinación económica y equilibrio social.
        El presente contrato reemplaza en su integridad y deja sin efecto cualquier otro contrato verbal o escrito
        celebrado entre las partes con anterioridad. Las modificaciones que se acuerden al presente contrato se
        anotarán a continuación de su texto. Para constancia se firma en dos o más ejemplares del mismo tenor y valor,
        ante
        testigos en la ciudad y fecha que se indican a continuación: <br><br>

        Se firma al día
        {{ ucfirst(new \NumberFormatter('es', \NumberFormatter::SPELLOUT)->format(\Carbon\Carbon::now()->day)) }}
        ({{ \Carbon\Carbon::now()->format('d') }}) del mes
        de
        {{ \Carbon\Carbon::now()->locale('es')->isoFormat('MMMM') }} ({{ \Carbon\Carbon::now()->format('m') }})
        del
        año
        {{ $yearWords }} ({{ \Carbon\Carbon::now()->format('Y') }}). <br><br>
    </div>

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
