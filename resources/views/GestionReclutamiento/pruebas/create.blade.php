@extends('dashboard')

@section('contenido')
<div class="container">
    <h1>Agregar Prueba de Selección</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('pruebas.store') }}" method="POST">
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
            <label for="idDescpPuesto" class="form-label">Puesto</label>
            <select class="form-control" id="idDescpPuesto" name="idDescpPuesto" required>
                @foreach($puestos as $puesto)
                    <option value="{{ $puesto->idDescpPuesto }}">{{ $puesto->tituloPuesto }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nombreEvaluador" class="form-label">Nombre del Evaluador</label>
            <input type="text" class="form-control" id="nombreEvaluador" name="nombreEvaluador" required>
        </div>
        <div class="mb-3">
            <label for="Observacion" class="form-label">Observación</label>
            <textarea class="form-control" id="Observacion" name="Observacion"></textarea>
        </div>
        <div class="mb-3">
            <label for="pruebaTecnica" class="form-label">Observacion Prueba Técnica</label>
            <input type="text" class="form-control" id="pruebaTecnica" name="pruebaTecnica" required>
        </div>
        <div class="mb-3">
            <label for="puntajePruebaTecnica" class="form-label">Puntaje Prueba Técnica (100%)</label>
            <input type="number" class="form-control" id="puntajePruebaTecnica" name="puntajePruebaTecnica" min="0" max="100" required>
        </div>
        <div class="mb-3">
            <label for="pruebaEntrevista" class="form-label">Observacion Prueba de Entrevista </label>
            <input type="text" class="form-control" id="pruebaEntrevista" name="pruebaEntrevista" required>
        </div>
        <div class="mb-3">
            <label for="puntajePruebaEntrevista" class="form-label">Puntaje Prueba de Entrevista (100%)</label>
            <input type="number" class="form-control" id="puntajePruebaEntrevista" name="puntajePruebaEntrevista" min="0" max="100" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
