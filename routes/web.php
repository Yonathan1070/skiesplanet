<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\AdministracionController;
use App\Http\Controllers\PlanesController;
use App\Http\Controllers\TitularesController;
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
        return view('general.login');
    })->name('login');
});

Route::group(['prefix' => '/administrador', 'middleware' => ['auth']], function () {
    Route::get('/', [AdministracionController::class, 'index'])->name('administracion');
    Route::get('/titulares', [AdministracionController::class, 'titulares'])->name('titulares');
    //Planes
    Route::group(['prefix' => '/planes'], function () {
        Route::get('/', [PlanesController::class, 'index'])->name('planes');
        Route::get('page', [PlanesController::class, 'page'])->name('page_planes');
        Route::post('/crear', [PlanesController::class, 'crear'])->name('crear_plan');
        Route::put('/{id}/editar', [PlanesController::class, 'editar'])->name('editar_plan');
        Route::post('', [PlanesController::class, 'guardar'])->name('guardar_plan');
        Route::put('/{id}', [PlanesController::class, 'actualizar'])->name('actualizar_plan');
        Route::delete('/{id}/eliminar', [PlanesController::class, 'eliminar'])->name('eliminar_plan');
    });

    //Titulares
    Route::group(['prefix' => '/titulares'], function () {
        Route::get('/', [TitularesController::class, 'index'])->name('titulares');
        Route::get('page', [TitularesController::class, 'page'])->name('page_titulares');
        Route::post('/crear', [TitularesController::class, 'crear'])->name('crear_titular');
        Route::put('/{id}/editar', [TitularesController::class, 'editar'])->name('editar_titular');
        Route::post('', [TitularesController::class, 'guardar'])->name('guardar_titular');
        Route::put('/{id}', [TitularesController::class, 'actualizar'])->name('actualizar_titular');
        Route::delete('/{id}/eliminar', [TitularesController::class, 'eliminar'])->name('eliminar_titular');
    });
});
