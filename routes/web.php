<?php

use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\departamentoController;
use App\Http\Controllers\descripcionPuestoController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\inicioSesionController;
use App\Http\Controllers\perfilPuestoController;
use App\Http\Controllers\PruebaSeleccionController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\SeguimientoCandidatoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VistasAdminController;

Route::get('/', function () {
    return view('Login/inicioSesion');
});

Route::post('/Admin-iniciar-sesion', [inicioSesionController::class, 'iniciarSesion'])->name('iniciarSesionAdmin');
Route::post('/Admin-cerrar-sesion', [inicioSesionController::class, 'cerrarSesion'])->name('cerrarSesionAdmin');
Route::view('/Admin-index', 'VistasAdministrador/inicioAdmin')->name('index');

Route::get('/Admin-gestion-de-cargos', [VistasAdminController::class, 'gestionsDeCargos'])->name('verGestionCargos');
Route::view('/Admin-crear-cargo', 'Nominas/crearCargo')->name('nominaCrearCargo');
Route::post('/Admin-guardar-cargo', [VistasAdminController::class, 'crearCargo'])->name('nominaGuardarCargo');
Route::get('/Admin-gestion-de-empleados', [VistasAdminController::class, 'gestionDeEmpleados'])->name('nominaGestionEmpleados');
Route::get('/Admin-crear-empleado', [VistasAdminController::class, 'vistaAgregarEmpleado'])->name('nominaAgregarEmpleado');
Route::post('/Admin-guardar-empleado', [VistasAdminController::class, 'guardarEmpleado'])->name('nominaGuardarEmpleado');
Route::get('/Admin-datos-{id}-del-empleado', [VistasAdminController::class, 'verDatosDelEmpleado'])->name('nominaVerDatosEmpleado');
Route::get('/Admin-prestacione-de-ley', [VistasAdminController::class, 'gestionPrestaciones'])->name('nominaGestionPrestaciones');
Route::get('/Admin-bonificaciones.empleados', [VistasAdminController::class, 'gestionBonificaciones'])->name('nominaBonificaciones');

Route::get('/Admin-gestion-asistencia', [VistasAdminController::class, 'gestionAsistencias'])->name('nominaGestionAsistencia');
Route::get('/Admin-gestion-marcar-asistencia/{id}', [VistasAdminController::class, 'guardarAsistencia'])->name('nominaMarcarAsistencia');

Route::get('Admin/evaluacion', [EvaluacionController::class, 'index'])->name('evaluacionPuesto');


//RUTAS DE DESCRIPTOR DE PUESTOS.
Route::get('descripciones', [DescripcionPuestoController::class, 'index'])->name('descripciones.index');
Route::get('descripciones/create', [DescripcionPuestoController::class, 'create'])->name('descripciones.create');
Route::post('descripciones', [DescripcionPuestoController::class, 'store'])->name('descripciones.store');
Route::get('descripciones/{descripcion}', [DescripcionPuestoController::class, 'show'])->name('descripciones.show');
Route::get('descripciones/{descripcion}/edit', [DescripcionPuestoController::class, 'edit'])->name('descripciones.edit');
Route::put('descripciones/{descripcion}', [DescripcionPuestoController::class, 'update'])->name('descripciones.update');
Route::delete('descripciones/{descripcion}', [DescripcionPuestoController::class, 'destroy'])->name('descripciones.destroy');

//RUTAS DE PERFIL DE PUESTO
// Rutas de Perfil de Puestos
Route::get('perfiles', [PerfilPuestoController::class, 'index'])->name('perfiles.index');
Route::get('perfiles/create', [PerfilPuestoController::class, 'create'])->name('perfiles.create');
Route::post('perfiles', [PerfilPuestoController::class, 'store'])->name('perfiles.store');
Route::get('perfiles/{perfil}', [PerfilPuestoController::class, 'show'])->name('perfiles.show');
Route::get('perfiles/{perfil}/edit', [PerfilPuestoController::class, 'edit'])->name('perfiles.edit');
Route::put('perfiles/{perfil}', [PerfilPuestoController::class, 'update'])->name('perfiles.update');
Route::delete('perfiles/{perfil}', [PerfilPuestoController::class, 'destroy'])->name('perfiles.destroy');

//RUTAS DE PROCESO DE RECLUTAMIENTO
Route::get('candidatos', [CandidatoController::class, 'index'])->name('candidatos.index');
Route::get('candidatos/create', [CandidatoController::class, 'create'])->name('candidatos.create');
Route::post('candidatos', [CandidatoController::class, 'store'])->name('candidatos.store');
Route::get('candidatos/{candidato}', [CandidatoController::class, 'show'])->name('candidatos.show');
Route::get('candidatos/{candidato}/edit', [CandidatoController::class, 'edit'])->name('candidatos.edit');
Route::put('candidatos/{candidato}', [CandidatoController::class, 'update'])->name('candidatos.update');
Route::delete('candidatos/{candidato}', [CandidatoController::class, 'destroy'])->name('candidatos.destroy');


// Rutas de evaluación
Route::get('candidatos/evaluacion/{candidato}', [CandidatoController::class, 'evaluarCV'])->name('candidatos.evaluarCV');
Route::post('/candidatos/storeEvaluation', [CandidatoController::class, 'storeEvaluation'])->name('candidato.storeEvaluation');

//RUTAS DE SEGUIMIENTO DEL CANDIDATO
Route::get('seguimiento_candidatos', [SeguimientoCandidatoController::class, 'index'])->name('seguimiento_candidatos.index');
Route::get('seguimiento_candidatos/create', [SeguimientoCandidatoController::class, 'create'])->name('seguimiento_candidatos.create');
Route::post('seguimiento_candidatos', [SeguimientoCandidatoController::class, 'store'])->name('seguimiento_candidatos.store');
Route::get('seguimiento_candidatos/{candidato}', [SeguimientoCandidatoController::class, 'show'])->name('seguimiento_candidatos.show');
Route::get('seguimiento_candidatos/{candidato}/edit', [SeguimientoCandidatoController::class, 'edit'])->name('seguimiento_candidatos.edit');
Route::put('seguimiento_candidatos/{candidato}', [SeguimientoCandidatoController::class, 'update'])->name('seguimiento_candidatos.update');
Route::delete('seguimiento_candidatos/{candidato}', [SeguimientoCandidatoController::class, 'destroy'])->name('seguimiento_candidatos.destroy');

//RUTAS PARA PRUBEAS DE SELECCION DEL CAPITAL HUMANO
Route::get('pruebas', [PruebaSeleccionController::class, 'index'])->name('pruebas.index');
Route::get('pruebas/create', [PruebaSeleccionController::class, 'create'])->name('pruebas.create');
Route::post('pruebas', [PruebaSeleccionController::class, 'store'])->name('pruebas.store');
Route::get('pruebas/{prueba}', [PruebaSeleccionController::class, 'show'])->name('pruebas.show');
Route::get('pruebas/{prueba}/edit', [PruebaSeleccionController::class, 'edit'])->name('pruebas.edit');
Route::put('pruebas/{prueba}', [PruebaSeleccionController::class, 'update'])->name('pruebas.update');
Route::delete('pruebas/{prueba}', [PruebaSeleccionController::class, 'destroy'])->name('pruebas.destroy');

// RUTAS PARA EXPEDIENTES DEL CAPITAL HUMANO
Route::get('expedientes', [ExpedienteController::class, 'index'])->name('expedientes.index');
Route::get('expedientes/create', [ExpedienteController::class, 'create'])->name('expedientes.create');
Route::post('expedientes', [ExpedienteController::class, 'store'])->name('expedientes.store');
Route::get('expedientes/{expediente}', [ExpedienteController::class, 'show'])->name('expedientes.show');
Route::get('expedientes/{expediente}/edit', [ExpedienteController::class, 'edit'])->name('expedientes.edit');
Route::put('expedientes/{expediente}', [ExpedienteController::class, 'update'])->name('expedientes.update');
Route::delete('expedientes/{expediente}', [ExpedienteController::class, 'destroy'])->name('expedientes.destroy');

//RUTAS PARA LA CREACIONN DE PDF'S
Route::get('descripciones/{descripcion}/pdf', [DescripcionPuestoController::class, 'generarPDF'])->name('descripciones.generarPDF');
Route::get('perfiles/{perfil}/pdf', [PerfilPuestoController::class, 'generarPDF'])->name('perfiles.generarPDF');