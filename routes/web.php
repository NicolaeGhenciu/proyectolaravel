<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerTareas;
use App\Http\Controllers\ControllerClientes;
use App\Http\Controllers\ControllerEmpleados;
use App\Http\Controllers\ControllerCuotas;


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

Route::get('/listaEmpleados', [ControllerEmpleados::class, 'listar'])->name('listaEmpleados');

Route::get('/mensajeBorrarEmpleado/{empleado}', [ControllerEmpleados::class, 'mensajeBorrar'])->name('mensajeBorrarEmpleado');

Route::delete('/borrarEmpleado/{empleado}', [ControllerEmpleados::class, 'borrarEmpleado'])->name('borrarEmpleado');

//Cliente

Route::get('/formRegCliente', [ControllerClientes::class, 'formularioInsertar'])->name('formRegCliente');
Route::post('formRegCliente', [ControllerClientes::class, 'validarInsertar']);

Route::get('/listaClientes', [ControllerClientes::class, 'listar'])->name('listaClientes');

Route::get('/mensajeBorrarCliente/{cliente}', [ControllerClientes::class, 'mensajeBorrar'])->name('mensajeBorrarCliente');

Route::delete('/borrarCliente/{cliente}', [ControllerClientes::class, 'borrarCliente'])->name('borrarCliente');

//Cuotas

Route::get('/formCuota', [ControllerCuotas::class, 'formularioInsertar'])->name('formCuota');
Route::post('formCuota', [ControllerCuotas::class, 'validarInsertar']);

Route::get('/listaCuotas', [ControllerCuotas::class, 'listar'])->name('listaCuotas');

//Tareas

Route::get('/formTarea', [ControllerTareas::class, 'formularioInsertar'])->name('formTarea');
Route::post('formTarea', [ControllerTareas::class, 'validarInsertar']);

Route::get('/listaTareas', [ControllerTareas::class, 'listar'])->name('listaTareas');

Route::get('/detallesTarea/{tarea}', [ControllerTareas::class, 'detallesTarea'])->name('detallesTarea');

Route::get('/mensajeBorrarTarea/{tarea}', [ControllerTareas::class, 'mensajeBorrar'])->name('mensajeBorrarTarea');

Route::delete('/borrarTarea/{tarea}', [ControllerTareas::class, 'borrarTarea'])->name('borrarTarea');

Route::get('/forModTarea/{tarea}', [ControllerTareas::class, 'forModTarea'])->name('forModTarea');

Route::put('/modificarTarea/{tarea}', [ControllerTareas::class, 'modificarTarea'])->name('modificarTarea');
