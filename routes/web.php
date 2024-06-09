<?php

use App\Http\Controllers\inicioSesionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VistasAdminController;
use PhpParser\Node\Stmt\Return_;

Route::get('/', function () {
    return view('Login/inicioSesion');
});

Route::post('/Admin-iniciar-sesion', [inicioSesionController::class, 'iniciarSesion'])->name('iniciarSesionAdmin');
Route::view('/Admin-index', 'VistasAdministrador/inicioAdmin')->name('index');



