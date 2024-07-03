@extends('dashboard')

@section('contenido')
<div class="container mt-5">
    <h1 class="mb-4 text-white">Editar Perfil de Puesto</h1>
    
    <form action="{{ route('perfiles.update', $perfil->idPerfilPuesto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_descrip_puesto" class="form-label text-white">Perfil del puesto seleccionado</label>
            <select class="form-control" id="idDescpPuesto" name="idDescpPuesto" required>
                @foreach($puestos as $puesto)
                <option value="{{ $puesto->idDescpPuesto }}" {{ $puesto->idDescpPuesto == $perfil->idDescpPuesto ? 'selected' : '' }}>
                {{ $puesto->tituloPuesto }}    
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="edad" class="form-label text-white">Edad</label>
            <input type="text" class="form-control bg-dark text-white" id="edad" name="edad" value="{{ $perfil->edad }}" required>
        </div>
        <div class="mb-3">
            <label for="sexo" class="form-label text-white">Sexo</label>
            <input type="text" class="form-control bg-dark text-white" id="sexo" name="sexo" value="{{ $perfil->sexo }}" required>
        </div>
        <div class="mb-3">
            <label for="estadoCivil" class="form-label text-white">Estado Civil</label>
            <input type="text" class="form-control bg-dark text-white" id="estadoCivil" name="estadoCivil" value="{{ $perfil->estadoCivil }}" required>
        </div>
        <div class="mb-3">
            <label for="escolaridad" class="form-label text-white">Escolaridad</label>
            <input type="text" class="form-control bg-dark text-white" id="escolaridad" name="escolaridad" value="{{ $perfil->escolaridad }}" required>
        </div>
        <div class="mb-3">
            <label for="residenciaPreferente" class="form-label text-white">Residencia Preferente</label>
            <input type="text" class="form-control bg-dark text-white" id="residenciaPreferente" name="residenciaPreferente" value="{{ $perfil->residenciaPreferente }}" required>
        </div>
        <div class="mb-3">
            <label for="nacionalidad" class="form-label text-white">Nacionalidad</label>
            <input type="text" class="form-control bg-dark text-white" id="nacionalidad" name="nacionalidad" value="{{ $perfil->nacionalidad }}" required>
        </div>
        <div class="mb-3">
            <label for="idiomas" class="form-label text-white">Idiomas</label>
            <input type="text" class="form-control bg-dark text-white" id="idiomas" name="idiomas" value="{{ $perfil->idiomas }}" required>
        </div>
        <div class="mb-3">
            <label for="disponibilidad" class="form-label text-white">Disponibilidad</label>
            <textarea class="form-control bg-dark text-white" id="disponibilidad" name="disponibilidad" required>{{ $perfil->disponibilidad }}</textarea>
        </div>
        <div class="mb-3">
            <label for="conocimientosEspecificos" class="form-label text-white">Conocimientos Específicos</label>
            <textarea class="form-control bg-dark text-white" id="conocimientosEspecificos" name="conocimientosEspecificos" required>{{ $perfil->conocimientosEspecificos }}</textarea>
        </div>
        <div class="mb-3">
            <label for="experienciasPrevias" class="form-label text-white">Experiencias Previas</label>
            <input type="number" class="form-control bg-dark text-white" id="experienciasPrevias" name="experienciasPrevias" value="{{ $perfil->experienciasPrevias }}" required>
        </div>
        <div class="mb-3">
            <label for="caracteristicasHabilidades" class="form-label text-white">Características y Habilidades</label>
            <textarea class="form-control bg-dark text-white" id="caracteristicasHabilidades" name="caracteristicasHabilidades" required>{{ $perfil->caracteristicasHabilidades }}</textarea>
        </div>
        <button type="submit" class="btn btn-danger">Actualizar</button>
    </form>
</div>
@endsection
