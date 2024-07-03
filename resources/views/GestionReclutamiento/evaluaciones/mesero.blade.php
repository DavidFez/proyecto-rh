@extends('dashboard')

@section('contenido')
<div class="container">
    <h1 class="mb-4">Evaluación de Currículum Vitae - Mesero</h1>
    <form action="" method="POST">
        @csrf
        <!-- Datos del Postulante -->
        <div class="card mb-4">
            <div class="card-header">
                Datos del Postulante
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos del postulante</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                </div>
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres del postulante</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" required>
                </div>
                <div class="mb-3">
                    <label for="edad" class="form-label">Edad del postulante</label>
                    <input type="number" class="form-control" id="edad" name="edad" required>
                </div>
                <div class="mb-3">
                    <label for="cargo" class="form-label">Cargo al que postula</label>
                    <input type="text" class="form-control" id="cargo" name="cargo" value="Mesero" readonly>
                </div>
                <div class="mb-3">
                    <label for="expediente" class="form-label">Expediente del postulante No.</label>
                    <input type="text" class="form-control" id="expediente" name="expediente" required>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha de evaluación</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>
            </div>
        </div>
        
        <!-- Categorías de Evaluación -->
        <div class="card mb-4">
            <div class="card-header">
                Formación Académica (Máximo 20 puntos)
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="formacion_academica" class="form-label">Grado Universitario</label>
                        <select class="form-select" id="formacion_academica" name="formacion_academica">
                            <option value="20">Administración de Restaurantes - 20 puntos</option>
                            <option value="15">Gastronomía - 15 puntos</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="grado_tecnico" class="form-label">Grado Técnico</label>
                        <select class="form-select" id="grado_tecnico" name="grado_tecnico">
                            <option value="10">Técnico en Atención al Cliente - 10 puntos</option>
                            <option value="10">Técnico en Servicios de Alimentos y Bebidas - 10 puntos</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="experiencia_laboral" class="form-label">Experiencia Laboral (Máximo 30 puntos)</label>
                        <input type="number" class="form-control" id="experiencia_laboral" name="experiencia_laboral" max="30" required>
                    </div>
                    <div class="col-md-6">
                        <label for="cargos_desempeñados" class="form-label">Cargos Desempeñados</label>
                        <input type="number" class="form-control" id="cargos_desempeñados" name="cargos_desempeñados" max="15" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="habilidades_tecnicas" class="form-label">Habilidades Técnicas (Máximo 22 puntos)</label>
                        <input type="number" class="form-control" id="habilidades_tecnicas" name="habilidades_tecnicas" max="22" required>
                    </div>
                    <div class="col-md-6">
                        <label for="otras_certificaciones" class="form-label">Otras Certificaciones (Máximo 10 puntos)</label>
                        <input type="number" class="form-control" id="otras_certificaciones" name="otras_certificaciones" max="10" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="idiomas" class="form-label">Idiomas (Máximo 10 puntos)</label>
                        <input type="number" class="form-control" id="idiomas" name="idiomas" max="10" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="puntaje_total" class="form-label">Puntaje Total Obtenido</label>
                        <input type="number" class="form-control" id="puntaje_total" name="puntaje_total" max="100" readonly>
                    </div>
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar Evaluación</button>
    </form>
</div>
@endsection
