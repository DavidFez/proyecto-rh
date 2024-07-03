@extends('dashboard')

@section('contenido')
<div class="container mt-5">
    <h1 class="mb-4 text-white">Crear Descripción de Puesto</h1>
    <form action="{{ route('descripciones.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="fechaElaboracion" class="form-label text-white">Fecha de Elaboración</label>
            <input type="date" class="form-control bg-dark text-white" id="fechaElaboracion" name="fechaElaboracion" required>
        </div>
        <div class="mb-3">
            <label for="fechaRevision" class="form-label text-white">Fecha de Revisión</label>
            <input type="date" class="form-control bg-dark text-white" id="fechaRevision" name="fechaRevision" required>
        </div>
        <div class="mb-3">
            <label for="tituloPuesto" class="form-label text-white">Título del Puesto</label>
            <input type="text" class="form-control bg-dark text-white" id="tituloPuesto" name="tituloPuesto" required>
        </div>
        <div class="mb-3">
            <label for="operacionArea" class="form-label text-white">Área de Operación</label>
            <input type="text" class="form-control bg-dark text-white" id="operacionArea" name="operacionArea" required>
        </div>
        <div class="mb-3">
            <label for="puestoAlQueReporta" class="form-label text-white">Puesto al que Reporta</label>
            <input type="text" class="form-control bg-dark text-white" id="puestoAlQueReporta" name="puestoAlQueReporta" required>
        </div>
        <div class="mb-3">
            <label for="directosCantidad" class="form-label text-white">Cantidad de Directos</label>
            <input type="number" class="form-control bg-dark text-white" id="directosCantidad" name="directosCantidad" required>
        </div>
        <div class="mb-3">
            <label for="indirectosCantidad" class="form-label text-white">Cantidad de Indirectos</label>
            <input type="number" class="form-control bg-dark text-white" id="indirectosCantidad" name="indirectosCantidad" required>
        </div>
        <div class="mb-3">
            <label for="propositoPuesto" class="form-label text-white">Propósito del Puesto</label>
            <textarea class="form-control bg-dark text-white" id="propositoPuesto" name="propositoPuesto" required></textarea>
        </div>
        <div class="mb-3">
            <label for="funcionesPrincipales" class="form-label text-white">Funciones Principales</label>
            <textarea class="form-control bg-dark text-white" id="funcionesPrincipales" name="funcionesPrincipales" required></textarea>
        </div>
        <div class="mb-3">
            <label for="impactoDecisiones" class="form-label text-white">Impacto de Decisiones</label>
            <textarea class="form-control bg-dark text-white" id="impactoDecisiones" name="impactoDecisiones" required></textarea>
        </div>
        <div class="mb-3">
            <label for="idDepartamento" class="form-label text-white">Departamento</label>
            <select class="form-control bg-dark text-white" id="idDepartamento" name="idDepartamento" required>
                @foreach ($departamentos as $departamento)
                    <option value="{{ $departamento->idDepartamento }}">{{ $departamento->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-danger">Crear</button>
    </form>
</div>
@endsection
