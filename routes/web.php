<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerTareas;
use App\Http\Controllers\ControllerClientes;
use App\Http\Controllers\ControllerEmpleados;
use App\Http\Controllers\ControllerCuotas;
use App\Http\Controllers\ControllerMail;
use App\Http\Controllers\ControllerTareasOperario;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SessionController;

use Laravel\Socialite\Facades\Socialite;
//use App\Mail\SiempreColgadosMail;

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

    Route::middleware(['administrador'])->group(function () {
        //Insertar un empleado
        Route::get('/formRegEmpleado', [ControllerEmpleados::class, 'formularioInsertar'])->name('formRegEmpleado');
        Route::post('formRegEmpleado', [ControllerEmpleados::class, 'validarInsertar']);

        //Listar un empleado
        Route::get('/listaEmpleados', [ControllerEmpleados::class, 'listar'])->name('listaEmpleados');

        //Borrar un empleado
        Route::get('/mensajeBorrarEmpleado/{empleado}', [ControllerEmpleados::class, 'mensajeBorrar'])->name('mensajeBorrarEmpleado');
        Route::delete('/borrarEmpleado/{empleado}', [ControllerEmpleados::class, 'borrarEmpleado'])->name('borrarEmpleado');

        //Modificar un empleado
        Route::get('/forModEmpleado/{empleado}', [ControllerEmpleados::class, 'forModEmpleado'])->name('forModEmpleado');
        Route::put('/modificarEmpleado/{empleado}', [ControllerEmpleados::class, 'modificarEmpleado'])->name('modificarEmpleado');
    });

    //Ver algunos detalles de mi cuenta y modificarlos.
    Route::get('/miCuenta/{empleado}', [ControllerEmpleados::class, 'verMiCuenta'])->middleware('verificarEmpleadoCuenta')->name('miCuenta');
    Route::put('/modificarMiCuenta/{empleado}', [ControllerEmpleados::class, 'modificarMiCuenta'])->name('modificarMiCuenta');

    //---Cliente

    Route::middleware(['administrador'])->group(function () {
        // Insertar un cliente
        Route::get('/formRegCliente', [ControllerClientes::class, 'formularioInsertar'])->name('formRegCliente');
        Route::post('formRegCliente', [ControllerClientes::class, 'validarInsertar']);

        // Listar un cliente
        Route::get('/listaClientes', [ControllerClientes::class, 'listar'])->name('listaClientes');

        // Borrar un cliente
        Route::get('/mensajeBorrarCliente/{cliente}', [ControllerClientes::class, 'mensajeBorrar'])->name('mensajeBorrarCliente');
        Route::delete('/borrarCliente/{cliente}', [ControllerClientes::class, 'borrarCliente'])->name('borrarCliente');
    });

    //---Cuotas

    Route::middleware(['administrador'])->group(function () {
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

        //Generar Factura Cuota
        Route::get('/generatePDF/{cuota}', [ControllerCuotas::class, 'generarFacturaPdf'])->name('generatePDF');

        //Enviar factura de cuota por correo
        Route::get('/enviarCuotaCorreo/{cuota}', [ControllerMail::class, 'enviarCuota'])->name('enviarCuotaCorreo');
    });

    //--Tareas

    Route::middleware(['administrador'])->group(function () {
        //Insertar una tarea
        Route::get('/formTarea', [ControllerTareas::class, 'formularioInsertar'])->name('formTarea');
        Route::post('formTarea', [ControllerTareas::class, 'validarInsertar']);

        //Listar Tareas
        Route::get('/listaTareas', [ControllerTareas::class, 'listar'])->name('listaTareas');

        //Ver detalles de una Tarea siendo administrador
        Route::get('/detallesTarea/{tarea}', [ControllerTareas::class, 'detallesTarea'])->name('detallesTarea');

        //Borrar Tarea
        Route::get('/mensajeBorrarTarea/{tarea}', [ControllerTareas::class, 'mensajeBorrar'])->name('mensajeBorrarTarea');
        Route::delete('/borrarTarea/{tarea}', [ControllerTareas::class, 'borrarTarea'])->name('borrarTarea');

        //Modificar una tarea
        Route::get('/forModTarea/{tarea}', [ControllerTareas::class, 'forModTarea'])->name('forModTarea');
        Route::put('/modificarTarea/{tarea}', [ControllerTareas::class, 'modificarTarea'])->name('modificarTarea');
    });

    Route::middleware(['operario'])->group(function () {
        //Ver detalles de una Tarea siendo operario
        Route::get('/detallesTareaOperario/{tarea}', [ControllerTareasOperario::class, 'detallesTarea'])->middleware('verificarEmpleadoTarea')->name('detallesTareaOperario');

        //Listar Tareas
        Route::get('/listaTareasOperario', [ControllerTareasOperario::class, 'listar'])->name('listaTareasOperario');

        //Completar una tarea
        Route::get('/formCompletarTarea/{tarea}', [ControllerTareasOperario::class, 'formCompletarTarea'])->middleware('verificarEmpleadoTarea')->name('formCompletarTarea');
        Route::put('/validarCompletarTarea/{tarea}', [ControllerTareasOperario::class, 'validarCompletarTarea'])->name('validarCompletarTarea');
    });
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

//--- Cliente sin cuenta

//Insertar una tarea como Cliente
Route::get('/formTareaParaClientes', [ControllerTareas::class, 'formTareaParaClientes'])->name('formTareaParaClientes');
Route::post('formTareaParaClientes', [ControllerTareas::class, 'validarformTareaParaCliente']);

//Enviar correo para recuperar contraseña
Route::get('/formRecuperarPass', [ControllerMail::class, 'formRecuperarPass'])->name('formRecuperarPass');
Route::post('formRecuperarPass', [ControllerMail::class, 'validarRecuperarContraseña']);

//Inicio de sesion con Google
Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('google');
Route::get('/googlecallback', [GoogleController::class, 'handleGoogleCallback'])->name('googlecallback');

//Inicio de sesion con Github
Route::get('/github', [GitHubController::class, 'redirectToProvider'])->name('github');
Route::get('/githubcallback', [GitHubController::class, 'handleProviderCallback'])->name('githubcallback');
