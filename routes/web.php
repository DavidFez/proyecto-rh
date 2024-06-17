<?php

use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\inicioSesionController;
use App\Http\Controllers\PuestoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VistasAdminController;

Route::get('/', function () {
    return view('Login/inicioSesion');
});

Route::resource('puestos', PuestoController::class);



Route::post('/Admin-iniciar-sesion', [inicioSesionController::class, 'iniciarSesion'])->name('iniciarSesionAdmin');
Route::post('/Admin-cerrar-sesion', [inicioSesionController::class, 'cerrarSesion'])->name('cerrarSesionAdmin');
Route::view('/Admin-index', 'VistasAdministrador/inicioAdmin')->name('index');



Route::get('/Admin-gestion-de-cargos', [VistasAdminController::class, 'gestionsDeCargos'])->name('verGestionCargos');
Route::view('/Admin-crear-cargo', 'Nominas/crearCargo')->name('nominaCrearCargo');
Route::post('/Admin-guardar-cargo', [VistasAdminController::class, 'crearCargo'])->name('nominaGuardarCargo');
Route::get('/Admin-datos-{id}-cargo', [VistasAdminController::class, 'verDatosCargo'])->name('datosCargo');
Route::get('/Admin-edit-{id}-cargo', [VistasAdminController::class, 'editarCargoVista'])->name('vistaEditCargo');
Route::post('/Admin-edit-datos-{id}-cargo', [VistasAdminController::class, 'editarCargo'])->name('guardarEditCargo');

Route::get('/Admin-gestion-de-empleados', [VistasAdminController::class, 'gestionDeEmpleados'])->name('nominaGestionEmpleados');
Route::get('/Admin-crear-empleado', [VistasAdminController::class, 'vistaAgregarEmpleado'])->name('nominaAgregarEmpleado');
Route::post('/Admin-guardar-empleado', [VistasAdminController::class, 'guardarEmpleado'])->name('nominaGuardarEmpleado');
Route::get('/Admin-datos-{id}-del-empleado', [VistasAdminController::class, 'verDatosDelEmpleado'])->name('nominaVerDatosEmpleado');

Route::get('/Admin-prestacione-de-ley', [VistasAdminController::class, 'gestionPrestaciones'])->name('nominaGestionPrestaciones');
Route::post('/Admin-edit-prestacio-ley-{id}', [VistasAdminController::class, 'editarPrestacion'])->name('editarPrestacionDeLey');

Route::get('/Admin-bonificaciones.empleados', [VistasAdminController::class, 'gestionBonificaciones'])->name('nominaBonificaciones');
Route::post('/Admin-bonificaciones-grardar', [VistasAdminController::class, 'guardarBonificacion'])->name('nominaBonificacionGuardar');
Route::post('/Admin-bonificaciones-otorgadas', [VistasAdminController::class, 'mostrarBinificaciones'])->name('nominaBonificacionesOtorgadas');

Route::get('/Admin-gestion-de-nomina', [VistasAdminController::class, 'gestionNomina'])->name('gestionNomina');
Route::post('/Admin-ver-tabla-nomina', [VistasAdminController::class, 'ingresarEmpleadoNomina'])->name('verTablaNomina');

Route::get('/Admin-boleta-{id}-de-pago', [VistasAdminController::class, 'generarBoletaPago'])->name('verBoletaPago');

Route::get('/Admin-gestion-de-horas-extras', [VistasAdminController::class, 'vistaRegistroHorasExtra'])->name('vistaGestionHorasExtras');
Route::post('/Admin-gestion-registro-horas-extras', [VistasAdminController::class, 'registrarHorasExtra'])->name('registroHorasExtra');

Route::get('/Admin-gestion-de-asuetos', [VistasAdminController::class, 'gestionAsuetos'])->name('asuetosGestion');
Route::post('/Admin-registrar-asueto', [VistasAdminController::class, 'registrarAsueto'])->name('asuetoRegistrar');


Route::get('/Admin-gestion-asistencia', [VistasAdminController::class, 'gestionAsistencias'])->name('nominaGestionAsistencia');
Route::get('/Admin-gestion-marcar-asistencia/{id}', [VistasAdminController::class, 'guardarAsistencia'])->name('nominaMarcarAsistencia');

Route::get('/Admin-gestion-de-descansos', [VistasAdminController::class, 'gestionDescanso'])->name('nominaGestionDescanso');
Route::get('/Admin-guardar-descanso/{id}', [VistasAdminController::class, 'marcarDescanso'])->name('nominaGuardarDescanso');

Route::post('/Admin-total-dias-laborados', [VistasAdminController::class, 'toalDiasLaborados'])->name('nominaTotalDiasLaborados');

Route::get('/Admin-gestion-incapacidades', [VistasAdminController::class, 'gestionIncacapacidades'])->name('nominaGestionIncapacidades');
Route::post('/Admin-registrar-incacapacidades', [VistasAdminController::class, 'resgitrarIncapacidad'])->name('registrarIncacapacidades');

Route::get('/Admin-gestion-asencias-sin-justificar', [VistasAdminController::class, 'gestionAsenciasInjus'])->name('gestionAsenciasSinJustificar');
Route::post('/Admin-registrar-ausencias-injustificadas', [VistasAdminController::class, 'resgitrarAsenciasInjus'])->name('ausenciasSinInjustificar');

Route::get('/Admin-gestion-asencias-justificadas', [VistasAdminController::class, 'gestionAsenciasJus'])->name('ausenciasJustificadas');
Route::post('/Admin-registrar-ausencias-justificada', [VistasAdminController::class, 'resgitrarAsenciasJus'])->name('guardarAsenciasJustificadas');

Route::get('Admin-gestion-vacaciones', [VistasAdminController::class, 'gestionVaciones'])->name('gestionVacaciones');
Route::get('Admin-asignar-vaciones-trabajador', [VistasAdminController::class, 'vistaRegistrarVacaciones'])->name('vistaRegistrarVacaciones');
Route::post('/Admin-registrar-vacaciones', [VistasAdminController::class, 'registrarVacaciones'])->name('guardarVacaciones');
Route::get('Admin-detalle-{id}-de-vacaciones', [VistasAdminController::class, 'verDetalleVacacion'])->name('verDetalleDeVacacion');



Route::get('Admin/descriptor', [PuestoController::class, 'index'])->name('descriptorPuesto');
Route::get('Admin/evaluacion', [EvaluacionController::class, 'index'])->name('evaluacionPuesto');