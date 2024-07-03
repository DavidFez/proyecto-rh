@extends('dashboard')

@section('contenido')
<div class="container">
    <h1>Pruebas de Selección</h1>
    <a href="{{ route('pruebas.create') }}" class="btn btn-primary">Agregar Prueba</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Candidato</th>
                <th>Puesto</th>
                <th>Evaluador</th>
                <th>Puntaje Técnica (100%)</th>
                <th>Puntaje Entrevista (100%)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pruebas as $prueba)
                <tr>
                    <td>{{ $prueba->idPruebaSeleccion }}</td>
                    <td>{{ $prueba->candidato->nombre }}</td>
                    <td>{{ $prueba->puesto->tituloPuesto }}</td>
                    <td>{{ $prueba->nombreEvaluador }}</td>
                    <td>{{ $prueba->candidato->puntajePruebaTecnica }}</td>
                    <td>{{ $prueba->candidato->puntajePruebaEntrevista }}</td>
                    <td>
                        <a href="{{ route('pruebas.show', $prueba) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('pruebas.edit', $prueba) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('pruebas.destroy', $prueba) }}" method="POST" style="display:inline-block;">
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
