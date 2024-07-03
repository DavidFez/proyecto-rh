@extends('dashboard')

@section('contenido')
<div class="container">
    <h1 class="mb-4">Evaluación de Currículum Vitae - {{ ucwords(str_replace('_', ' ', $puesto->tituloPuesto)) }}</h1>
    <form action="{{ route('candidato.storeEvaluation') }}" method="POST">
        @csrf
        <input type="hidden" name="candidato_id" value="{{ $candidato->idCandidato }}">
        <input type="hidden" name="cargo" value="{{ $puesto->tituloPuesto }}">

        <!-- Datos del Postulante -->
        <div class="card mb-4">
            <div class="card-header">
                Datos del Postulante
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres del postulante</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $candidato->nombre }}" required readonly>
                </div>
                <div class="mb-3">
                    <label for="edad" class="form-label">Edad del postulante</label>
                    <input type="number" class="form-control" id="edad" name="edad" required>
                </div>
                <div class="mb-3">
                    <label for="expediente" class="form-label">Expediente del postulante No.</label>
                    <input type="text" class="form-control" id="expediente" name="expediente" value="{{ $candidato->expediente }}" required>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha de evaluación</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                </div>
                <div class="mb-3">
                    <label for="nombreEvaluador" class="form-label">Nombre del Evaluador</label>
                    <input type="text" class="form-control" id="nombreEvaluador" name="nombreEvaluador" required>
                </div>
                <div class="mb-3">
                    <label for="comentarios" class="form-label">Comentarios</label>
                    <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
                </div>
            </div>
        </div>
        
        <!-- Categorías de Evaluación -->
        <div id="evaluation-form">
            <!-- Form will be populated here based on the position selected -->
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar Evaluación</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var position = "{{ $puesto->tituloPuesto }}";
        var form = document.getElementById('evaluation-form');
        form.innerHTML = getEvaluationForm(position);
        document.querySelectorAll('.evaluacion').forEach(function(element) {
            element.addEventListener('input', calculateTotal);
        });
    });

    function getEvaluationForm(position) {
        switch (position) {
            case 'Mesero':
                return `
                    <div class="card mb-4">
                        <div class="card-header">
                            Formación Académica (Máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="educacion_secundaria_completa" class="form-label">Educación Secundaria Completa</label>
                                <input type="number" class="form-control evaluacion" id="educacion_secundaria_completa" name="educacion_secundaria_completa" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="cursos_atencion_cliente" class="form-label">Cursos de Atención al Cliente</label>
                                <input type="number" class="form-control evaluacion" id="cursos_atencion_cliente" name="cursos_atencion_cliente" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Experiencia Laboral (Máximo 40 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="experiencia_mesero" class="form-label">Experiencia como Mesero (8 puntos/año, máximo 5 años)</label>
                                <input type="number" class="form-control evaluacion" id="experiencia_mesero" name="experiencia_mesero" max="40" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Habilidades Técnicas (Máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="manejo_pos" class="form-label">Manejo de POS (Sistema de Punto de Venta)</label>
                                <input type="number" class="form-control evaluacion" id="manejo_pos" name="manejo_pos" max="5" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="higiene_seguridad" class="form-label">Conocimientos en Higiene y Seguridad Alimentaria</label>
                                <input type="number" class="form-control evaluacion" id="higiene_seguridad" name="higiene_seguridad" max="5" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="comunicacion" class="form-label">Habilidades de Comunicación</label>
                                <input type="number" class="form-control evaluacion" id="comunicacion" name="comunicacion" max="5" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="resolucion_problemas" class="form-label">Resolución de Problemas</label>
                                <input type="number" class="form-control evaluacion" id="resolucion_problemas" name="resolucion_problemas" max="5" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Idiomas (máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ingles_basico" class="form-label">Idioma Inglés Básico</label>
                                <input type="number" class="form-control evaluacion" id="ingles_basico" name="ingles_basico" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="otros_idiomas" class="form-label">Otros Idiomas (Francés, Alemán, etc.)</label>
                                <input type="number" class="form-control evaluacion" id="otros_idiomas" name="otros_idiomas" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Puntaje Total Obtenido
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="number" class="form-control" id="puntaje_total" name="puntaje_total" max="100" readonly>
                            </div>
                        </div>
                    </div>
                `;
            case 'Contador':
                return `
                    <div class="card mb-4">
                        <div class="card-header">
                            Formación Académica (Máximo 30 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="grado_universitario" class="form-label">Grado Universitario en Contabilidad o Finanzas</label>
                                <input type="number" class="form-control evaluacion" id="grado_universitario" name="grado_universitario" max="20" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="cursos_contabilidad" class="form-label">Cursos de Especialización en Contabilidad</label>
                                <input type="number" class="form-control evaluacion" id="cursos_contabilidad" name="cursos_contabilidad" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Experiencia Laboral (Máximo 30 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="experiencia_contador" class="form-label">Experiencia como Contador (6 puntos/año, máximo 5 años)</label>
                                <input type="number" class="form-control evaluacion" id="experiencia_contador" name="experiencia_contador" max="30" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Habilidades Técnicas (Máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="software_contable" class="form-label">Manejo de Software Contable (QuickBooks, SAP)</label>
                                <input type="number" class="form-control evaluacion" id="software_contable" name="software_contable" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="legislacion_fiscal" class="form-label">Conocimientos en Legislación Fiscal</label>
                                <input type="number" class="form-control evaluacion" id="legislacion_fiscal" name="legislacion_fiscal" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Certificaciones y/o Diplomas (Máximo 10 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="certificacion_cpa" class="form-label">Certificación CPA</label>
                                <input type="number" class="form-control evaluacion" id="certificacion_cpa" name="certificacion_cpa" max="5" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="actualizacion_fiscal" class="form-label">Cursos de Actualización Fiscal</label>
                                <input type="number" class="form-control evaluacion" id="actualizacion_fiscal" name="actualizacion_fiscal" max="5" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Idiomas (máximo 10 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ingles_tecnico" class="form-label">Idioma Inglés Técnico</label>
                                <input type="number" class="form-control evaluacion" id="ingles_tecnico" name="ingles_tecnico" max="5" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="otros_idiomas" class="form-label">Otros Idiomas (Francés, Alemán, etc.)</label>
                                <input type="number" class="form-control evaluacion" id="otros_idiomas" name="otros_idiomas" max="5" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Puntaje Total Obtenido
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="number" class="form-control" id="puntaje_total" name="puntaje_total" max="100" readonly>
                            </div>
                        </div>
                    </div>
                `;
            case 'Chef':
                return `
                    <div class="card mb-4">
                        <div class="card-header">
                            Formación Académica (Máximo 30 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="grado_universitario_gastronomia" class="form-label">Grado Universitario en Gastronomía</label>
                                <input type="number" class="form-control evaluacion" id="grado_universitario_gastronomia" name="grado_universitario_gastronomia" max="20" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="cursos_especializacion_cocina" class="form-label">Cursos de Especialización en Cocina</label>
                                <input type="number" class="form-control evaluacion" id="cursos_especializacion_cocina" name="cursos_especializacion_cocina" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Experiencia Laboral (Máximo 30 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="experiencia_chef" class="form-label">Experiencia como Chef (6 puntos/año, máximo 5 años)</label>
                                <input type="number" class="form-control evaluacion" id="experiencia_chef" name="experiencia_chef" max="30" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Habilidades Técnicas (Máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="cocina_internacional" class="form-label">Conocimientos en Cocina Internacional</label>
                                <input type="number" class="form-control evaluacion" id="cocina_internacional" name="cocina_internacional" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="higiene_seguridad" class="form-label">Conocimientos en Higiene y Seguridad Alimentaria</label>
                                <input type="number" class="form-control evaluacion" id="higiene_seguridad" name="higiene_seguridad" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Certificaciones y/o Diplomas (Máximo 10 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="certificaciones_culinarias" class="form-label">Certificaciones Culinarias</label>
                                <input type="number" class="form-control evaluacion" id="certificaciones_culinarias" name="certificaciones_culinarias" max="5" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="actualizacion_culinaria" class="form-label">Cursos de Actualización Culinaria</label>
                                <input type="number" class="form-control evaluacion" id="actualizacion_culinaria" name="actualizacion_culinaria" max="5" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Idiomas (máximo 10 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ingles_tecnico" class="form-label">Idioma Inglés Técnico</label>
                                <input type="number" class="form-control evaluacion" id="ingles_tecnico" name="ingles_tecnico" max="5" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="otros_idiomas" class="form-label">Otros Idiomas (Francés, Italiano, etc.)</label>
                                <input type="number" class="form-control evaluacion" id="otros_idiomas" name="otros_idiomas" max="5" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Puntaje Total Obtenido
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="number" class="form-control" id="puntaje_total" name="puntaje_total" max="100" readonly>
                            </div>
                        </div>
                    </div>
                `;
            case 'Auxiliar de cocina':
                return `
                    <div class="card mb-4">
                        <div class="card-header">
                            Formación Académica (Máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="educacion_secundaria_completa" class="form-label">Educación Secundaria Completa</label>
                                <input type="number" class="form-control evaluacion" id="educacion_secundaria_completa" name="educacion_secundaria_completa" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="cursos_basicos_cocina" class="form-label">Cursos Básicos de Cocina</label>
                                <input type="number" class="form-control evaluacion" id="cursos_basicos_cocina" name="cursos_basicos_cocina" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Experiencia Laboral (Máximo 40 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="experiencia_auxiliar" class="form-label">Experiencia como Auxiliar de Cocina (8 puntos/año, máximo 5 años)</label>
                                <input type="number" class="form-control evaluacion" id="experiencia_auxiliar" name="experiencia_auxiliar" max="40" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Habilidades Técnicas (Máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="preparacion_alimentos" class="form-label">Conocimientos en Preparación de Alimentos</label>
                                <input type="number" class="form-control evaluacion" id="preparacion_alimentos" name="preparacion_alimentos" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="higiene_seguridad" class="form-label">Conocimientos en Higiene y Seguridad Alimentaria</label>
                                <input type="number" class="form-control evaluacion" id="higiene_seguridad" name="higiene_seguridad" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Idiomas (máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ingles_basico" class="form-label">Idioma Inglés Básico</label>
                                <input type="number" class="form-control evaluacion" id="ingles_basico" name="ingles_basico" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="otros_idiomas" class="form-label">Otros Idiomas (Francés, Alemán, etc.)</label>
                                <input type="number" class="form-control evaluacion" id="otros_idiomas" name="otros_idiomas" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Puntaje Total Obtenido
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="number" class="form-control" id="puntaje_total" name="puntaje_total" max="100" readonly>
                            </div>
                        </div>
                    </div>
                `;
            case 'Cajero':
                return `
                    <div class="card mb-4">
                        <div class="card-header">
                            Formación Académica (Máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="educacion_secundaria_completa" class="form-label">Educación Secundaria Completa</label>
                                <input type="number" class="form-control evaluacion" id="educacion_secundaria_completa" name="educacion_secundaria_completa" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="cursos_atencion_cliente" class="form-label">Cursos de Atención al Cliente</label>
                                <input type="number" class="form-control evaluacion" id="cursos_atencion_cliente" name="cursos_atencion_cliente" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Experiencia Laboral (Máximo 40 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="experiencia_cajero" class="form-label">Experiencia como Cajero (8 puntos/año, máximo 5 años)</label>
                                <input type="number" class="form-control evaluacion" id="experiencia_cajero" name="experiencia_cajero" max="40" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Habilidades Técnicas (Máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="manejo_pos" class="form-label">Manejo de POS (Sistema de Punto de Venta)</label>
                                <input type="number" class="form-control evaluacion" id="manejo_pos" name="manejo_pos" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="habilidades_numericas" class="form-label">Habilidades Numéricas</label>
                                <input type="number" class="form-control evaluacion" id="habilidades_numericas" name="habilidades_numericas" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Idiomas (máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ingles_basico" class="form-label">Idioma Inglés Básico</label>
                                <input type="number" class="form-control evaluacion" id="ingles_basico" name="ingles_basico" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="otros_idiomas" class="form-label">Otros Idiomas (Francés, Alemán, etc.)</label>
                                <input type="number" class="form-control evaluacion" id="otros_idiomas" name="otros_idiomas" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Puntaje Total Obtenido
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="number" class="form-control" id="puntaje_total" name="puntaje_total" max="100" readonly>
                            </div>
                        </div>
                    </div>
                `;
            case 'Repartidor':
                return `
                    <div class="card mb-4">
                        <div class="card-header">
                            Formación Académica (Máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="educacion_secundaria_completa" class="form-label">Educación Secundaria Completa</label>
                                <input type="number" class="form-control evaluacion" id="educacion_secundaria_completa" name="educacion_secundaria_completa" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="cursos_conduccion_segura" class="form-label">Cursos de Conducción Segura</label>
                                <input type="number" class="form-control evaluacion" id="cursos_conduccion_segura" name="cursos_conduccion_segura" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Experiencia Laboral (Máximo 40 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="experiencia_repartidor" class="form-label">Experiencia como Repartidor (8 puntos/año, máximo 5 años)</label>
                                <input type="number" class="form-control evaluacion" id="experiencia_repartidor" name="experiencia_repartidor" max="40" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Habilidades Técnicas (Máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="conocimiento_rutas" class="form-label">Conocimiento de Rutas y Zonas de Entrega</label>
                                <input type="number" class="form-control evaluacion" id="conocimiento_rutas" name="conocimiento_rutas" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="habilidades_conduccion" class="form-label">Habilidades de Conducción Segura</label>
                                <input type="number" class="form-control evaluacion" id="habilidades_conduccion" name="habilidades_conduccion" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Idiomas (máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ingles_basico" class="form-label">Idioma Inglés Básico</label>
                                <input type="number" class="form-control evaluacion" id="ingles_basico" name="ingles_basico" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="otros_idiomas" class="form-label">Otros Idiomas (Francés, Alemán, etc.)</label>
                                <input type="number" class="form-control evaluacion" id="otros_idiomas" name="otros_idiomas" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Puntaje Total Obtenido
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="number" class="form-control" id="puntaje_total" name="puntaje_total" max="100" readonly>
                            </div>
                        </div>
                    </div>
                `;
            case 'Sub-gerente':
                return `
                    <div class="card mb-4">
                        <div class="card-header">
                            Formación Académica (Máximo 30 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="grado_universitario" class="form-label">Grado Universitario en Administración de Empresas o afines</label>
                                <input type="number" class="form-control evaluacion" id="grado_universitario" name="grado_universitario" max="20" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="cursos_gestion_restaurantes" class="form-label">Cursos de Especialización en Gestión de Restaurantes</label>
                                <input type="number" class="form-control evaluacion" id="cursos_gestion_restaurantes" name="cursos_gestion_restaurantes" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Experiencia Laboral (Máximo 40 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="experiencia_sub_gerente" class="form-label">Experiencia como Sub-Gerente (8 puntos/año, máximo 5 años)</label>
                                <input type="number" class="form-control evaluacion" id="experiencia_sub_gerente" name="experiencia_sub_gerente" max="40" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Habilidades Técnicas (Máximo 20 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="gestion_restaurantes" class="form-label">Conocimientos en Gestión de Restaurantes</label>
                                <input type="number" class="form-control evaluacion" id="gestion_restaurantes" name="gestion_restaurantes" max="10" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="liderazgo" class="form-label">Habilidades de Liderazgo</label>
                                <input type="number" class="form-control evaluacion" id="liderazgo" name="liderazgo" max="10" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Idiomas (máximo 10 puntos)
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ingles_tecnico" class="form-label">Idioma Inglés Técnico</label>
                                <input type="number" class="form-control evaluacion" id="ingles_tecnico" name="ingles_tecnico" max="5" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="otros_idiomas" class="form-label">Otros Idiomas (Francés, Alemán, etc.)</label>
                                <input type="number" class="form-control evaluacion" id="otros_idiomas" name="otros_idiomas" max="5" min="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            Puntaje Total Obtenido
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="number" class="form-control" id="puntaje_total" name="puntaje_total" max="100" readonly>
                            </div>
                        </div>
                    </div>
                `;
            default:
                return '';
        }
    }

    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.evaluacion').forEach(function(element) {
            total += parseInt(element.value) || 0;
        });
        document.getElementById('puntaje_total').value = total;
    }
</script>
@endsection
