@extends('dashboard')
@section('titulo', '- Boleta de Pago')

@section('contenido')
    <div class="container">

        <br>
        <h2>Boleta de Pago</h2>
        <hr>
        <h4>Empleador: The Burger Rock S.A</h4>
        <br>

        <div class="container">
            <div class="row">
                <div class="col-4">
                    <p><b>NOMBRE: </b>{{$boletaDatos['nombre']}}</p>
                    <p><b>CARGO: </b>{{$boletaDatos['cargo']}}</p>
                    <p><b>SALARIO MES: $ </b>{{$boletaDatos['salario']}}</p>
                </div>
                <div class="col-6">
                    <p><b>PERIODO LABORADO: </b>{{$boletaDatos['fecha1']}} - {{$boletaDatos['fecha2']}}</p>
                    <p><b>TOTAL DIAS DE TRABAJO: </b>{{$boletaDatos['diasLaborados']}}</p>
                    <p><b>TOTAL DIAS DESCANSO: </b>{{$boletaDatos['diasDescanso']}}</p>
                </div>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descuentos</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <th scope="row">1</th>
                    <th>AFP</th>
                    <th>$ {{$boletaDatos['isss']}}</th>
                </tr>

                <tr>
                    <th scope="row">2</th>
                    <th>ISSS</th>
                    <th>$ {{$boletaDatos['afp']}}</th>
                </tr>

                <tr>
                    <th scope="row">3</th>
                    <th>RENTA</th>
                    <th>$ {{$boletaDatos['renta']}}</th>
                </tr>

            </tbody>

        </table>
        <br>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-4"> 
                    <h4>TOTAL DESCUNETOS: $ {{$boletaDatos['totalDescuentos']}}</h4>
                </div>
                    
                <div class="col-md-4 offset-md-4">
                    <h4>SALARIO NETO: $ {{$boletaDatos['salarioNeto']}}</h4>
                </div>
            </div>
        </div>

        <br>
        <a href="#" class="btn btn-primary">Ver Boleta para el trabajador</a>

    </div>
@endsection
    