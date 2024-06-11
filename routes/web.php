<?php

use App\Http\Controllers\inicioSesionController;
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
