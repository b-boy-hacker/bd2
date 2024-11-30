<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InscritoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inscrito', [InscritoController::class, 'inscrito']);
Route::get('/carrera', [InscritoController::class, 'carrera']);
Route::get('/facultad', [InscritoController::class, 'facultad']);

