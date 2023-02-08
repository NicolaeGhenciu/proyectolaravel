<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerTareas;
use App\Http\Controllers\ControllerClientes;
use App\Http\Controllers\ControllerEmpleados;
use App\Http\Controllers\ControllerCuotas;
use App\Http\Controllers\SessionController;



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

Route::get('/siemprecolgados', function () {
    return view('siemprecolgados');
})->name('siemprecolgados');

//Empleado

Route::get('/formRegEmpleado', [ControllerEmpleados::class, 'formularioInsertar'])->name('formRegEmpleado');
Route::post('formRegEmpleado', [ControllerEmpleados::class, 'validarInsertar']);

Route::get('/listaEmpleados', [ControllerEmpleados::class, 'listar'])->name('listaEmpleados');

Route::get('/mensajeBorrarEmpleado/{empleado}', [ControllerEmpleados::class, 'mensajeBorrar'])->name('mensajeBorrarEmpleado');

Route::delete('/borrarEmpleado/{empleado}', [ControllerEmpleados::class, 'borrarEmpleado'])->name('borrarEmpleado');

Route::get('/forModEmpleado/{empleado}', [ControllerEmpleados::class, 'forModEmpleado'])->name('forModEmpleado');

Route::put('/modificarEmpleado/{empleado}', [ControllerEmpleados::class, 'modificarEmpleado'])->name('modificarEmpleado');

//Cliente

Route::get('/formRegCliente', [ControllerClientes::class, 'formularioInsertar'])->name('formRegCliente');
Route::post('formRegCliente', [ControllerClientes::class, 'validarInsertar']);

Route::get('/listaClientes', [ControllerClientes::class, 'listar'])->name('listaClientes');

Route::get('/mensajeBorrarCliente/{cliente}', [ControllerClientes::class, 'mensajeBorrar'])->name('mensajeBorrarCliente');

Route::delete('/borrarCliente/{cliente}', [ControllerClientes::class, 'borrarCliente'])->name('borrarCliente');

//Cuotas

Route::get('/formRemesaMensual', [ControllerCuotas::class, 'formularioRemesa'])->name('formRemesaMensual');

Route::post('formRemesaMensual', [ControllerCuotas::class, 'validarInsertarRemesa']);

Route::get('/formularioCuota', [ControllerCuotas::class, 'formularioCuota'])->name('formularioCuota');

Route::post('formularioCuota', [ControllerCuotas::class, 'validarCuotaExcepcional']);

Route::get('/listaCuotas/{filtro}', [ControllerCuotas::class, 'listar'])->name('listaCuotas');

Route::get('/forModCuota/{cuota}', [ControllerCuotas::class, 'forModCuota'])->name('forModCuota');

Route::put('/modificarCuota/{cuota}', [ControllerCuotas::class, 'modificarCuota'])->name('modificarCuota');

Route::get('/mensajeBorrarCuota/{cuota}', [ControllerCuotas::class, 'mensajeBorrar'])->name('mensajeBorrarCuota');

Route::delete('/borrarCuota/{cuota}', [ControllerCuotas::class, 'borrarCuota'])->name('borrarCuota');

//Tareas

Route::get('/formTarea', [ControllerTareas::class, 'formularioInsertar'])->name('formTarea');
Route::post('formTarea', [ControllerTareas::class, 'validarInsertar']);

//Route::get('/listaTareas', [ControllerTareas::class, 'listar'])->name('listaTareas');
Route::middleware(['auth'])->group(function () {
    Route::get('/listaTareas', [ControllerTareas::class, 'listar'])->name('listaTareas');
});

// Route::middleware(['auth'])->group(function () {
    
// });

Route::get('/detallesTarea/{tarea}', [ControllerTareas::class, 'detallesTarea'])->name('detallesTarea');

Route::get('/mensajeBorrarTarea/{tarea}', [ControllerTareas::class, 'mensajeBorrar'])->name('mensajeBorrarTarea');

Route::delete('/borrarTarea/{tarea}', [ControllerTareas::class, 'borrarTarea'])->name('borrarTarea');

Route::get('/forModTarea/{tarea}', [ControllerTareas::class, 'forModTarea'])->name('forModTarea');

Route::put('/modificarTarea/{tarea}', [ControllerTareas::class, 'modificarTarea'])->name('modificarTarea');

//Login

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [SessionController::class, 'login'])->name('session.login');

Route::post('logout', [SessionController::class, 'logout'])->name('logout');

//Route::post('logout', 'SessionController@logout')->name('logout');
