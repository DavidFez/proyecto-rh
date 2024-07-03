@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('dashboard')

@section('contenido')
<div class="container">
    <h1>Editar Expediente</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('expedientes.update', $expediente) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Campos de Empleado -->
        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $expediente->empleado->nombres }}" required>
        </div>
        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $expediente->empleado->apellidos }}" required>
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $expediente->empleado->direccion }}" required>
        </div>
        <div class="mb-3">
            <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" value="{{ $expediente->empleado->fechaNacimiento }}" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $expediente->empleado->telefono }}" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" value="{{ $expediente->empleado->correo }}">
        </div>
        <div class="mb-3">
            <label for="dui" class="form-label">DUI</label>
            <input type="text" class="form-control" id="dui" name="dui" value="{{ $expediente->empleado->dui }}" required>
        </div>
        <div class="mb-3">
            <label for="fechaIncorporacion" class="form-label">Fecha de Incorporación</label>
            <input type="date" class="form-control" id="fechaIncorporacion" name="fechaIncorporacion" value="{{ $expediente->empleado->fechaIncorporacion }}" required>
        </div>
        <div class="mb-3">
            <label for="cv" class="form-label">Currículum (PDF)</label>
            <input type="file" class="form-control" id="cv" name="cv">
            @if ($expediente->empleado->cv)
                <a href="{{ Storage::url($expediente->empleado->cv) }}" target="_blank">Ver archivo actual</a>
            @endif
        </div>
        <div class="mb-3">
            <label for="cuentaDeposito" class="form-label">Cuenta de Depósito</label>
            <input type="text" class="form-control" id="cuentaDeposito" name="cuentaDeposito" value="{{ $expediente->empleado->cuentaDeposito }}">
        </div>
        <div class="mb-3">
            <label for="banco" class="form-label">Banco</label>
            <input type="text" class="form-control" id="banco" name="banco" value="{{ $expediente->empleado->banco }}">
        </div>
        
        <!-- Campos de Cargo -->
        <div class="mb-3">
            <label for="nombreCargo" class="form-label">Nombre del Cargo</label>
            <input type="text" class="form-control" id="nombreCargo" name="nombreCargo" value="{{ $expediente->empleado->cargo->nombreCargo }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcionCargo" class="form-label">Descripción del Cargo</label>
            <textarea class="form-control" id="descripcionCargo" name="descripcionCargo">{{ $expediente->empleado->cargo->descripcionCargo }}</textarea>
        </div>
        <div class="mb-3">
            <label for="salario" class="form-label">Salario</label>
            <input type="number" class="form-control" id="salario" name="salario" step="0.01" value="{{ $expediente->empleado->cargo->salario }}" required>
        </div>

        <!-- Campos de Expediente -->
        <div class="mb-3">
            <label for="constancia_policia" class="form-label">Constancia de Policía</label>
            <input type="file" class="form-control" id="constancia_policia" name="constancia_policia">
            @if ($expediente->constancia_policia)
                <a href="{{ Storage::url($expediente->constancia_policia) }}" target="_blank">Ver archivo actual</a>
            @endif
        </div>
        <div class="mb-3">
            <label for="titulos_cursos" class="form-label">Títulos o Cursos</label>
            <input type="file" class="form-control" id="titulos_cursos" name="titulos_cursos">
            @if ($expediente->titulos_cursos)
                <a href="{{ Storage::url($expediente->titulos_cursos) }}" target="_blank">Ver archivo actual</a>
            @endif
        </div>
        <div class="mb-3">
            <label for="puesto_trabajo" class="form-label">Puesto de Trabajo</label>
            <input type="text" class="form-control" id="puesto_trabajo" name="puesto_trabajo" value="{{ $expediente->puesto_trabajo }}">
        </div>
        <div class="mb-3">
            <label for="departamento" class="form-label">Departamento</label>
            <input type="text" class="form-control" id="departamento" name="departamento" value="{{ $expediente->departamento }}">
        </div>
        <div class="mb-3">
            <label for="estado_empleado" class="form-label">Estado del Empleado</label>
            <input type="text" class="form-control" id="estado_empleado" name="estado_empleado" value="{{ $expediente->estado_empleado }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
