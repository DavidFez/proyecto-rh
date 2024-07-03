@php
    use Illuminate\Support\Facades\Storage;
@endphp
@extends('dashboard')

@section('contenido')
<div class="container">
    <h1>Detalles del Expediente</h1>
    <div class="card">
        <div class="card-header">
            Expediente #{{ $expediente->idExpediente }}
        </div>
        <div class="card-body">
            <!-- Datos del Empleado -->
            <h3>Datos del Empleado</h3>
            <p><strong>Nombres:</strong> {{ $expediente->empleado->nombres }}</p>
            <p><strong>Apellidos:</strong> {{ $expediente->empleado->apellidos }}</p>
            <p><strong>Dirección:</strong> {{ $expediente->empleado->direccion }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $expediente->empleado->fechaNacimiento }}</p>
            <p><strong>Teléfono:</strong> {{ $expediente->empleado->telefono }}</p>
            <p><strong>Correo:</strong> {{ $expediente->empleado->correo }}</p>
            <p><strong>DUI:</strong> {{ $expediente->empleado->dui }}</p>
            <p><strong>Fecha de Incorporación:</strong> {{ $expediente->empleado->fechaIncorporacion }}</p>
            <p><strong>Currículum:</strong> @if ($expediente->empleado->cv) <a href="{{ Storage::url($expediente->empleado->cv) }}" target="_blank">Ver archivo</a> @else No disponible @endif</p>
            <p><strong>Cuenta de Depósito:</strong> {{ $expediente->empleado->cuentaDeposito }}</p>
            <p><strong>Banco:</strong> {{ $expediente->empleado->banco }}</p>

            <!-- Datos del Cargo -->
            <h3>Datos del Cargo</h3>
            <p><strong>Nombre del Cargo:</strong> {{ $expediente->empleado->cargo->nombreCargo }}</p>
            <p><strong>Descripción del Cargo:</strong> {{ $expediente->empleado->cargo->descripcionCargo }}</p>
            <p><strong>Salario:</strong> {{ $expediente->empleado->cargo->salario }}</p>

            <!-- Datos del Expediente -->
            <h3>Datos del Expediente</h3>
            <p><strong>Puesto de Trabajo:</strong> {{ $expediente->puesto_trabajo }}</p>
            <p><strong>Departamento:</strong> {{ $expediente->departamento }}</p>
            <p><strong>Estado del Empleado:</strong> {{ $expediente->estado_empleado }}</p>
            <p><strong>Constancia de Policía:</strong> @if ($expediente->constancia_policia) <a href="{{ Storage::url($expediente->constancia_policia) }}" target="_blank">Ver archivo</a> @else No disponible @endif</p>
            <p><strong>Títulos o Cursos:</strong> @if ($expediente->titulos_cursos) <a href="{{ Storage::url($expediente->titulos_cursos) }}" target="_blank">Ver archivo</a> @else No disponible @endif</p>

            <a href="{{ route('expedientes.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('expedientes.edit', $expediente) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('expedientes.destroy', $expediente) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
