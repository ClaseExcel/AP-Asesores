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

        $yearWordsContrato = $formatter->format((int) \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('Y'));
        $yearWordsContrato = str_replace('í', 'i', $yearWordsContrato);

        $salario_entero = (int) round($empleado->salario);
        $salario_letras = $formatter->format($salario_entero);

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
        <h3>CONTRATO DE TRABAJO A TÉRMINO INDEFINIDO.</h3>

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
        Nacionalidad: <strong>{{ $empleado->nacionalidad }}</strong><br>
        Cargo del (la) trabajador(a): <strong>{{ strtoupper($empleado->cargo->nombre) }}</strong><br><br>

        Las partes, que suscribimos el presente Contrato de Trabajo a Término Indefinido, lo hacemos fundamentados en la
        Buena Fe, y en especial en el respeto a los principios del Derecho de Trabajo. <br><br>

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
            TÈRMINO INDEFINIDO</strong>, para ser
        ejecutado en la ciudad de <strong>{{ $empresa->ciudad }}</strong>, el cual se regirá por las siguientes
        cláusulas: <br><br>


        <strong>PRIMERA:</strong> EL EMPLEADOR contrata los servicios personales del TRABAJADOR y éste se obliga:
        <br><br>
        a) A poner al servicio del EMPLEADOR toda su capacidad normal de trabajo, en forma exclusiva, en el desempeño de
        las funciones
        propias del oficio mencionado y en las labores anexas y complementarias del mismo, de conformidad con las
        órdenes e instrucciones que le imparta EL EMPLEADOR o sus representantes, las funciones y procedimientos
        establecidos para este, observando en su cumplimiento, la diligencia, honestidad, eficacia y el cuidado
        necesario.
        <br><br>
        Y b) A no prestar directa ni indirectamente servicios laborales a otros EMPLEADORES, ni a trabajar
        por cuenta propia en el mismo oficio, en las instalaciones de la empresa y horarios laborales, durante la
        vigencia de este contrato. <br><br>

        <strong>SEGUNDA:</strong> Las partes declaran que en el presente contrato se entienden incorporadas, en lo
        pertinente, las
        disposiciones legales que regulan las relaciones entre la empresa y sus trabajadores, en especial, las del
        contrato de trabajo para el oficio que se suscribe, fuera de las obligaciones consignadas en los reglamentos de
        trabajo y de higiene y seguridad industrial de la empresa. <br><br>

        <strong>TERCERA:</strong>
        En relación con la actividad propia del EL EMPLEADO, éste la ejecutará dentro de las siguientes modalidades que
        implican claras obligaciones para EL EMPLEADO así:
        {!! $funciones !!} <br>

        <strong>PROHIBICIONES DEL TRABAJADOR:</strong> <br>

        <ul>
            <li> Ejecutar actividades diferentes a las propias de su oficio en horas de trabajo, para terceros ya fueren
                remuneradas o no, o para su provecho personal.</li>
            <li>
                Pedir o recibir dinero de los clientes de la EMPRESA y darles un destino diferente a ellos o no
                entregarlo en
                su debida oportunidad en la oficina de la EMPRESA.
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
                La inasistencia a laborar sin una excusa suficiente que lo justifique.
            </li>
        </ul> <br><br>

        <strong>CUARTA:</strong> Se remunerará con un salario básico mensual de
        <strong>${{ number_format($salario_entero, 0, ',', '.') }} ({{ $salario_letras }})</strong>
        @if ($empleado->salario < $dos_salarios_minimos)
            más auxilio de transporte de <strong>doscientos cuarenta y nueve mil noventa y cinco pesos
                ($249.095)</strong>
        @endif, pagaderos quincenalmente. Dentro de
        este pago se encuentra incluida la remuneración de los descansos dominicales y festivos de que tratan los
        capítulos I y II del título VII del Código Sustantivo del Trabajo. <br><br>

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

        <strong>QUINTA:</strong> Las partes en el citado contrato acuerdan expresamente que lo entregado en dinero o en
        especie por parte
        del EMPLEADOR al TRABAJADOR por concepto de beneficios cualquiera sea su denominación de acuerdo al artículo 15
        de la ley 50 de 1990 no constituyen salario, en especial: los auxilios o contribuciones que otorgue el empleador
        por concepto de alimentación para el trabajador, de bonificaciones extraordinarias y demás auxilios otorgados
        por mera liberalidad del empleador. <br><br>

        <strong>PARÁGRAFO PRIMERO.</strong> Cualquier beneficio que se entregue al trabajador sólo se le otorgará como
        mera liberalidad
        del empleador, por tanto, no constituye salario, ni pago laboral que sea base para el cálculo y pago de
        prestaciones sociales, aportes parafiscales, a cajas de compensación, SENA, o ICBF, entre otros; como tampoco es
        base para la determinación de las contribuciones o aportes al Sistema de Seguridad Social Integral, tales como:
        salud, pensión, riesgos profesionales, fondo de solidaridad, etc. Las partes acuerdan desde ahora que en ningún
        caso los pagos que se entreguen como auxilios o beneficios constituyen salario o son base para las cotizaciones,
        contribuciones o aportes antes descritos. <br><br>

        <strong> SEXTA:</strong> Todo trabajo suplementario o en horas extras y todo trabajo en día domingo o festivo en
        los que
        legalmente debe concederse descanso, se remunerará conforme a la ley, así como los correspondientes recargos
        nocturnos, aclarando que no serán tenidos en cuenta para cotizaciones, pagos de seguridad social, liquidaciones,
        entre otros, esto siempre se hará sobre el salario básico empleado en el presente contrato. Para el
        reconocimiento y pago del trabajo suplementario, dominical o festivo, EL EMPLEADOR o sus representantes deben
        autorizarlo previamente por escrito. Cuando la necesidad de este trabajo se presente de manera imprevista o
        inaplazable, deberá ejecutarse y darse cuenta de el por escrito o en forma verbal, a la mayor brevedad al
        EMPLEADOR o a sus representantes. EL EMPLEADOR, en consecuencia, no reconocerá ningún trabajo suplementario o en
        días de descanso legalmente obligatorio que no haya sido autorizado previamente o avisado inmediatamente, como
        queda dicho. <br><br>

        <strong>SEPTIMA:</strong> EL TRABAJADOR se obliga a laborar la jornada ordinaria en los turnos y dentro de las
        horas señalados
        por EL EMPLEADOR, pudiendo hacer éste ajustes o cambios de horario cuando lo estime conveniente. Por el acuerdo
        expreso o tácito de las partes, podrán repartirse las horas de la jornada ordinaria en la forma prevista en el
        artículo 164 del Código Sustantivo del Trabajo, modificado por el artículo 23 de la Ley 50 de 1990, teniendo en
        cuenta que los tiempos de descanso entre las secciones de la jornada no se computan dentro de la misma, según el
        artículo 167 ibídem. Así mismo el empleador y el trabajador podrán acordar que la jornada semanal de cuarenta y
        seis (46) horas se realice mediante jornadas diarias flexibles de trabajo, distribuidas en máximo seis (6) días
        a la semana con un (1) día de descanso obligatorio, que podrá coincidir con el domingo. En éste, el número de
        horas de trabajo diario podrá repartirse de manera variable durante la respectiva semana y podrá ser de mínimo
        cuatro (4) horas continuas y hasta diez (10) horas diarias sin lugar a ningún recargo por trabajo suplementario,
        cuando el número de horas de trabajo no exceda el promedio de cuarenta y seis (46) horas semanales dentro de la
        jornada ordinaria de 6 a.m. a 10 p.m. <br><br>

        <strong>OCTAVA:</strong> Este contrato es un contrato a término indefinido a partir del día
        {{ ucfirst(new \NumberFormatter('es', \NumberFormatter::SPELLOUT)->format(\Carbon\Carbon::parse($empleado->fecha_ingreso)->day)) }}
        ({{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d') }})
        mes
        {{ ucfirst(\Carbon\Carbon::parse($empleado->fecha_ingreso)->locale('es')->isoFormat('MMMM')) }}
        ({{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('m') }}) del
        año
        {{ $yearWordsContrato }}
        ({{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('Y') }}) y permanecerá mientras subsistan las
        causas que le dieron origen a ese contrato. <br><br>


        <strong>PARÁGRAFO:</strong> Los primeros dos (2) meses del presente contrato se consideran como período de
        prueba y, por
        consiguiente, cualquiera de las partes podrá terminar el contrato unilateralmente, en cualquier momento durante
        dicho período. <br><br>

        <strong>NOVENA:</strong> Son justas causas para dar por terminado unilateralmente este contrato por cualquiera
        de las partes,
        las enumeradas en el artículo 7º del Decreto 2351 de 1965; y, además, por parte del EMPLEADOR, las faltas que
        para el efecto se califiquen como graves contempladas en el reglamento interno de trabajo y en el espacio
        reservado para cláusulas adicionales en el presente contrato. <br><br>

        <strong>DÉCIMA:</strong>
        <strong>CLÁUSULA DE CONFIDENCIALIDAD:</strong> EL TRABAJADOR se obliga a guardar absoluta reserva de la
        información y
        documentación de la cual llegare a tener conocimiento en cumplimiento de las funciones para las cuales fue
        contratado, en especial no entregará ni divulgará a terceros salvo autorización previa y expresa de la Gerencia,
        información calificada por EL EMPLEADOR como confidencial, reservada o estratégica. No podrá bajo ninguna
        circunstancia revelar información a persona natural o jurídica que afecte los intereses de EL EMPLEADOR, durante
        su permanencia en el cargo ni después de su retiro, so pena de incurrir en las acciones legales pertinentes
        consagradas para la protección de esta clase de información. <br>
        EL TRABAJADOR que viole alguna de las disposiciones antes mencionadas en relación con lo que se
        considera
        objeto
        de la Confidencialidad, ocasionará el pago de una multa de ${{ number_format($multa, 0, ',', '.') }},
        sin perjuicio de las
        demás
        acciones laborales, comerciales y penales a que haya lugar para la reclamación de indemnización de
        perjuicios
        ocasionados con la violación a la Confidencialidad aquí suscrita.

        <br><br>

        <strong>DECIMA PRIMERA:</strong> Este contrato ha sido redactado estrictamente de acuerdo con la ley y la
        jurisprudencia y será
        interpretado de buena fe y en consonancia con el Código Sustantivo del Trabajo cuyo objeto, definido en su
        artículo 1º, es lograr la justicia en las relaciones entre empleadores y trabajadores dentro de un espíritu de
        coordinación económica y equilibrio social. <br><br>

        <strong>DÉCIMA SEGUNDA:</strong> El presente contrato reemplaza en su integridad y deja sin efecto cualquier
        otro contrato
        verbal o escrito celebrado entre las partes con anterioridad. Las modificaciones que se acuerden al presente
        contrato se anotarán a continuación de su texto. Para constancia se firma en dos o más ejemplares del mismo
        tenor y valor, ante testigos en la ciudad y fecha que se indican a continuación: <br><br>

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
