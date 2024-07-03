@extends('dashboard')

@section('contenido')
<div class="container">
    <h1>Listado de Seguimientos de Candidatos</h1>
    <a href="{{ route('seguimiento_candidatos.create') }}" class="btn btn-primary">Agregar Seguimiento</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Puesto Aplicado</th>
                <th>Estado</th>
                <th>Resultado Evaluación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidatos as $candidato)
                <tr>
                    <td>{{ $candidato->idCandidato }}</td>
                    <td>{{ $candidato->nombre }}</td>
                    <td>{{ $candidato->correo }}</td>
                    <td>{{ $candidato->telefono }}</td>
                    <td>{{ $candidato->puesto->tituloPuesto }}</td>
                    <td>{{ $candidato->estado }}</td>
                    <td>{{ $candidato->resultadoEvaluacion ?? ' En Proceso...' }}</td>
                    <td>
                        <a href="{{ route('seguimiento_candidatos.show', $candidato) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('seguimiento_candidatos.edit', $candidato) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('seguimiento_candidatos.destroy', $candidato) }}" method="POST" style="display:inline-block;">
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
