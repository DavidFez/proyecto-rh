@extends('dashboard')
@section('titulo', '- Horas Extras')

@section('contenido')

    <div class="container">
        <br>
        <h2>Lista de horas extras</h2>
        <hr>
        <br>
    
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Salario</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora Inicio</th>
                    <th scope="col">Hora Fin</th>
                    <th scope="col">Numero Horas</th>
                    <th scope="col">Monto</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @php
                    $numero = 1 
                @endphp

                @foreach ($listaHorasExtra as $horaExtra)

                    <tr>
                        <th scope="row">{{$numero}}</th>
                        <td>{{$horaExtra->empleados->nombres}} {{$horaExtra->empleados->apellidos}}</td>
                        <td>{{$horaExtra->empleados->cargo->nombreCargo}}</td>
                        <td>{{$horaExtra->empleados->cargo->salario}}</td>
                        <td>{{$horaExtra->fecha}}</td>
                        <td>{{$horaExtra->horaInicio}}</td>
                        <td>{{$horaExtra->horaFin}}</td>
                        <td>{{$horaExtra->totalHorasExtra}}</td>
                        <td>$ {{$horaExtra->montoHorasExtra}}</td>

                    </tr>

                    @php
                        $numero++
                    @endphp
                @endforeach

                
            </tbody>

        </table>

    </div>



@endsection


