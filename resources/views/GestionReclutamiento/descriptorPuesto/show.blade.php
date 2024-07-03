@extends('dashboard')

@section('contenido')
<div class="container mt-5">
    <h1 class="mb-4 text-white">Detalle de la Descripción de Puesto</h1>
    <div class="card bg-dark text-white">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $descripcion->idDescpPuesto }}</p>
            <p><strong>Fecha de Elaboración:</strong> {{ $descripcion->fechaElaboracion }}</p>
            <p><strong>Fecha de Revisión:</strong> {{ $descripcion->fechaRevision }}</p>
            <p><strong>Título del Puesto:</strong> {{ $descripcion->tituloPuesto }}</p>
            <p><strong>Área de Operación:</strong> {{ $descripcion->operacionArea }}</p>
            <p><strong>Puesto al que Reporta:</strong> {{ $descripcion->puestoAlQueReporta }}</p>
            <p><strong>Cantidad de Directos:</strong> {{ $descripcion->directosCantidad }}</p>
            <p><strong>Cantidad de Indirectos:</strong> {{ $descripcion->indirectosCantidad }}</p>
            <p><strong>Propósito del Puesto:</strong> {{ $descripcion->propositoPuesto }}</p>
            <p><strong>Funciones Principales:</strong> {{ $descripcion->funcionesPrincipales }}</p>
            <p><strong>Impacto de Decisiones:</strong> {{ $descripcion->impactoDecisiones }}</p>
            <p><strong>Departamento:</strong> {{ $descripcion->departamento->nombre ?? 'N/A' }}</p>
        </div>
    </div>
    <a href="{{ route('descripciones.index') }}" class="btn btn-danger mt-3">Volver</a>
</div>
@endsection
