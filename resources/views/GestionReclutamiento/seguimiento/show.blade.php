@extends('dashboard')

@section('contenido')
<div class="container">
    <h1>Detalles del Candidato</h1>
    <div class="card">
        <div class="card-header">
            Candidato #{{ $candidato->idCandidato }}
            
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $candidato->nombre }}</p>
            <p><strong>Correo:</strong> {{ $candidato->correo }}</p>
            <p><strong>Teléfono:</strong> {{ $candidato->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $candidato->direccion }}</p>
            <p><strong>Puesto Aplicado:</strong> {{ $candidato->puesto->tituloPuesto}}</p>
            <p><strong>Estado De Evaluación:</strong> {{ $candidato->estado }}</p>
            <p><strong>Resultado Evaluación:</strong> {{ $candidato->resultadoEvaluacion ?? 'Esperando pruebas por realizar'}}</p>
            <p><strong>Puntaje Entrevista:</strong> {{ ($candidato->puntajePruebaEntrevista != 0) ? $candidato->puntajePruebaEntrevista  :'Sin Realizar'}}</p>
            <p><strong>Puntaje Prueba Tecnica:</strong> {{ ($candidato->puntajePruebaTecnica != 0) ? $candidato->puntajePruebaTecnica : 'Sin Realizar'}}</p>
            <p><strong>Puntaje Evaluacion CV:</strong> {{ ($candidato->puntajeCV != 0) ? $candidato->puntajeCV : 'Sin Realizar'}}</p>
            <p><strong>Puntaje Total:</strong> {{ ($candidato->puntajeCV != 0) ? $candidato->puntajeCV : 'Esperando el resultado de las evaluaciones'}}</p>
            <p><strong>Comentarios:</strong> {{ $candidato->comentarios ?? 'No existen comentarios'}}</p>
            <p><strong>Nombre Evaluador:</strong> {{ $candidato->nombreEvaluador ?? 'Vacio'}}</p>
            <a href="{{ route('seguimiento_candidatos.index') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('seguimiento_candidatos.edit', $candidato) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('seguimiento_candidatos.destroy', $candidato) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
