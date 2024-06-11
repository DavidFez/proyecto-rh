<?php

use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\inicioSesionController;
use App\Http\Controllers\PuestoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VistasAdminController;
use PhpParser\Node\Stmt\Return_;

Route::get('/', function () {
    return view('Login/inicioSesion');
});

Route::resource('puestos', PuestoController::class);





Route::post('/Admin-iniciar-sesion', [inicioSesionController::class, 'iniciarSesion'])->name('iniciarSesionAdmin');
Route::view('/Admin-index', 'VistasAdministrador/inicioAdmin')->name('index');
//Route::view('/Admin/descriptor', 'descriptorPuestoTrabajo/descriptorPuesto')->name('descriptorPuesto');
Route::get('Admin/descriptor', [PuestoController::class, 'index'])->name('descriptorPuesto');
Route::get('Admin/evaluacion', [EvaluacionController::class, 'index'])->name('evaluacionPuesto');

