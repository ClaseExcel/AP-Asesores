<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Boostrap -->
    <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Jquery -->
    <script type="text/javascript" src="{{ asset('lib/jquery-3.6.1.min.js') }}"></script>
    <title>Empleados</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/actareintegro/acta.css') }}" />

</head>

<body>
    <table>
        <thead>
            <tr>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Estado</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Cédula</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Nombres</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Apellidos</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Empresa</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Empresas secundarias</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Fecha de nacimiento</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Salario</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Fecha de inicio de contrato</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Fecha de ingreso</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Nivel de riesgo</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    ¿Funeraria?</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Correo eléctronico</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Correos secundarios</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Número contacto</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Dirección</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Barrio</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Tipo de contrato</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    EPS</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Contraseña EPS</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Fondo de pensión</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Caja de compensación</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Fecha de retiro</th>
                <th
                    style="background-color: #D0AA66; color: #FFFFFF; border: #080000 1px solid; text-align: center; border: solid #080000 10px;">
                    Censantías</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                @php
                $empresas_secundarias = null;
                    if ($empleado->empresas_secundarias != null  &&  $empleado->empresas_secundarias != "null") {
                        $empresas_secundarias = \App\Models\Empresa::whereIn(
                            'id',
                            json_decode($empleado->empresas_secundarias),
                        )
                            ->pluck('razon_social')
                            ->implode(', ');
                    }
                @endphp

                <tr>
                    <td>{{ $empleado->usuarios->estado }}</td>
                    <td>{{ $empleado->usuarios->cedula }}</td>
                    <td>{{ $empleado->usuarios->nombres }}</td>
                    <td>{{ $empleado->usuarios->apellidos }}</td>
                    <td>{{ $empleado->empresas->razon_social }}</td>
                    <td>{{ $empresas_secundarias }}</td>
                    <td>{{ $empleado->usuarios->fecha_nacimiento }}</td>
                    <td>{{ $empleado->usuarios->salario }}</td>
                    <td>{{ $empleado->usuarios->fecha_contrato }}</td>
                    <td>{{ $empleado->usuarios->fecha_ingreso }}</td>
                    <td>{{ $empleado->usuarios->nivel_riesgo }}</td>
                    <td>{{ $empleado->usuarios->funeraria ? $empleado->usuarios->funeraria : 'NO' }}</td>
                    <td>{{ $empleado->usuarios->email }}</td>
                    <td>{{ $empleado->correos_secundarios }}</td>
                    <td>{{ $empleado->usuarios->numero_contacto }}</td>
                    <td>{{ $empleado->usuarios->direccion }}</td>
                    <td>{{ $empleado->usuarios->barrio }}</td>
                    <td>{{ $empleado->usuarios->tipo_contrato }}</td>
                    <td>{{ $empleado->usuarios->EPS }}</td>
                    <td>{{ $empleado->usuarios->contrasena_eps }}</td>
                    <td>{{ $empleado->usuarios->fondo_pension }}</td>
                    <td>{{ $empleado->usuarios->caja_compensacion }}</td>
                    <td>{{ $empleado->usuarios->fecha_retiro ? $empleado->usuarios->fecha_retiro : 'Sin fecha de retiro' }}
                    </td>
                    <td>{{ $empleado->usuarios->censantias }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
<script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
