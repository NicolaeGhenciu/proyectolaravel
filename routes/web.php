<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerTareas;
use App\Http\Controllers\ControllerClientes;
use App\Http\Controllers\ControllerEmpleados;


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

//Empleado

Route::get('/formRegEmpleado', [ControllerEmpleados::class, 'formularioInsertar'])->name('formRegEmpleado');
Route::post('formRegEmpleado', [ControllerEmpleados::class, 'validarInsertar']);

//Cliente

Route::get('/formRegCliente', [ControllerClientes::class, 'formularioInsertar'])->name('formRegCliente');
Route::post('formRegCliente', [ControllerClientes::class, 'validarInsertar']);

Route::get('/formMantenimientoCliente', 'App\Http\Controllers\ControllerFormMantenimientoCliente')->name('formMantenimientoCliente');
Route::post('formMantenimientoCliente', 'App\Http\Controllers\ControllerDatosFormMantenimientoCliente@enviar');

//Tareas

Route::get('/formTarea', [ControllerTareas::class, 'formularioInsertar'])->name('formTarea');
Route::post('formTarea', [ControllerTareas::class, 'validarInsertar']);

Route::get('/listaTareas', [ControllerTareas::class, 'listar'])->name('listaTareas');

Route::get('/detallesTarea/{tarea}', [ControllerTareas::class, 'detallesTarea'])->name('detallesTarea');

Route::get('/mensajeBorrarTarea/{tarea}', [ControllerTareas::class, 'mensajeBorrar'])->name('mensajeBorrarTarea');

Route::delete('/borrarTarea/{tarea}', [ControllerTareas::class, 'borrarTarea'])->name('borrarTarea');
