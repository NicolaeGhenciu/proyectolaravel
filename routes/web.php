<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/','formRegEmpleado')->name('formRegEmpleado');

Route::get('/formRegEmpleado', 'App\Http\Controllers\ControllerFormRegEmpleado')->name('formRegEmpleado');
Route::post('formRegEmpleado', 'App\Http\Controllers\ControllerDatosFormRegEmpleado@enviar');

Route::get('/formRegCliente', 'App\Http\Controllers\ControllerFormRegCliente')->name('formRegCliente');
Route::post('formRegCliente', 'App\Http\Controllers\ControllerDatosFormRegCliente@enviar');

Route::get('/formMantenimientoCliente', 'App\Http\Controllers\ControllerFormMantenimientoCliente')->name('formMantenimientoCliente');
Route::post('formMantenimientoCliente', 'App\Http\Controllers\ControllerDatosFormMantenimientoCliente@enviar');

Route::get('/formTarea', 'App\Http\Controllers\ControllerTareas@formularioInsertar')->name('formTarea');
Route::post('formTarea', 'App\Http\Controllers\ControllerTareas@validarInsertar');

Route::get('/listaTareas', 'App\Http\Controllers\ControllerTareas@listar')->name('listaTareas');

Route::get('/mensajeBorrarTarea', 'App\Http\Controllers\ControllerTareas@mensajeBorrar')->name('mensajeBorrarTarea');

Route::get('/borrarTarea', 'App\Http\Controllers\ControllerTareas@borrarTarea')->name('borrarTarea');
