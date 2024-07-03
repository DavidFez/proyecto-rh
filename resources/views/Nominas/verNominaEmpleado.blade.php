@extends('dashboard')
@section('titulo', '- Nomina Empleado')

@section('contenido')
    <div class="container">

        <br>
        <h2>Nomina Mensual para el empleado</h2>
        

        <h5>Reusmen Mensual</h5>
        <hr>

            <div class="container text-left">
                <div class="row justify-content-between">
                    <div class="col-6">
                        <h6>Empleado: {{$nominaEmpleado->nombreEmpleado}}</h6>
                        <h6>Periodo laborado: del {{$nominaEmpleado->fecha1}} al {{$nominaEmpleado->fecha2}}</h6>
                        <h6>Dias laborados: {{$nominaEmpleado->diasLaborados}}</h6>
                        <h6>Dias de descanso: {{$nominaEmpleado->diasDescanso}}</h6>

                    </div>
                    <div class="col-4">
                        <h6>Cargo: {{$nominaEmpleado->cargo}}</h6>
                        <h6>Salario Cargo: {{$nominaEmpleado->salarioCargo}}</h6>
                        @if ($nominaEmpleado->bonificacion == 0 )
                            <h6>Bonificacion: No hay registro</h6>
                        @else
                            <h6>Bono concepto: {{$nominaEmpleado->bonoConcepto}}</h6>
                            <h6>Monto Bono: {{$nominaEmpleado->bonificacion}}</h6>
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
                    <h6>Periodo Vacaiones: {{$nominaEmpleado->periodoVacaciones}}</h6>
                    <h6>Periodo Inacapacidad: {{$nominaEmpleado->periodoIncapacidad}}</h6>
                    <h6>Ausencias Injustificadas: {{$nominaEmpleado->asistenciaInjus}}</h6>
                    <h6>Ausencias Justificadas: {{$nominaEmpleado->asistenciaJus}}</h6>

                </div>
                <div class="col-4">
                    <h6>Horas Extra: {{$nominaEmpleado->horasExtras}}</h6>
                    <h6>Total Horas Extras: {{$nominaEmpleado->montoHorasExtra}}</h6>
                    <h6>Asueto: {{$nominaEmpleado->asueto}}</h6>
                    <h6>Total asueto: {{$nominaEmpleado->montoAsueto}}</h6>
                    <h6>Horas Extra Asueto: {{$nominaEmpleado->horaExtraAsueto}}</h6>
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
                    <th scope="col">Salario Bruto</th>
                    <th scope="col">ISSS</th>
                    <th scope="col">AFP</th>
                    <th scope="col">INSA</th>
                    <th scope="col">Total disponer</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $nominaEmpleado->nombreEmpleado}}</td>
                    <td>{{ $nominaEmpleado->cargo}}</td>
                    <td>{{ $nominaEmpleado->cargoVacaciones}}</td>
                    <td>{{ $nominaEmpleado->salarioBruto}}</td>
                    <td>{{ $nominaEmpleado['isss'] }}</td>
                    <td>{{ $nominaEmpleado['afp'] }}</td>
                    <td>{{ $nominaEmpleado['insa'] }}</td>
                    <td>{{ $nominaEmpleado['totalDisponer'] }}</td>
        
                </tr>
                
            </tbody>

        </table>

        <div class="container text-center">
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4 offset-md-2"> 

                    <h5>Total a disponer: $ {{ $nominaEmpleado['totalDisponer'] }}</h5>

                </div>
            </div>
        </div>


        <br>

    </div>
@endsection
    