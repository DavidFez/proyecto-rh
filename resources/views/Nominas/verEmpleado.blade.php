@extends('dashboard')
@section('titulo', '- Datos Empleados')

@section('contenido')
    

    
    <div class="container">

        <br>
        <h2>Datos del Empleado</h2>
        <hr>


        <div class="row">
            <div class="col-4">
                <h4>Nombre:</h4> 
            </div>
            <div class="col-6">
                <h5>{{$datosVerEmpleado->nombres}} {{$datosVerEmpleado->apellidos}}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <h4>Cargo:</h4> 
            </div>
            <div class="col-6">
                <h5>{{$datosVerEmpleado->cargo->nombreCargo}}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <h4>Direccion:</h4> 
            </div>
            <div class="col-6">
                <h5>{{$datosVerEmpleado->direccion}}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <h4>Fecha de nacimiento:</h4> 
            </div>
            <div class="col-6">
                <h5>{{ date('d-m-Y', strtotime($datosVerEmpleado->fechaNacimiento)) }}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <h4>Telefono:</h4> 
            </div>
            <div class="col-6">
                <h5>{{$datosVerEmpleado->telefono}}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <h4>Correo:</h4> 
            </div>
            <div class="col-6">
                <h5>{{$datosVerEmpleado->correo}}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <h4>DUI:</h4> 
            </div>
            <div class="col-6">
                <h5>{{$datosVerEmpleado->dui}}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <h4>Fecha de inicio de actividades:</h4> 
            </div>
            <div class="col-6">
                <h5>{{ date('d-m-Y', strtotime($datosVerEmpleado->fechaIncorporacion)) }}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <h4>Banco de deposito:</h4> 
            </div>
            <div class="col-6">
                <h5>{{$datosVerEmpleado->banco}}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <h4>Cuenta de deposito:</h4> 
            </div>
            <div class="col-6">
                <h5>{{$datosVerEmpleado->cuentaDeposito}}</h5>
            </div>
        </div>

    </div>


@endsection