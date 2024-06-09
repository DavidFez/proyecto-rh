<?php

use App\Http\Controllers\inicioSesionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VistasAdminController;

Route::get('/', function () {
    return view('Login/inicioSesion');
});

Route::post('/Admin-iniciar-sesion', [inicioSesionController::class, 'iniciarSesion'])->name('iniciarSesionAdmin');
Route::view('/Admin-index','index')->name('paginaPrincipal');


Route::get('gestion-reclutamiento', [VistasAdminController::class, 'verDescriptorPuestos'])->name('gestionReclutamiento');



