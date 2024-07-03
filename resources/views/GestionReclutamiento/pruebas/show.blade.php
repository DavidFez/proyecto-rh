@extends('dashboard')

@section('contenido')
<div class="container">
    <h1>Detalles de la Prueba de Selección</h1>
    <div class="card">
        <div class="card-header">
            Prueba #{{ $prueba->idPruebaSeleccion }}
        </div>
        <div class="card-body">
            <p><strong>Candidato:</strong> {{ $prueba->candidato->nombre }}</p>
            <p><strong>Puesto:</strong> {{ $prueba->puesto->tituloPuesto }}</p>
            <p><strong>Evaluador:</strong> {{ $prueba->nombreEvaluador }}</p>
            <p><strong>Observación:</strong> {{ $prueba->Observacion }}</p>
            <p><strong>Descripcion De Prueba Técnica:</strong> {{ $prueba->pruebaTecnica }}</p>
            <p><strong>Puntaje Prueba Técnica (100%):</strong> {{ $prueba->candidato->puntajePruebaTecnica }}</p>
            <p><strong>Descripcion De Prueba de Entrevista :</strong> {{ $prueba->pruebaEntrevista }}</p>
            <p><strong>Puntaje Prueba de Entrevista (100%):</strong> {{ $prueba->candidato->puntajePruebaEntrevista }}</p>
            <a href="{{ route('pruebas.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('pruebas.edit', $prueba) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('pruebas.destroy', $prueba) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
