<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\IdiomaController;
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
Route::post('/actualizar-lista-horas', [IndexController::class, 'actualizarHoras'])->name('actualizar_lista_horas');
Route::post('/total', [IndexController::class, 'total'])->name('total_reserva');
Route::post('/reservar', [IndexController::class, 'reservar'])->name('reservar');
Route::post('/finalizar', [IndexController::class, 'finalizar'])->name('finalizar');
Route::post('/confirmacion', [IndexController::class, 'confirmacion'])->name('confirmacion');
Route::get('/respuesta', [IndexController::class, 'respuesta'])->name('respuesta');
Route::get('/idioma/{idioma}', [IdiomaController::class, 'cambiar'])->name('cambiar_idioma');

Route::group(['prefix' => '/login'], function () {
    Route::get('/', function () {
        //dd(session()->all());
        return view('general.login');
    })->name('login');
});
