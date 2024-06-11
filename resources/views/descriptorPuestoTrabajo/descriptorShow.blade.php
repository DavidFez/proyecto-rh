@extends('dashboard')

@section('contenido')
<div class="container mt-3">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2>Detalles del Puesto</h2>
        </div>
        <div class="card-body text-dark">
            <div class="mb-3">
                <h5 class="card-title text-dark">Nombre del puesto:</h5>
                <p class="card-text">{{ $puesto->nombrePuesto }}</p>
            </div>
            <div class="mb-3">
                <h5 class="card-title text-dark">Descripción del puesto:</h5>
                <p class="card-text">{{ $puesto->descripPuesto }}</p>
            </div>
            <div class="mb-3">
                <h5 class="card-title text-dark">Competencias:</h5>
                <p class="card-text">{{ $puesto->competencias }}</p>
            </div>
            <div class="mb-3">
                <h5 class="card-title text-dark">Responsabilidades:</h5>
                <p class="card-text">{{ $puesto->responsabilidades }}</p>
            </div>
            <div class="mb-3">
                <h5 class="card-title text-dark">Requisitos:</h5>
                <p class="card-text">{{ $puesto->requisitos }}</p>
            </div>
            <div class="mb-3">
                <h5 class="card-title text-dark">Departamento:</h5>
                <p class="card-text">{{ $puesto->departamento->nombreDepto }}</p>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('puestos.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('puestos.edit', $puesto->idPuesto) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('puestos.destroy', $puesto->idPuesto) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
