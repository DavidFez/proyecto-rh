@extends('dashboard')
@section('titulo', '- Detalle Vacacion')

@section('contenido')
    <div class="container">

        <br>
        <h2>Detalles de las vaciones otorgadas</h2>
        <hr>
    
        <h4>Nombre:</h4> <h6>{{$vacacionDetalle->datoEmpleado->nombres}} {{$vacacionDetalle->datoEmpleado->apellidos}}</h6>
        <h4>Cargo:</h4> <h6>{{$vacacionDetalle->datoEmpleado->cargo->nombreCargo}}</h6>
        <h4>Salario:</h4> <h6>$ {{$vacacionDetalle->datoEmpleado->cargo->salario}}</h6>
        <h4>Fecha de inicio de vaciones:</h4> <h6>{{$vacacionDetalle->fechaInicio}}</h6>
        <h4>Fecha de fin de vaciones:</h4> <h6>{{$vacacionDetalle->fechaFin}}</h6>
        <h4>Total de dias de vacacion:</h4> <h6>{{$vacacionDetalle->totalDias}}</h6>
        <h4>Recargo Vacaciones:</h4> <h6>$ {{$vacacionDetalle->montoVacaciones}}</h6>
        <h4>Comentario Vacaiones:</h4> <h6>{{$vacacionDetalle->comentario}}</h6>

        

    </div>
@endsection