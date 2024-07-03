@extends('dashboard')

@section('contenido')
<div class="container">
    <h1>Editar Prueba de Selección</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('pruebas.update', $prueba) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="idCandidato" class="form-label">Candidato</label>
            <select class="form-control" id="idCandidato" name="idCandidato" required>
                @foreach($candidatos as $candidato)
                    <option value="{{ $candidato->idCandidato }}" {{ $prueba->idCandidato == $candidato->idCandidato ? 'selected' : '' }}>{{ $candidato->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="idDescpPuesto" class="form-label">Puesto</label>
            <select class="form-control" id="idDescpPuesto" name="idDescpPuesto" required>
                @foreach($puestos as $puesto)
                    <option value="{{ $puesto->idDescpPuesto }}" {{ $prueba->idDescpPuesto == $puesto->idDescpPuesto ? 'selected' : '' }}>{{ $puesto->tituloPuesto }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nombreEvaluador" class="form-label">Nombre del Evaluador</label>
            <input type="text" class="form-control" id="nombreEvaluador" name="nombreEvaluador" value="{{ $prueba->nombreEvaluador }}" required>
        </div>
        <div class="mb-3">
            <label for="Observacion" class="form-label">Observación</label>
            <textarea class="form-control" id="Observacion" name="Observacion">{{ $prueba->Observacion }}</textarea>
        </div>
        <div class="mb-3">
            <label for="pruebaTecnica" class="form-label">Observacion Prueba Técnica</label>
            <input type="text" class="form-control" id="pruebaTecnica" name="pruebaTecnica" value="{{ $prueba->pruebaTecnica }}" required>
        </div>
        <div class="mb-3">
            <label for="puntajePruebaTecnica" class="form-label">Puntaje Prueba Técnica (50%)</label>
            <input type="number" class="form-control" id="puntajePruebaTecnica" name="puntajePruebaTecnica" value="{{ $prueba->puntajePruebaTecnica }}" min="0" max="50" required>
        </div>
        <div class="mb-3">
            <label for="pruebaEntrevista" class="form-label">Observacion Prueba de Entrevista (50%)</label>
            <input type="text" class="form-control" id="pruebaEntrevista" name="pruebaEntrevista" value="{{ $prueba->pruebaEntrevista }}" required>
        </div>
        <div class="mb-3">
            <label for="puntajePruebaEntrevista" class="form-label">Puntaje Prueba de Entrevista</label>
            <input type="number" class="form-control" id="puntajePruebaEntrevista" name="puntajePruebaEntrevista" value="{{ $prueba->puntajePruebaEntrevista }}" min="0" max="50" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
