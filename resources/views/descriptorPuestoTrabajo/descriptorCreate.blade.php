@extends('dashboard')

@section('contenido')
<div class="container mt-3">
    <h2>{{ isset($puesto) ? 'Editar Puesto' : 'Crear Puesto' }}</h2>
    <form action="{{ isset($puesto) ? route('puestos.update', $puesto->idPuesto) : route('puestos.store') }}" method="POST">
        @csrf
        @if(isset($puesto))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nombrePuesto" class="form-label">Nombre del puesto</label>
            <input type="text" class="form-control" id="nombrePuesto" name="nombrePuesto" value="{{ old('nombrePuesto', $puesto->nombrePuesto ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="descripPuesto" class="form-label">Descripción del puesto</label>
            <textarea class="form-control" id="descripPuesto" name="descripPuesto">{{ old('descripPuesto', $puesto->descripPuesto ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="competencias" class="form-label">Competencias</label>
            <textarea class="form-control" id="competencias" name="competencias">{{ old('competencias', $puesto->competencias ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="responsabilidades" class="form-label">Responsabilidades</label>
            <textarea class="form-control" id="responsabilidades" name="responsabilidades">{{ old('responsabilidades', $puesto->responsabilidades ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="requisitos" class="form-label">Requisitos</label>
            <textarea class="form-control" id="requisitos" name="requisitos">{{ old('requisitos', $puesto->requisitos ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="idDepartamento" class="form-label">Departamento</label>
            <select class="form-select" id="idDepartamento" name="idDepartamento" required>
                @foreach($departamentos as $departamento)
                    <option value="{{ $departamento->idDepartamento }}" {{ old('idDepartamento', $puesto->idDepartamento ?? '') == $departamento->idDepartamento ? 'selected' : '' }}>
                        {{ $departamento->nombreDepto }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($puesto) ? 'Actualizar' : 'Crear' }}</button>
    </form>
</div>
@endsection
