@extends('dashboard')

@section('contenido')
<div class="container mt-5">
    <h1 class="mb-4 text-white">Crear Perfil de Puesto</h1>
    <form action="{{ route('perfiles.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_descrip_puesto" class="form-label text-white">Perfil del puesto seleccionado</label>
            <select class="form-control" id="idDescpPuesto" name="idDescpPuesto" required>
                @foreach($puestos as $puesto)
                    <option value="{{ $puesto->idDescpPuesto }}">{{ $puesto->tituloPuesto }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="edad" class="form-label text-white">Edad</label>
            <input type="text" class="form-control bg-dark text-white" id="edad" name="edad" required>
        </div>
        <div class="mb-3">
            <label for="sexo" class="form-label text-white">Sexo</label>
            <input type="text" class="form-control bg-dark text-white" id="sexo" name="sexo" required>
        </div>
        <div class="mb-3">
            <label for="estadoCivil" class="form-label text-white">Estado Civil</label>
            <input type="text" class="form-control bg-dark text-white" id="estadoCivil" name="estadoCivil" required>
        </div>
        <div class="mb-3">
            <label for="escolaridad" class="form-label text-white">Escolaridad</label>
            <input type="text" class="form-control bg-dark text-white" id="escolaridad" name="escolaridad" required>
        </div>
        <div class="mb-3">
            <label for="residenciaPreferente" class="form-label text-white">Residencia Preferente</label>
            <input type="text" class="form-control bg-dark text-white" id="residenciaPreferente" name="residenciaPreferente" required>
        </div>
        <div class="mb-3">
            <label for="nacionalidad" class="form-label text-white">Nacionalidad</label>
            <input type="text" class="form-control bg-dark text-white" id="nacionalidad" name="nacionalidad" required>
        </div>
        <div class="mb-3">
            <label for="idiomas" class="form-label text-white">Idiomas</label>
            <input type="text" class="form-control bg-dark text-white" id="idiomas" name="idiomas" required>
        </div>
        <div class="mb-3">
            <label for="disponibilidad" class="form-label text-white">Disponibilidad</label>
            <textarea class="form-control bg-dark text-white" id="disponibilidad" name="disponibilidad" required></textarea>
        </div>
        <div class="mb-3">
            <label for="conocimientosEspecificos" class="form-label text-white">Conocimientos Específicos</label>
            <textarea class="form-control bg-dark text-white" id="conocimientosEspecificos" name="conocimientosEspecificos" required></textarea>
        </div>
        <div class="mb-3">
            <label for="experienciasPrevias" class="form-label text-white">Experiencias Previas</label>
            <input type="number" class="form-control bg-dark text-white" id="experienciasPrevias" name="experienciasPrevias" required>
        </div>
        <div class="mb-3">
            <label for="caracteristicasHabilidades" class="form-label text-white">Características y Habilidades</label>
            <textarea class="form-control bg-dark text-white" id="caracteristicasHabilidades" name="caracteristicasHabilidades" required></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Guardar</button>
    </form>
</div>
@endsection
