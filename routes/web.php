<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('inicio');
Route::post('/get-paises', [IndexController::class, 'getPaises'])->name('get_paises');
Route::post('/get-ciudades', [IndexController::class, 'getCiudades'])->name('get_ciudades');
Route::post('/seleccionar-reserva', [IndexController::class, 'seleccionarReserva'])->name('seleccionar_reserva');
Route::post('/agregar-hora', [IndexController::class, 'agregarHora'])->name('agregar_hora');
