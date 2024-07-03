@extends('dashboard')

@section('contenido')
    <div class="container">
        <h1>Agregar Candidato</h1>
        <form action="{{ route('candidatos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="mb-3">
                <label for="puesto_aplicado_id" class="form-label">Puesto Aplicado</label>
                <select class="form-control" id="puesto_aplicado_id" name="puesto_aplicado_id" required>
                    @foreach($puestos as $puesto)
                        <option value="{{ $puesto->idDescpPuesto }}">{{ $puesto->tituloPuesto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="curriculum" class="form-label">Curriculum (PDF)</label>
                <input type="file" class="form-control" id="curriculum" name="curriculum" required>
            </div>
            <div class="mb-3">
                <label for="dui" class="form-label">DUI (PDF)</label>
                <input type="file" class="form-control" id="dui" name="dui" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
