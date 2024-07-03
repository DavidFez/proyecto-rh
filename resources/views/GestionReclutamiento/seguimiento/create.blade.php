@extends('dashboard')

@section('contenido')
<div class="container">
    <h1>Agregar Seguimiento de Candidato</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('seguimiento_candidatos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="idCandidato" class="form-label">Candidato</label>
            <select class="form-control" id="idCandidato" name="idCandidato" required>
                @foreach($candidatos as $candidato)
                    <option value="{{ $candidato->idCandidato }}">{{ $candidato->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" required>
        </div>
        <div class="mb-3">
            <label for="fechaEstado" class="form-label">Fecha Estado</label>
            <input type="date" class="form-control" id="fechaEstado" name="fechaEstado" required>
        </div>
        <div class="mb-3">
            <label for="comentarios" class="form-label">Comentarios</label>
            <textarea class="form-control" id="comentarios" name="comentarios"></textarea>
        </div>
        <div class="mb-3">
            <label for="nombreEvaluador" class="form-label">Nombre del Evaluador</label>
            <input type="text" class="form-control" id="nombreEvaluador" name="nombreEvaluador">
        </div>
        <div class="mb-3">
            <label for="fechaEntrevista" class="form-label">Fecha de Entrevista</label>
            <input type="datetime-local" class="form-control" id="fechaEntrevista" name="fechaEntrevista">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection

