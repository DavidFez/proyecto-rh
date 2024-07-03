@extends('dashboard')

@section('contenido')
<div class="container mt-5">
    <h1 class="mb-4 text-white">Detalle del Perfil de Puesto</h1>
    <div class="card bg-dark text-white">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $perfil->idPerfilPuesto }}</p>
            <p><strong>Perfil del puesto:</strong> {{ $descripcion->tituloPuesto }}</p>
            <p><strong>Edad:</strong> {{ $perfil->edad }}</p>
            <p><strong>Sexo:</strong> {{ $perfil->sexo }}</p>
            <p><strong>Estado Civil:</strong> {{ $perfil->estadoCivil }}</p>
            <p><strong>Escolaridad:</strong> {{ $perfil->escolaridad }}</p>
            <p><strong>Residencia Preferente:</strong> {{ $perfil->residenciaPreferente }}</p>
            <p><strong>Nacionalidad:</strong> {{ $perfil->nacionalidad }}</p>
            <p><strong>Idiomas:</strong> {{ $perfil->idiomas }}</p>
            <p><strong>Disponibilidad:</strong> {{ $perfil->disponibilidad }}</p>
            <p><strong>Conocimientos Específicos:</strong> {{ $perfil->conocimientosEspecificos }}</p>
            <p><strong>Experiencias Previas:</strong> {{ $perfil->experienciasPrevias }}</p>
            <p><strong>Características y Habilidades:</strong> {{ $perfil->caracteristicasHabilidades }}</p>
        </div>
    </div>
    <a href="{{ route('perfiles.index') }}" class="btn btn-danger mt-3">Volver</a>
</div>
@endsection
