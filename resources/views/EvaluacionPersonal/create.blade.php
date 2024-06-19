@extends('dashboard')

@section('contenido')
<div class="container mt-4">
    <h3 class="mb-4">Crear Evaluación del Personal</h3>

    <ul class="nav nav-tabs" id="evaluationTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="form-tab" data-bs-toggle="tab" href="#form" role="tab" aria-controls="form" aria-selected="false">Realizar Evaluación</a>
        </li>
    </ul>
    
        <div class="tab-pane fade" id="form" role="tabpanel" aria-labelledby="form-tab">
            <form id="crearEvaluacionForm" action="{{ url('/evaluaciones/store') }}" method="POST" onsubmit="calcularNota(event)">
                @csrf
                <div class="mb-3">
                    <label for="idEmpleado" class="form-label">Nombre del Empleado</label>
                    <select class="form-control" id="idEmpleado" name="idEmpleado" required>
                    @foreach($empleados as $empleado)
                    <option value="{{ $empleado->idEmpleado }}">{{ $empleado->nombres }}  {{ $empleado->apellidos }}</option>
                    @endforeach
                    </select>
        </div>
                <div class="form-group mb-3">
                    <label for="rol">Puesto:</label>
                    <select id="rol" name="rol" class="form-select" onchange="mostrarCriterios(this.value)">
                        <option value="">Seleccionar Puesto:</option>
                        <option value="chef">Chef</option>
                        <option value="mesero">Mesero</option>
                        <option value="cajero">Cajero</option>
                        <option value="repartidor">Repartidor</option>
                        <option value="auxiliar_de_cocina">Auxiliar de Cocina</option>
                        <option value="subgerente">Subgerente</option>
                    <!-- Añade más roles según sea necesario -->
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="departamento">Departamento:</label>
                    <input type="text" name="departamento" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="fecha_evaluacion">Fecha de Evaluación:</label>
                    <input type="date" name="fecha_evaluacion" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="evaluador">Evaluador:</label>
                    <input type="text" name="evaluador" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="nota_calculada">Porcentaje Calculado (%):</label>
                    <input type="number" class="form-control" id="nota_calculada" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="nota">Nota (%):</label>
                    <input type="number" name="nota" class="form-control" id="nota" step="1" required>
                </div>
                <div class="form-group mb-3">
                    <label for="observaciones">Observaciones:</label>
                    <textarea name="observaciones" class="form-control"></textarea>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#evaluacionModal">Realizar Evaluación</button>
                <button type="submit" class="btn btn-primary">Guardar Evaluación</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="evaluacionModal" tabindex="-1" aria-labelledby="evaluacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="evaluacionModalLabel">Evaluación del Personal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí se cargan los criterios según el rol seleccionado -->

                <!-- Criterios para Chef -->
                <div id="criterios-chef" class="criterios" style="display:none;">
                    <h5 class="mb-3">Criterios para Chef</h5>
                    <div class="form-group mb-3">
                        <label for="habilidades_culinarias">Habilidades culinarias</label>
                        <p>Descripción: Nivel de habilidad en la preparación de alimentos, incluyendo técnicas de cocina y presentación.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[habilidades_culinarias]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="conocimiento_menus_recetas">Conocimiento de menús y recetas</label>
                        <p>Descripción: Familiaridad con el menú del restaurante y la capacidad para seguir y adaptar recetas.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[conocimiento_menus_recetas]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="seguridad_higiene">Seguridad e higiene alimentaria</label>
                        <p>Descripción: Adherencia a las normas de seguridad e higiene en la cocina.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[seguridad_higiene]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Servicio y Calidad</h5>
                    <div class="form-group mb-3">
                        <label for="calidad_platos">Calidad de los platos</label>
                        <p>Descripción: Consistencia y calidad de los platos servidos.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[calidad_platos]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tiempo_preparacion">Tiempo de preparación</label>
                        <p>Descripción: Eficiencia en la preparación y entrega de los platos.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[tiempo_preparacion]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="creatividad_innovacion">Creatividad e innovación</label>
                        <p>Descripción: Capacidad para innovar y crear nuevos platos y presentaciones.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[creatividad_innovacion]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Habilidades Interpersonales</h5>
                    <div class="form-group mb-3">
                        <label for="trabajo_equipo">Trabajo en equipo</label>
                        <p>Descripción: Capacidad para colaborar y trabajar bien con el personal de cocina y otros departamentos.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[trabajo_equipo]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="liderazgo">Liderazgo</label>
                        <p>Descripción: Habilidad para liderar y dirigir al equipo de cocina.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[liderazgo]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="comunicacion">Comunicación</label>
                        <p>Descripción: Habilidad para comunicarse claramente con el personal de cocina y el personal de servicio.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[comunicacion]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Rendimiento y Productividad</h5>
                    <div class="form-group mb-3">
                        <label for="cumplimiento_metas_servicio">Cumplimiento de metas de servicio</label>
                        <p>Descripción: Capacidad para cumplir con los objetivos y estándares de servicio del restaurante.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[cumplimiento_metas_servicio]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="manejo_inventarios">Manejo de inventarios</label>
                        <p>Descripción: Eficiencia en la gestión de inventarios y control de costos.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[manejo_inventarios]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="puntualidad_asistencia">Puntualidad y asistencia</label>
                        <p>Descripción: Puntualidad en el trabajo y fiabilidad en su asistencia.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[puntualidad_asistencia]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                </div>

                <!-- Criterios para Mesero -->
                <div id="criterios-mesero" class="criterios" style="display:none;">
                    <h5 class="mb-3">Criterios para Mesero</h5>
                    <div class="form-group mb-3">
                        <label for="conocimiento_menu">Conocimiento del menú</label>
                        <p>Descripción: Familiaridad con el menú, ingredientes, y recomendaciones para los clientes.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[conocimiento_menu]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="toma_pedidos">Toma de pedidos</label>
                        <p>Descripción: Precisión y eficiencia en la toma de pedidos y transmisión a la cocina.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[toma_pedidos]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="manejo_pos">Manejo de POS (Punto de Venta)</label>
                        <p>Descripción: Habilidad para utilizar el sistema de punto de venta para registrar pedidos y procesar pagos.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[manejo_pos]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Servicio al Cliente</h5>
                    <div class="form-group mb-3">
                        <label for="atencion_cliente">Atención al cliente</label>
                        <p>Descripción: Capacidad para proporcionar un servicio amable, atento y personalizado a los clientes.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[atencion_cliente]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="manejo_quejas">Manejo de quejas y problemas</label>
                        <p>Descripción: Capacidad para resolver quejas y problemas de los clientes de manera eficaz.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[manejo_quejas]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="rapidez_eficiencia_servicio">Rapidez y eficiencia del servicio</label>
                        <p>Descripción: Capacidad para atender a los clientes de manera rápida y eficiente.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[rapidez_eficiencia_servicio]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Habilidades Interpersonales</h5>
                    <div class="form-group mb-3">
                        <label for="comunicacion">Comunicación</label>
                        <p>Descripción: Habilidad para comunicarse claramente con clientes y compañeros de trabajo.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[comunicacion]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="trabajo_equipo">Trabajo en equipo</label>
                        <p>Descripción: Capacidad para colaborar y trabajar bien con otros miembros del equipo.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[trabajo_equipo]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="actitud_comportamiento">Actitud y comportamiento</label>
                        <p>Descripción: Mantiene una actitud positiva, es amable y respetuoso en todo momento.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[actitud_comportamiento]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Rendimiento y Productividad</h5>
                    <div class="form-group mb-3">
                        <label for="cumplimiento_tareas_diarias">Cumplimiento de tareas diarias</label>
                        <p>Descripción: Capacidad para cumplir con todas las tareas asignadas durante el turno.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[cumplimiento_tareas_diarias]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gestion_tiempo">Gestión del tiempo</label>
                        <p>Descripción: Eficiencia en la gestión del tiempo para atender múltiples mesas y tareas.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[gestion_tiempo]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="puntualidad_asistencia">Puntualidad y asistencia</label>
                        <p>Descripción: Puntualidad en el trabajo y fiabilidad en su asistencia.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[puntualidad_asistencia]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                </div>

                <!-- Criterios para Cajero -->
                <div id="criterios-cajero" class="criterios" style="display:none;">
                    <h5 class="mb-3">Criterios para Cajero</h5>
                    <div class="form-group mb-3">
                        <label for="manejo_caja">Manejo de caja y operaciones</label>
                        <p>Descripción: Eficiencia y precisión en el manejo de la caja registradora, incluyendo transacciones en efectivo, tarjeta, y otros métodos de pago.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[manejo_caja]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="conocimiento_productos">Conocimiento de productos y promociones</label>
                        <p>Descripción: Familiaridad con los productos que se venden, promociones actuales y capacidad para informar a los clientes sobre ellos.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[conocimiento_productos]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="cumplimiento_procedimientos">Cumplimiento de procedimientos</label>
                        <p>Descripción: Adherencia a los procedimientos de seguridad, manejo de efectivo, y políticas de la tienda.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[cumplimiento_procedimientos]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Servicio al Cliente</h5>
                    <div class="form-group mb-3">
                        <label for="atencion_cliente">Atención al cliente</label>
                        <p>Descripción: Habilidad para proporcionar un servicio amable, eficiente y satisfactorio a los clientes.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[atencion_cliente]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="resolucion_problemas_quejas">Resolución de problemas y quejas</label>
                        <p>Descripción: Capacidad para manejar quejas y resolver problemas de los clientes de manera efectiva.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[resolucion_problemas_quejas]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="rapidez_servicio">Rapidez en el servicio</label>
                        <p>Descripción: Capacidad para atender a los clientes rápidamente, minimizando el tiempo de espera.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[rapidez_servicio]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Habilidades Interpersonales</h5>
                    <div class="form-group mb-3">
                        <label for="comunicacion">Comunicación</label>
                        <p>Descripción: Habilidad para comunicarse claramente con clientes y compañeros de trabajo.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[comunicacion]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="trabajo_equipo">Trabajo en equipo</label>
                        <p>Descripción: Capacidad para colaborar y trabajar bien con otros miembros del equipo.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[trabajo_equipo]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="actitud_comportamiento">Actitud y comportamiento</label>
                        <p>Descripción: Mantiene una actitud positiva, es amable y respetuoso en todo momento.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[actitud_comportamiento]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Rendimiento y Productividad</h5>
                    <div class="form-group mb-3">
                        <label for="precision_manejo_dinero">Precisión en el manejo del dinero</label>
                        <p>Descripción: Habilidad para realizar transacciones precisas y evitar errores en el manejo del dinero.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[precision_manejo_dinero]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="cumplimiento_metas_venta">Cumplimiento de metas de venta</label>
                        <p>Descripción: Capacidad para cumplir con las metas de ventas establecidas por la tienda.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[cumplimiento_metas_venta]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="puntualidad_asistencia">Puntualidad y asistencia</label>
                        <p>Descripción: Puntualidad en el trabajo y fiabilidad en su asistencia.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[puntualidad_asistencia]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                </div>

                <!-- Criterios para Repartidor -->
                <div id="criterios-repartidor" class="criterios" style="display:none;">
                    <h5 class="mb-3">Criterios para Repartidor</h5>
                    <div class="form-group mb-3">
                        <label for="conocimiento_rutas">Conocimiento de rutas</label>
                        <p>Descripción: Familiaridad con las rutas de entrega y capacidad para encontrar direcciones eficientemente.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[conocimiento_rutas]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="uso_tecnologia">Uso de tecnología</label>
                        <p>Descripción: Capacidad para utilizar dispositivos GPS y aplicaciones móviles para gestionar entregas.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[uso_tecnologia]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="mantenimiento_vehiculo">Mantenimiento del vehículo</label>
                        <p>Descripción: Adherencia a los procedimientos de mantenimiento y cuidado del vehículo de reparto.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[mantenimiento_vehiculo]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Servicio al Cliente</h5>
                    <div class="form-group mb-3">
                        <label for="puntualidad_entregas">Puntualidad en las entregas</label>
                        <p>Descripción: Capacidad para realizar entregas puntuales según los horarios establecidos.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[puntualidad_entregas]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="interaccion_clientes">Interacción con clientes</label>
                        <p>Descripción: Habilidad para interactuar de manera amable y profesional con los clientes durante las entregas.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[interaccion_clientes]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="manejo_problemas">Manejo de problemas y quejas</label>
                        <p>Descripción: Capacidad para manejar problemas y quejas de los clientes de manera efectiva.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[manejo_problemas]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Habilidades Interpersonales</h5>
                    <div class="form-group mb-3">
                        <label for="comunicacion">Comunicación</label>
                        <p>Descripción: Habilidad para comunicarse claramente con clientes y el equipo de logística.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[comunicacion]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="trabajo_equipo">Trabajo en equipo</label>
                        <p>Descripción: Capacidad para colaborar y trabajar bien con otros miembros del equipo de reparto.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[trabajo_equipo]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="actitud_comportamiento">Actitud y comportamiento</label>
                        <p>Descripción: Mantiene una actitud positiva, es amable y respetuoso en todo momento.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[actitud_comportamiento]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>4. Rendimiento y Productividad</h5>
                    <div class="form-group mb-3">
                        <label for="numero_entregas">Número de entregas completadas</label>
                        <p>Descripción: Cantidad de entregas realizadas en el tiempo asignado.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[numero_entregas]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="precision_entregas">Precisión en las entregas</label>
                        <p>Descripción: Exactitud en la entrega de los pedidos correctos a los clientes correctos.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[precision_entregas]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="puntualidad_asistencia">Puntualidad y asistencia</label>
                        <p>Descripción: Puntualidad en el trabajo y fiabilidad en su asistencia.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[puntualidad_asistencia]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                </div>

                <!-- Criterios para Auxiliar de Cocina -->
                <div id="criterios-auxiliar_de_cocina" class="criterios" style="display:none;">
                    <h5 class="mb-3">Evaluación de Personal: Auxiliar de Cocina</h5>
                    <div class="form-group mb-3">
                        <label for="preparacion_ingredientes">Preparación de ingredientes</label>
                        <p>Descripción: Habilidad para lavar, cortar, y preparar ingredientes según las instrucciones.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[preparacion_ingredientes]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="conocimiento_procedimientos_cocina">Conocimiento de procedimientos de cocina</label>
                        <p>Descripción: Familiaridad con los procedimientos estándar de la cocina y capacidad para seguir instrucciones.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[conocimiento_procedimientos_cocina]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="manejo_utensilios_equipos">Manejo de utensilios y equipos de cocina</label>
                        <p>Descripción: Habilidad para utilizar de manera segura y eficiente los utensilios y equipos de cocina.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[manejo_utensilios_equipos]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Servicio y Calidad</h5>
                    <div class="form-group mb-3">
                        <label for="calidad_preparacion_alimentos">Calidad en la preparación de alimentos</label>
                        <p>Descripción: Capacidad para preparar alimentos de acuerdo con los estándares de calidad del restaurante.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[calidad_preparacion_alimentos]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="cumplimiento_normas_higiene">Cumplimiento de normas de higiene</label>
                        <p>Descripción: Adherencia a las normas de higiene y seguridad alimentaria.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[cumplimiento_normas_higiene]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="eficiencia_limpieza_organizacion">Eficiencia en la limpieza y organización</label>
                        <p>Descripción: Capacidad para mantener la cocina limpia y organizada durante y después del turno.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[eficiencia_limpieza_organizacion]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Habilidades Interpersonales</h5>
                    <div class="form-group mb-3">
                        <label for="comunicacion">Comunicación</label>
                        <p>Descripción: Habilidad para comunicarse claramente con el equipo de cocina y otros miembros del personal.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[comunicacion]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="trabajo_equipo">Trabajo en equipo</label>
                        <p>Descripción: Capacidad para colaborar y trabajar bien con otros miembros del equipo.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[trabajo_equipo]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="actitud_comportamiento">Actitud y comportamiento</label>
                        <p>Descripción: Mantiene una actitud positiva, es amable y respetuoso en todo momento.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[actitud_comportamiento]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Rendimiento y Productividad</h5>
                    <div class="form-group mb-3">
                        <label for="cumplimiento_tareas_diarias">Cumplimiento de tareas diarias</label>
                        <p>Descripción: Capacidad para cumplir con todas las tareas asignadas durante el turno.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[cumplimiento_tareas_diarias]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gestion_tiempo">Gestión del tiempo</label>
                        <p>Descripción: Eficiencia en la gestión del tiempo para completar tareas de manera oportuna.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[gestion_tiempo]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="puntualidad_asistencia">Puntualidad y asistencia</label>
                        <p>Descripción: Puntualidad en el trabajo y fiabilidad en su asistencia.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[puntualidad_asistencia]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                </div>

                <!-- Criterios para Subgerente -->
                <div id="criterios-subgerente" class="criterios" style="display:none;">
                    <h5 class="mb-3">Evaluación de Personal: Subgerente</h5>
                    <div class="form-group mb-3">
                        <label for="conocimiento_negocio">Conocimiento del negocio</label>
                        <p>Descripción: Entendimiento profundo de las operaciones y procesos del negocio.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[conocimiento_negocio]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gestion_operaciones">Gestión de operaciones</label>
                        <p>Descripción: Habilidad para supervisar y gestionar las operaciones diarias de manera eficiente.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[gestion_operaciones]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="manejo_herramientas_software">Manejo de herramientas y software de gestión</label>
                        <p>Descripción: Capacidad para utilizar herramientas y software de gestión empresarial de manera efectiva.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[manejo_herramientas_software]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Liderazgo y Gestión de Personal</h5>
                    <div class="form-group mb-3">
                        <label for="liderazgo">Liderazgo</label>
                        <p>Descripción: Capacidad para liderar y motivar al equipo, proporcionando dirección y apoyo.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[liderazgo]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="desarrollo_personal">Desarrollo de personal</label>
                        <p>Descripción: Habilidad para identificar y desarrollar el talento dentro del equipo.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[desarrollo_personal]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="resolucion_conflictos">Resolución de conflictos</label>
                        <p>Descripción: Capacidad para manejar y resolver conflictos de manera eficaz y justa.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[resolucion_conflictos]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Servicio y Satisfacción del Cliente</h5>
                    <div class="form-group mb-3">
                        <label for="enfoque_cliente">Enfoque en el cliente</label>
                        <p>Descripción: Compromiso con la satisfacción del cliente y la mejora continua del servicio.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[enfoque_cliente]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="manejo_quejas_problemas">Manejo de quejas y problemas</label>
                        <p>Descripción: Eficiencia en la resolución de quejas y problemas de los clientes.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[manejo_quejas_problemas]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="calidad_servicio">Calidad del servicio</label>
                        <p>Descripción: Capacidad para mantener y mejorar los estándares de calidad del servicio.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[calidad_servicio]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Habilidades Interpersonales</h5>
                    <div class="form-group mb-3">
                        <label for="comunicacion">Comunicación</label>
                        <p>Descripción: Habilidad para comunicarse claramente con el equipo, superiores y clientes.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[comunicacion]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="trabajo_equipo">Trabajo en equipo</label>
                        <p>Descripción: Capacidad para colaborar y trabajar bien con otros miembros del equipo y departamentos.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[trabajo_equipo]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="actitud_comportamiento">Actitud y comportamiento</label>
                        <p>Descripción: Mantiene una actitud positiva, es amable y respetuoso en todo momento.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[actitud_comportamiento]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>

                    <h5>Rendimiento y Productividad</h5>
                    <div class="form-group mb-3">
                        <label for="cumplimiento_metas_objetivos">Cumplimiento de metas y objetivos</label>
                        <p>Descripción: Capacidad para alcanzar las metas y objetivos establecidos para el puesto.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[cumplimiento_metas_objetivos]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="gestion_tiempo">Gestión del tiempo</label>
                        <p>Descripción: Eficiencia en la gestión del tiempo y la priorización de tareas.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[gestion_tiempo]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="puntualidad_asistencia">Puntualidad y asistencia</label>
                        <p>Descripción: Puntualidad en el trabajo y fiabilidad en su asistencia.</p>
                        <label>Escala (1-5):</label>
                        <select name="criterios[puntualidad_asistencia]" class="form-select">
                            <option value="1">1 - Muy Pobre</option>
                            <option value="2">2 - Pobre</option>
                            <option value="3">3 - Promedio</option>
                            <option value="4">4 - Bueno</option>
                            <option value="5">5 - Excelente</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="guardarYCalcularNota()">Guardar Evaluación</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        mostrarCriterios(); // Inicializa los criterios correctos al cargar la página
        $('#rol').change(function() {
            mostrarCriterios(this.value);
        });
    });

    function mostrarCriterios(rol) {
        var criterios = $('.criterios');
        criterios.hide();
        if (rol) {
            $('#criterios-' + rol).show();
        }
    }

    function calcularNota() {
        var selects = $('#evaluacionModal .criterios:visible select');
        var total = 0;
        var numCriterios = selects.length;

        // Sumamos los puntos seleccionados por el usuario
        selects.each(function() {
            if (this.value) {
                total += parseInt(this.value);
            }
        });

        // Convertimos el total a porcentaje basado en un máximo de 60 puntos
        var porcentaje = (total / (numCriterios * 5)) * 100;

        console.log('Total de puntos seleccionados:', total);
        console.log('Número de criterios:', numCriterios);
        console.log('Porcentaje calculado:', porcentaje);

        // Redondeamos el porcentaje al número entero más cercano
        var porcentajeRedondeado = Math.round(porcentaje);

        // Asignamos el porcentaje calculado al campo nota
        $('#nota_calculada').val(porcentajeRedondeado);

        console.log('Porcentaje redondeado:', porcentajeRedondeado);
    }

    function guardarYCalcularNota() {
        // Calcula la nota y la asigna al campo antes de cerrar el modal
        calcularNota();

        // Verifica si el valor se estableció correctamente
        console.log('Valor en nota:', $('#nota_calculada').val());

        // Cierra el modal después de guardar
        $('#evaluacionModal').modal('hide');
    }

    function guardarNota(event) {
        // Calcula la nota y asegura que el valor se mantiene en el campo nota antes de enviar el formulario
        calcularNota();
        var nota = $('#nota_calculada').val();
        if (!nota) {
            alert('Por favor, realiza la evaluación antes de guardar.');
            event.preventDefault(); // Evita el envío del formulario
            return false;
        }
        return true; // Permite el envío del formulario
    }

    $('#crearEvaluacionForm').submit(function(event) {
        // Verifica si el valor de nota está correcto antes de enviar el formulario
        var nota = $('#nota_calculada').val();
        if (!nota) {
            alert('Por favor, realiza la evaluación antes de guardar.');
            event.preventDefault(); // Evita el envío del formulario
        }
    });

    $('#evaluacionModal').on('hidden.bs.modal', function() {
        // Recalcula la nota y asegura que el valor se mantiene en el campo nota
        calcularNota();
    });
</script>

@endsection
