@extends('dashboard')

@section('contenido')
<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Puestos</h2>
        <button type="button" class="btn btn-success" onclick="location.href='{{ route('puestos.create') }}'">+ Agregar nuevo puesto</button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th class="text-white">Nombre del puesto</th>
                    <th class="text-white">Descripción del puesto</th>
                    <th class="text-white">Requisitos</th>
                    <th class="text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($puestos as $puesto)
                <tr class="text-white">
                    <td>{{ $puesto->nombrePuesto }}</td>
                    <td>{{ $puesto->descripPuesto }}</td>
                    <td>{{ $puesto->requisitos }}</td>
                    <td class="d-flex justify-content-between">
                        <a href="{{ route('puestos.show', $puesto->idPuesto) }}" class="btn btn-primary btn-sm me-1">Ver</a>
                        <a href="{{ route('puestos.edit', $puesto->idPuesto) }}" class="btn btn-warning btn-sm me-1">Editar</a>
                        <form action="{{ route('puestos.destroy', $puesto->idPuesto) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
