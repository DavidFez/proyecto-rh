@extends('dashboard')
@section('titulo', '- Nomina Mensual')

@section('contenido')
    
    <div class="container">
        <br><br>

        <h2>Boletas mensuales: del {{date('d-m-Y', strtotime($fechaBoleta1))}} al {{date('d-m-Y', strtotime($fechaBoleta2))}}</h2>

        <br>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha Registro</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Salario Bruto</th>
                    <th scope="col">AFP</th>
                    <th scope="col">ISSS</th>
                    <th scope="col">Renta</th>
                    <th scope="col">Total Descuento</th>    
                    <th scope="col">Salario Neto</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @php
                    $numero = 1;
                @endphp

                @foreach ($listaBoletas as $boleta)
                    <tr>
                        <th scope="row">{{$numero}}</th>
                        <td>{{date('d-m-Y', strtotime($boleta->fechaRegistro))}}</td>
                        <td>{{$boleta->empleado}}</td>
                        <td>{{$boleta->cargo}}</td>
                        <td>$ {{$boleta->salarioBruto}}</td>
                        <td>$ {{$boleta->afp}}</td>   
                        <td>$ {{$boleta->isss}}</td>
                        <td>$ {{$boleta->renta}}</td>
                        <td>$ {{$boleta->totalDescuento}}</td>
                        <td>$ {{$boleta->salarioNeto}}</td>
                        <td>
                            <a target="_blank" href="{{route('boletaVerArchivo', $boleta->idBoleta)}}" class="btn btn-ver">Ver</a>
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
