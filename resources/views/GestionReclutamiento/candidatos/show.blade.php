@php
    use Illuminate\Support\Facades\Storage;
@endphp
@extends('dashboard')

@section('contenido')
    <div class="container">
        <h1>Detalles del Candidato</h1>
        <div class="card">
            <div class="card-header">
                {{ $candidato->nombre }}
            </div>
            <div class="card-body">
                <p><strong>Correo:</strong> {{ $candidato->correo }}</p>
                <p><strong>Teléfono:</strong> {{ $candidato->telefono }}</p>
                <p><strong>Dirección:</strong> {{ $candidato->direccion }}</p>
                <p><strong>Puesto Aplicado:</strong> {{ $candidato->puesto->tituloPuesto }}</p>
                <p><strong>Curriculum:</strong> <a href="{{ Storage::url($candidato->curriculum) }}" target="_blank">Ver Curriculum</a></p>
                <p><strong>DUI:</strong> <a href="{{ Storage::url($candidato->dui) }}" target="_blank">Ver DUI</a></p>
                <a href="{{ route('candidatos.index') }}" class="btn btn-secondary">Volver</a>
                <a href="{{ route('candidatos.edit', $candidato) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('candidatos.destroy', $candidato->idCandidato) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
