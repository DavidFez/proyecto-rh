@extends('dashboard')

@section('contenido')
<div class="container mt-3">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2>Editar Puesto</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('puestos.update', $puesto->idPuesto) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombrePuesto" class="form-label text-dark">Nombre del puesto</label>
                    <input type="text" class="form-control bg-secondary text-white" id="nombrePuesto" name="nombrePuesto" value="{{ old('nombrePuesto', $puesto->nombrePuesto) }}" required>
                </div>

                <div class="mb-3">
                    <label for="descripPuesto" class="form-label text-dark">Descripción del puesto</label>
                    <textarea class="form-control bg-secondary text-white" id="descripPuesto" name="descripPuesto" rows="3" required>{{ old('descripPuesto', $puesto->descripPuesto) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="competencias" class="form-label text-dark">Competencias</label>
                    <textarea class="form-control bg-secondary text-white" id="competencias" name="competencias" rows="3">{{ old('competencias', $puesto->competencias) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="responsabilidades" class="form-label text-dark">Responsabilidades</label>
                    <textarea class="form-control bg-secondary text-white" id="responsabilidades" name="responsabilidades" rows="3">{{ old('responsabilidades', $puesto->responsabilidades) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="requisitos" class="form-label text-dark">Requisitos</label>
                    <textarea class="form-control bg-secondary text-white" id="requisitos" name="requisitos" rows="3">{{ old('requisitos', $puesto->requisitos) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="idDepartamento" class="form-label text-dark">Departamento</label>
                    <select class="form-select bg-secondary text-white" id="idDepartamento" name="idDepartamento" required>
                        @foreach($departamentos as $departamento)
                            <option value="{{ $departamento->idDepartamento }}" {{ old('idDepartamento', $puesto->idDepartamento) == $departamento->idDepartamento ? 'selected' : '' }}>
                                {{ $departamento->nombreDepto }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('puestos.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
