@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('dashboard')

@section('contenido')
    <div class="container">
        <h1>Candidatos</h1>
        <a href="{{ route('candidatos.create') }}" class="btn btn-primary">Agregar Candidato</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Puesto Aplicado</th>
                    <th>Curriculum</th>
                    <th>DUI</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($candidatos as $candidato)
                    <tr>
                        <td>{{ $candidato->nombre }}</td>
                        <td>{{ $candidato->telefono }}</td>
                        <td>{{ $candidato->puesto->tituloPuesto }}</td>
                        <td><a href="{{ Storage::url($candidato->curriculum) }}" target="_blank">Ver Curriculum</a></td>
                        <td><a href="{{ Storage::url($candidato->dui) }}" target="_blank">Ver DUI</a></td>
                        <td>
                            <a href="{{ route('candidatos.show', $candidato->idCandidato) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('candidatos.edit', $candidato->idCandidato) }}" class="btn btn-warning">Editar</a>
                            <a href="{{ route('candidatos.evaluarCV', $candidato->idCandidato) }}" class="btn btn-secondary">Evaluar CV</a>
                            <form action="{{ route('candidatos.destroy', $candidato->idCandidato) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
