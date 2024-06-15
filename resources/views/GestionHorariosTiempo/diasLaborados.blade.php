@extends('dashboard')
@section('titulo', '- Dias Laborados')

@section('contenido')

    <div class="container">
        <br>
        <h3>Total de dias laborados por empleados del {{date('d-m-Y', strtotime($fechaInicio))}} al {{date('d-m-Y', strtotime($fechaFin))}} </h3>
        <hr>
        <br>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Toal dias laborados</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $numero = 1 
                @endphp
    
                @foreach ($diasLaborados as $empleado)
                    <tr>
                        <td>{{$numero}}</td>
                        <td>{{ $empleado->empleado->nombres }} {{$empleado->empleado->apellidos}}</td>
                        <td>{{ $empleado->totalDias }}</td>
                    </tr>
    
                    @php
                        $numero++
                    @endphp
                @endforeach
            </tbody>
        </table>

@endsection