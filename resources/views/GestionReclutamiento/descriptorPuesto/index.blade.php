@extends('dashboard')

@section('contenido')
<div class="container mt-5">
    <h1 class="mb-4 text-white">Descripciones de Puestos</h1>
    <a href="{{ route('descripciones.create') }}" class="btn btn-danger mb-3">Crear Descripción</a>
    <div class="table-responsive">
        <table class="table table-dark table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Título del Puesto</th>
                    <th>Área de Operación</th>
                    <th>Departamento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($descripciones as $descripcion)
                    <tr>
                        <td>{{ $descripcion->idDescpPuesto }}</td>
                        <td>{{ $descripcion->tituloPuesto }}</td>
                        <td>{{ $descripcion->operacionArea }}</td>
                        <td>{{ $descripcion->departamento->nombre ?? 'N/A' }}</td>
                        <td class="d-flex">
                            <a href="{{ route('descripciones.show', $descripcion->idDescpPuesto) }}" class="btn btn-info btn-sm me-1">Ver</a>
                            <a href="{{ route('descripciones.edit', $descripcion->idDescpPuesto) }}" class="btn btn-warning btn-sm me-1">Editar</a>
                            <form action="{{ route('descripciones.destroy', $descripcion->idDescpPuesto) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm me-1">Eliminar</button>
                            </form>
                            <a href="{{ route('descripciones.generarPDF', $descripcion->idDescpPuesto) }}" class="btn btn-secondary btn-sm">PDF</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
