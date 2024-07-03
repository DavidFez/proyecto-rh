@php
    use Illuminate\Support\Facades\Storage;
@endphp
@extends('dashboard')

@section('contenido')
    <div class="container">
        <h1>Editar Candidato</h1>
        <form action="{{ route('candidatos.update', $candidato->idCandidato) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $candidato->nombre }}" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" value="{{ $candidato->correo }}" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $candidato->telefono }}" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $candidato->direccion }}" required>
            </div>
            <div class="mb-3">
                <label for="puesto_aplicado_id" class="form-label">Puesto Aplicado</label>
                <select class="form-control" id="puesto_aplicado_id" name="puesto_aplicado_id" required>
                    @foreach($puestos as $puesto)
                        <option value="{{ $puesto->idDescpPuesto }}" {{ $candidato->puesto_aplicado_id == $puesto->idDescpPuesto ? 'selected' : '' }}>{{ $puesto->tituloPuesto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="curriculum" class="form-label">Curriculum (PDF)</label>
                <input type="file" class="form-control" id="curriculum" name="curriculum">
                @if($candidato->curriculum)
                    <a href="{{ Storage::url($candidato->curriculum) }}" target="_blank">Ver Curriculum Actual</a>
                @endif
            </div>
            <div class="mb-3">
                <label for="dui" class="form-label">DUI (PDF)</label>
                <input type="file" class="form-control" id="dui" name="dui">
                @if($candidato->dui)
                    <a href="{{ Storage::url($candidato->dui) }}" target="_blank">Ver DUI Actual</a>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
