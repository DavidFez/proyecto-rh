@extends('dashboard')
@section('titulo', '- Datos Empleados')

@section('contenido')
    <div class="container">

        <br>
        <h2>Datos del Empleado</h2>
        <hr>
        @foreach ($datosVerEmpleado as $trabajador)
            <h3>Nombre:</h3> <h5>{{$trabajador->nombres}} {{$trabajador->apellidos}}</h5>
            <h3>Cargo:</h3> <h5>{{$trabajador->cargo->nombreCargo}}</h5>
            <h3>Direccion:</h3> <h5>{{$trabajador->direccion}}</h5>
            <h3>Fecha de nacimiento:</h3> <h5>{{$trabajador->fechaNacimiento}}</h5>
            <h3>Telefono:</h3> <h5>{{$trabajador->telefono}}</h5>
            <h3>Correo</h3> <h5>{{$trabajador->correo}}</h5>
            <h3>DUI:</h3> <h5>{{$trabajador->dui}}</h5>
            <h3>Fecha de inicio de actividades:</h3> <h5>{{$trabajador->fechaIncorporacion}}</h5>
            <h3>Banco de deposito:</h3> <h5>{{$trabajador->banco}}</h5>
            <h3>Cuenta de deposito:</h3> <h5>{{$trabajador->cuentaDeposito}}</h5>
            
        @endforeach

    </div>
@endsection