@extends('dashboard')
@section('titulo', '- Tabla Nomina')

@section('contenido')
    <div class="container">

        <br>
        <h2>Nomina Mensual para el empleado</h2>
        

        <h5>Reusmen Mensual</h5>
        <hr>

            <div class="container text-left">
                <div class="row justify-content-between">
                    <div class="col-6">
                        <h6>Empleado: {{ $generarNomina['nombre'] }} {{ $generarNomina['apellido'] }}</h6>
                        <h6>Periodo laborado: del {{$generarNomina['fecha1']}} al {{$generarNomina['fecha2']}}</h6>
                        <h6>Dias laborados: {{$generarNomina['diasLaborados']}}</h6>
                        <h6>Dias de descanso: {{$generarNomina['diasDescanso']}}</h6>

                    </div>
                    <div class="col-4">
                        <h6>Cargo: {{$generarNomina['cargo']}}</h6>
                        <h6>Salario Cargo: {{$generarNomina['salarioCargo']}}</h6>
                        @if ($generarNomina['bonificacion'] == 0 )
                            <h6>Bonificacion: No hay registro</h6>
                        @else
                            <h6>Bono concepto: {{$generarNomina['bonoConcepto']}}</h6>
                            <h6>Monto Bono: {{$generarNomina['bonificacion']}}</h6>
                        @endif
                        

                    </div>
                </div>
            </div>
        <br>
        

        <h5>Otros Datos</h5>
        <hr>
        <div class="container text-left">
            <div class="row justify-content-between">
                <div class="col-6">
                    <h6>Periodo Vacaiones: {{$generarNomina['periodoVacaciones']}}</h6>
                    <h6>Periodo Inacapacidad: {{$generarNomina['periodoIncapacidad']}}</h6>
                    <h6>Dias Incapacidad: {{$generarNomina['diasIncapacidad']}}</h6>
                    <h6>Ausencias Injustificadas: {{$generarNomina['asistenciaInjus']}}</h6>
                    <h6>Ausencias Justificadas: {{$generarNomina['asistenciaJus']}}</h6>

                </div>
                <div class="col-4">
                    <h6>Horas Extra: {{$generarNomina['horasExtras']}}</h6>
                    <h6>Total Horas Extras: {{$generarNomina['montoHorasExtra']}}</h6>
                    <h6>Asueto: {{$generarNomina['asueto']}}</h6>
                    <h6>Total asueto: {{$generarNomina['montoAsueto']}}</h6>
                    <h6>Horas Extra Asueto: {{$generarNomina['horaExtraAsueto']}}</h6>
                </div>
            </div>
        </div>
        
        <br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Cargo</th>
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

        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4 offset-md-2"> 

                    <h5>Total a disponer: $ {{ $generarNomina['totalDisponer'] }}</h5>

                </div>
            </div>
        </div>


        <br>
        <a href="{{route('verBoletaPago', $nominaId)}}" class="btn btn-primary">Generar Boleta de pago</a>
        

    </div>
@endsection
    