@extends('dashboard')

@section('contenido')
<div class="container">
    <h1>Listado de Expedientes</h1>
    <a href="{{ route('expedientes.create') }}" class="btn btn-primary">Agregar Expediente</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empleado</th>
                <th>Puesto de Trabajo</th>
                <th>Departamento</th>
                <th>Estado del Empleado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expedientes as $expediente)
                <tr>
                    <td>{{ $expediente->idExpediente }}</td>
                    <td>{{ $expediente->empleado->nombres }} {{ $expediente->empleado->apellidos }}</td>
                    <td>{{ $expediente->puesto_trabajo }}</td>
                    <td>{{ $expediente->departamento }}</td>
                    <td>{{ $expediente->estado_empleado }}</td>
                    <td>
                        <a href="{{ route('expedientes.show', $expediente) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('expedientes.edit', $expediente) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('expedientes.destroy', $expediente) }}" method="POST" style="display:inline-block;">
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
