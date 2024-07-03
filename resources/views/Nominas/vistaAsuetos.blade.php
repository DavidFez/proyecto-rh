@extends('dashboard')
@section('titulo', '- Asuetos Empleados')

@section('contenido')

    <div class="container">
        <br>
        <h2>Asuetos del mes</h2>
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
                    <th scope="col">Asueto</th>
                    <th scope="col">Horas Extras</th>
                    <th scope="col">Total Asueto</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @php
                    $numero = 1 
                @endphp

                @foreach ($listaAsuetos as $asueto)

                    <tr>
                        <th scope="row">{{$numero}}</th>
                        <td>{{$asueto->empleado->nombres}} {{$asueto->empleado->apellidos}}</td>
                        <td>{{$asueto->empleado->cargo->nombreCargo}}</td>
                        <td>{{$asueto->empleado->cargo->salario}}</td>
                        <td>{{$asueto->fecha}}</td>
                        <td>{{$asueto->asueto}}</td>
                        <td>{{$asueto->horasExtra}}</td>
                        <td>{{$asueto->totalAsueto}}</td>
            

                    </tr>

                    @php
                        $numero++
                    @endphp
                @endforeach

                
            </tbody>

        </table>

    </div>



@endsection


