@extends('dashboard')
@section('titulo', '- Info Cargo')

@section('contenido')

    <div class="container">

        <br><br>
        <h2>Informacion General del Cargo</h2>
        <hr>
        <div class="container text-left">
            <div class="row align-items-end">
                <div class="col">
                    <h4>Nombre del cargo: </h4>
                </div>
                <div class="col">
                    <h6>{{$datosCargo->nombreCargo}}</h6>
                </div>
            </div>
        </div>

        <div class="container text-left">
            <div class="row align-items-end">
                <div class="col">
                    <h4>Salario del cargo: </h4>
                </div>
                <div class="col">
                    <h6>$ {{$datosCargo->salario}}</h6>
                </div>
            </div>
        </div>

        <div class="container text-left">
            <div class="row align-items-end">
                <div class="col">
                    <h4>Descripcion del cargo: </h4>
                </div>
                <div class="col">
                    <h6> {!! $datosCargo->descripcionCargo !!}</h6>
                </div>
            </div>
        </div>


    </div>
@endsection