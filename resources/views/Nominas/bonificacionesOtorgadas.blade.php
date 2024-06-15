@extends('dashboard')
@section('titulo', '- Bonificaciones')

@section('contenido')

    <div class="container">
        <br>

        <h2>Bonificaciones otorgadas del {{date('d-m-Y', strtotime($fechaInicial))}} al {{date('d-m-Y', strtotime($fechaFinal))}} </h2>
        <hr>

        @if($listaBonos->isEmpty())
            <p>NO SE HAN OTORGADO BONIFICACIONES EN LAS FECHAS INGRESADAS</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Empleado</th>
                        <th>Bonificación</th>
                        <th>Monto</th>
                        <th>Fecha de Bonificación</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $numero = 1;
                    @endphp
                    @foreach($listaBonos as $bonificacion)
                        <tr>
                            <td>{{$numero}}</td>
                            <td>{{ $bonificacion->empleados->nombres }} {{ $bonificacion->empleados->apellidos }}</td>
                            <td>{{ $bonificacion->bonificacion }}</td>
                            <td>{{ $bonificacion->monto }}</td>
                            <td>{{ date('d-m-Y', strtotime($bonificacion->fechaBonificacion)) }}</td>
                        </tr>

                        @php
                            $numero++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>



@endsection