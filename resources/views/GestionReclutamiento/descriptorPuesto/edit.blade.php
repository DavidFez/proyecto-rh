@extends('dashboard')

@section('contenido')
<div class="container mt-5">
    <h1 class="mb-4">Editar Descripción de Puesto</h1>
    <form action="{{ route('descripciones.update', $descripcion->idDescpPuesto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="fechaElaboracion" class="form-label">Fecha de Elaboración</label>
            <input type="date" name="fechaElaboracion" id="fechaElaboracion" class="form-control" value="{{ $descripcion->fechaElaboracion }}">
        </div>
        <div class="mb-3">
            <label for="fechaRevision" class="form-label">Fecha de Revisión</label>
            <input type="date" name="fechaRevision" id="fechaRevision" class="form-control" value="{{ $descripcion->fechaRevision }}">
        </div>
        <div class="mb-3">
            <label for="tituloPuesto" class="form-label">Título del Puesto</label>
            <input type="text" name="tituloPuesto" id="tituloPuesto" class="form-control" value="{{ $descripcion->tituloPuesto }}">
        </div>
        <div class="mb-3">
            <label for="operacionArea" class="form-label">Área de Operación</label>
            <input type="text" name="operacionArea" id="operacionArea" class="form-control" value="{{ $descripcion->operacionArea }}">
        </div>
        <div class="mb-3">
            <label for="puestoAlQueReporta" class="form-label">Puesto al que Reporta</label>
            <input type="text" name="puestoAlQueReporta" id="puestoAlQueReporta" class="form-control" value="{{ $descripcion->puestoAlQueReporta }}">
        </div>
        <div class="mb-3">
            <label for="directosCantidad" class="form-label">Cantidad de Directos</label>
            <input type="number" name="directosCantidad" id="directosCantidad" class="form-control" value="{{ $descripcion->directosCantidad }}">
        </div>
        <div class="mb-3">
            <label for="indirectosCantidad" class="form-label">Cantidad de Indirectos</label>
            <input type="number" name="indirectosCantidad" id="indirectosCantidad" class="form-control" value="{{ $descripcion->indirectosCantidad }}">
        </div>
        <div class="mb-3">
            <label for="propositoPuesto" class="form-label">Propósito del Puesto</label>
            <textarea name="propositoPuesto" id="propositoPuesto" class="form-control">{{ $descripcion->propositoPuesto }}</textarea>
        </div>
        <div class="mb-3">
            <label for="funcionesPrincipales" class="form-label">Funciones Principales</label>
            <textarea name="funcionesPrincipales" id="funcionesPrincipales" class="form-control">{{ $descripcion->funcionesPrincipales }}</textarea>
        </div>
        <div class="mb-3">
            <label for="impactoDecisiones" class="form-label">Impacto de Decisiones</label>
            <textarea name="impactoDecisiones" id="impactoDecisiones" class="form-control">{{ $descripcion->impactoDecisiones }}</textarea>
        </div>
        <div class="mb-3">
            <label for="idDepartamento" class="form-label">Departamento</label>
            <select name="idDepartamento" id="idDepartamento" class="form-select">
                @foreach ($departamentos as $departamento)
                    <option value="{{ $departamento->idDepartamento }}" {{ $descripcion->idDepartamento == $departamento->idDepartamento ? 'selected' : '' }}>{{ $departamento->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
