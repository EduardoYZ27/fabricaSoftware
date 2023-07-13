<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\Proyectos_ofertadosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/area', AreaController::class);

Route::resource('/coordinador', CoordinadorController::class);

Route::resource('/proyectos_ofertados', Proyectos_ofertadosController::class);