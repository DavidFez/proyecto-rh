@extends('dashboard')

@section('contenido')
<div class="container">
    <h1>Editar Seguimiento de Candidato</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('seguimiento_candidatos.update', $candidato) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" value="{{ $candidato->estado }}" required>
        </div>
        <div class="mb-3">
            <label for="fechaEstado" class="form-label">Fecha Estado</label>
            <input type="date" class="form-control" id="fechaEstado" name="fechaEstado" value="{{ $candidato->fechaEstado }}" required>
        </div>
        <div class="mb-3">
            <label for="comentarios" class="form-label">Comentarios</label>
            <textarea class="form-control" id="comentarios" name="comentarios">{{ $candidato->comentarios }}</textarea>
        </div>
        <div class="mb-3">
            <label for="nombreEvaluador" class="form-label">Nombre del Evaluador</label>
            <input type="text" class="form-control" id="nombreEvaluador" name="nombreEvaluador" value="{{ $candidato->nombreEvaluador }}">
        </div>
        <div class="mb-3">
            <label for="fechaEntrevista" class="form-label">Fecha de Entrevista</label>
            <input type="datetime-local" class="form-control" id="fechaEntrevista" name="fechaEntrevista" value="{{ $candidato->fechaEntrevista ? $candidato->fechaEntrevista->format('Y-m-d\TH:i') : '' }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
