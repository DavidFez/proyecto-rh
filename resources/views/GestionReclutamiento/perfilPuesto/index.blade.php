@extends('dashboard')

@section('contenido')
<div class="container mt-5">
    <h1 class="mb-4 text-white">Perfiles de Puestos</h1>
    <a href="{{ route('perfiles.create') }}" class="btn btn-danger mb-3">Crear Perfil</a>
    <div class="table-responsive">
        <table class="table table-dark table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Edad</th>
                    <th>Sexo</th>
                    <th>Estado Civil</th>
                    <th>Escolaridad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perfiles as $perfil)
                    <tr>
                        <td>{{ $perfil->idPerfilPuesto }}</td>
                        <td>{{ $perfil->edad }}</td>
                        <td>{{ $perfil->sexo }}</td>
                        <td>{{ $perfil->estadoCivil }}</td>
                        <td>{{ $perfil->escolaridad }}</td>
                        <td class="d-flex">
                            <a href="{{ route('perfiles.show', $perfil->idPerfilPuesto) }}" class="btn btn-info btn-sm me-1">Ver</a>
                            <a href="{{ route('perfiles.edit', $perfil->idPerfilPuesto) }}" class="btn btn-warning btn-sm me-1">Editar</a>
                            <form action="{{ route('perfiles.destroy', $perfil->idPerfilPuesto) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm me-1">Eliminar</button>
                            </form>
                            <a href="{{ route('perfiles.generarPDF', $perfil->idPerfilPuesto) }}" class="btn btn-secondary btn-sm">PDF</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
