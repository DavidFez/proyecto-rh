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

Route::get('/evaluaciones', function () {
    return view('EvaluacionPersonal.EvaluacionIndex');
});

Route::get('/evaluaciones/create', function () {
    return view('EvaluacionPersonal.create');
})->name('evaluaciones.create');

Route::post('/evaluaciones/store', function () {
    // Aquí puedes manejar la lógica para almacenar los datos del formulario
    return redirect()->route('evaluaciones.index')->with('success', 'Evaluación guardada exitosamente.');
})->name('evaluaciones.store');

Route::resource('puestos', PuestoController::class);





Route::post('/Admin-iniciar-sesion', [inicioSesionController::class, 'iniciarSesion'])->name('iniciarSesionAdmin');
Route::view('/Admin-index', 'VistasAdministrador/inicioAdmin')->name('index');
//Route::view('/Admin/descriptor', 'descriptorPuestoTrabajo/descriptorPuesto')->name('descriptorPuesto');
Route::get('Admin/descriptor', [PuestoController::class, 'index'])->name('descriptorPuesto');
Route::get('Admin/evaluacion', [EvaluacionController::class, 'index'])->name('evaluacionPuesto');

Route::get('/evaluaciones', [EvaluacionController::class, 'index'])->name('evaluaciones.index');
Route::get('/evaluaciones/create', [EvaluacionController::class, 'create'])->name('evaluaciones.create');
Route::post('/evaluaciones/store', [EvaluacionController::class, 'store'])->name('evaluaciones.store');

Route::delete('/evaluaciones/{id}', [EvaluacionController::class, 'destroy'])->name('evaluaciones.destroy');
