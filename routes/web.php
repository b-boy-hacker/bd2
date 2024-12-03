<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InscritoController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\FacultadController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\ModalidadController;

Route::get('/', function () {
    return view('welcome');
});

//LOCALIDAD
Route::get('/local_ins', [LocalidadController::class, 'local_ins']);

//CARRERA
Route::get('/carrera_ins', [CarreraController::class, 'carrera_ins']);
Route::get('/ppac', [CarreraController::class, 'ppac']);

//FACULTAD
Route::get('/facultad_ins', [FacultadController::class, 'facultad_ins']);
Route::get('/facultad_titulados', [FacultadController::class, 'facultad_titulados']);
Route::get('/facultad_egresados', [FacultadController::class, 'facultad_egresados']);
Route::get('/facultad_desertados', [FacultadController::class, 'facultad_desertados']);
Route::get('/facultad_rendimiento', [FacultadController::class, 'facultad_rendimiento']);
Route::get('/facultad_ppac', [FacultadController::class, 'facultad_ppac']);


//MODALIDAD
Route::get('/modalidad_ins', [ModalidadController::class, 'modalidad_ins']);


Route::get('/inscrito', [InscritoController::class, 'inscrito']);
Route::get('/carrera', [InscritoController::class, 'carrera']);
Route::get('/facultad', [InscritoController::class, 'facultad']);

Route::get('/excel', [InscritoController::class, 'excel']);
Route::post('/importar', [InscritoController::class, 'importar'])->name('importar');

Route::get('/poblar', [InscritoController::class, 'poblar']);
Route::post('/cargarExcel', [InscritoController::class, 'cargarExcel'])->name('cargarExcel');

