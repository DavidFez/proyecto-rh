@extends('dashboard')
@section('titulo', '- Nomina Mensual')

@section('contenido')
    
    <div class="container">
        <br><br>

        <h2>Nomina mensual: del {{date('d-m-Y', strtotime($fechaRango1))}} al {{date('d-m-Y', strtotime($fechaRango2))}}</h2>

        <br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ini. Periodo</th>
                    <th scope="col">Fin. Periodo</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Salario Bruto</th>
                    <th scope="col">AFP</th>
                    <th scope="col">ISSS</th>
                    <th scope="col">INSA</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @php
                    $numero = 1;
                @endphp

                @foreach ($listaNominas as $nomina)
                    <tr>
                        <th scope="row">{{$numero}}</th>
                        <td>{{date('d-m-Y', strtotime($nomina->fecha1))}}</td>
                        <td>{{date('d-m-Y', strtotime($nomina->fecha2))}}</td>
                        <td>{{$nomina->nombreEmpleado}}</td>
                        <td>{{$nomina->cargo}}</td>
                        <td>$ {{$nomina->salarioBruto}}</td>
                        <td>$ {{$nomina->afp}}</td>   
                        <td>$ {{$nomina->isss}}</td>
                        <td>$ {{$nomina->insa}}</td>
                        <td>
                            <a href="{{route('verDatosNomina', $nomina->idNomina)}}" class="btn btn-ver">Ver</a>
                        </td>
                    </tr>

                    @php
                        $numero++;
                    @endphp
                @endforeach

            </tbody>

        </table>
    </div>

@endsection
