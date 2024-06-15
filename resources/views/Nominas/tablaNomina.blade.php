@extends('dashboard')
@section('titulo', '- Tabla Nomina')

@section('contenido')
    <div class="container">

        <br>
        <h2>Nomina Mensual para el empleado</h2>
        <hr>
        <br>

        <h5>Reusmen Mensual</h5>
        <hr>
        <h6>Periodo laborado: del {{$generarNomina['fecha1']}} al {{$generarNomina['fecha2']}}</h6>
        <h6>Dias laborados: {{$generarNomina['diasLaborados']}}</h6>
        <h6>Dias de descanso: {{$generarNomina['diasDescanso']}}</h6>

        <br>
        <h5>Otros Datos</h5>
        <hr>
        <h6>Periodo Vacaiones: {{$generarNomina['periodoVacaciones']}}</h6>
        <h6>Periodo Inacapacidad: {{$generarNomina['periodoIncapacidad']}}</h6>
        <h6>Ausencias Injustificadas: {{$generarNomina['asistenciaInjus']}}</h6>
        <h6>Ausencias Justificadas: {{$generarNomina['asistenciaJus']}}</h6>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Salario Cargo</th>
                    <th scope="col">Cargo Vacaciones</th>
                    <th scope="col">Bonificaciones</th>
                    <th scope="col">Salario Bruto</th>
                    <th scope="col">ISSS {{$generarNomina['isssPorcentaje']}}%</th>
                    <th scope="col">AFP {{$generarNomina['afpPocentaje']}}%</th>
                    <th scope="col">INSA {{$generarNomina['isssPorcentaje']}}%</th>
                    <th scope="col">Total disponer</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $generarNomina['nombre'] }} {{ $generarNomina['apellido'] }}</td>
                    <td>{{ $generarNomina['cargo'] }}</td>
                    <td>{{ $generarNomina['salarioCargo'] }}</td>
                    <td>{{ $generarNomina['cargoVacaciones'] }}</td>
                    <td>{{ $generarNomina['bonificacion'] }}</td>
                    <td>{{ $generarNomina['salarioBruto'] }}</td>
                    <td>{{ $generarNomina['isss'] }}</td>
                    <td>{{ $generarNomina['afp'] }}</td>
                    <td>{{ $generarNomina['insa'] }}</td>
                    <td>{{ $generarNomina['totalDisponer'] }}</td>
        
                </tr>
                
            </tbody>

        </table>

        <br>
        <a href="{{route('verBoletaPago', $nominaId)}}" class="btn btn-primary">Generar Boleta de pago</a>

    </div>
@endsection
    