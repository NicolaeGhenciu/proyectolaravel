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

//-- Aqui no dejamos acceder a no ser que este logueado.

Route::middleware(['auth'])->group(function () {

    //Menu principal, noticas, etc

    Route::get('/siemprecolgados', function () {
        return view('siemprecolgados');
    })->name('siemprecolgados');

    //---Empleado

    //Insertar un empleado

    Route::get('/formRegEmpleado', [ControllerEmpleados::class, 'formularioInsertar'])->name('formRegEmpleado');
    Route::post('formRegEmpleado', [ControllerEmpleados::class, 'validarInsertar']);

    //Listar un empleado

    Route::middleware(['administrador'])->group(function () {
        Route::get('/listaEmpleados', [ControllerEmpleados::class, 'listar'])->name('listaEmpleados');
    });

    //Borrar un empleado

    Route::get('/mensajeBorrarEmpleado/{empleado}', [ControllerEmpleados::class, 'mensajeBorrar'])->name('mensajeBorrarEmpleado');
    Route::delete('/borrarEmpleado/{empleado}', [ControllerEmpleados::class, 'borrarEmpleado'])->name('borrarEmpleado');

    //Modificar un empleado

    Route::get('/forModEmpleado/{empleado}', [ControllerEmpleados::class, 'forModEmpleado'])->name('forModEmpleado');
    Route::put('/modificarEmpleado/{empleado}', [ControllerEmpleados::class, 'modificarEmpleado'])->name('modificarEmpleado');

    //---Cliente

    // Insertar un cliente
    Route::get('/formRegCliente', [ControllerClientes::class, 'formularioInsertar'])->name('formRegCliente');
    Route::post('formRegCliente', [ControllerClientes::class, 'validarInsertar']);

    // Listar un cliente
    Route::get('/listaClientes', [ControllerClientes::class, 'listar'])->name('listaClientes');

    // Borrar un cliente
    Route::get('/mensajeBorrarCliente/{cliente}', [ControllerClientes::class, 'mensajeBorrar'])->name('mensajeBorrarCliente');
    Route::delete('/borrarCliente/{cliente}', [ControllerClientes::class, 'borrarCliente'])->name('borrarCliente');

    //---Cuotas

    //Insertar Remesa Mensual
    Route::get('/formRemesaMensual', [ControllerCuotas::class, 'formularioRemesa'])->name('formRemesaMensual');
    Route::post('formRemesaMensual', [ControllerCuotas::class, 'validarInsertarRemesa']);

    //Insertar Cuota Excepcional
    Route::get('/formularioCuota', [ControllerCuotas::class, 'formularioCuota'])->name('formularioCuota');
    Route::post('formularioCuota', [ControllerCuotas::class, 'validarCuotaExcepcional']);

    //Lista Cuota + filtro
    Route::get('/listaCuotas/{filtro}', [ControllerCuotas::class, 'listar'])->name('listaCuotas');

    //Modificar cuota
    Route::get('/forModCuota/{cuota}', [ControllerCuotas::class, 'forModCuota'])->name('forModCuota');
    Route::put('/modificarCuota/{cuota}', [ControllerCuotas::class, 'modificarCuota'])->name('modificarCuota');

    //Borrar cuota
    Route::get('/mensajeBorrarCuota/{cuota}', [ControllerCuotas::class, 'mensajeBorrar'])->name('mensajeBorrarCuota');
    Route::delete('/borrarCuota/{cuota}', [ControllerCuotas::class, 'borrarCuota'])->name('borrarCuota');

    //--Tareas

    //Insertar una tarea
    Route::get('/formTarea', [ControllerTareas::class, 'formularioInsertar'])->name('formTarea');
    Route::post('formTarea', [ControllerTareas::class, 'validarInsertar']);

    //Listar Tareas
    Route::get('/listaTareas', [ControllerTareas::class, 'listar'])->name('listaTareas');

    //Ver detalles de una Tarea
    Route::get('/detallesTarea/{tarea}', [ControllerTareas::class, 'detallesTarea'])->name('detallesTarea');

    //Borrar Tarea
    Route::get('/mensajeBorrarTarea/{tarea}', [ControllerTareas::class, 'mensajeBorrar'])->name('mensajeBorrarTarea');
    Route::delete('/borrarTarea/{tarea}', [ControllerTareas::class, 'borrarTarea'])->name('borrarTarea');

    //Modificar una tarea
    Route::get('/forModTarea/{tarea}', [ControllerTareas::class, 'forModTarea'])->name('forModTarea');
    Route::put('/modificarTarea/{tarea}', [ControllerTareas::class, 'modificarTarea'])->name('modificarTarea');

    //Completar una tarea
    //Route::get('/formCompletarTarea/{tarea}', [ControllerTareas::class, 'formCompletarTarea'])->name('formCompletarTarea');
    Route::get('/formCompletarTarea/{tarea}', [ControllerTareas::class, 'formCompletarTarea'])->middleware('verificarEmpleadoTarea')->name('formCompletarTarea');
    Route::put('/validarCompletarTarea/{tarea}', [ControllerTareas::class, 'validarCompletarTarea'])->name('validarCompletarTarea');
});

//---Login

//Me lleva al login
Route::get('/', function () {
    return view('login');
})->name('login');

//Controlador del login
Route::post('/login', [SessionController::class, 'login'])->name('session.login');

//Desloguearse
Route::post('logout', [SessionController::class, 'logout'])->name('logout');
