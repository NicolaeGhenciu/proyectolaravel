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

Route::get('/detallesTarea', [ControllerTareas::class, 'detallesTarea'])->name('detallesTarea');

Route::get('/mensajeBorrarTarea', [ControllerTareas::class, 'mensajeBorrar'])->name('mensajeBorrarTarea');

Route::get('/borrarTarea', [ControllerTareas::class, 'borrarTarea'])->name('borrarTarea');

// Route::get('/tareas/crear', 'TareasController@formularioInsertar')->name('tareas.crear');
// Route::post('/tareas', 'TareasController@validarInsertar')->name('tareas.store');
// Route::get('/tareas', 'TareasController@listar')->name('tareas.index');
// Route::get('/tareas/{tarea}', 'TareasController@detalles')->name('tareas.detalles');
// Route::get('/tareas/{tarea}/eliminar', 'TareasController@mensajeBorrar')->name('tareas.eliminar');
// Route::delete('/tareas/{tarea}', 'TareasController@borrar')->name('tareas.destroy');

// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Tarea;
// use App\Models\Provincia;
// use App\Models\Empleado;
// use App\Models\Cliente;

// class TareasController extends Controller
// {
//     public function formularioInsertar()
//     {
//         $provincias = Provincia::all();
//         $empleados = Empleado::all();
//         $clientes = Cliente::all();
//         return view('tareas.crear', compact('provincias', 'empleados', 'clientes'));
//     }

//     public function validarInsertar(Request $request)
//     {
//         $datos = $request->validate([
//             'cliente' => 'required',
//             'nombre_y_apellidos' => 'required|min:3|max:100|regex:/^[^,]*$/',
//             'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
//             'correo' => 'required|email',
//             'descripcion' => 'required',
//             'direccion' => 'required',
//             'poblacion' => 'required',
//             'codigo_postal' => ['required', 'regex:/^(0[1-9]|[1-4][0-9]|5[0-2])[0-9]{3}$/'],
//             'provincia' => 'required',
//             'estado' => 'required',
//             'operario_encargado' => 'required',
//             'fecha_realizacion' => 'required|after:now',
//         ]);

//         $datos['fecha_creacion'] = (new \DateTime())->format('Y-m-d');

//         Tarea::create($datos);

//         session()->flash('message', 'La tarea ha sido registrado correctamente.');

//         return redirect()->route


// 'route('tareas.index');
// }

// Copy code
// public function listar()
// {
//     $tareas = Tarea::orderBy('fecha_realizacion', 'desc')->paginate(10);
//     return view('tareas.index', compact('tareas'));
// }

// public function detalles(Tarea $tarea)
// {
//     return view('tareas.detalles', compact('tarea'));
// }

// public function mensajeBorrar(Tarea $tarea)
// {
//     return view('tareas.eliminar', compact('tarea'));
// }

// public function borrar(Tarea $tarea)
// {
//     $tarea->delete();
//     session()->flash('message', 'La tarea ha sido eliminada correctamente.');
//     return redirect()->route('tareas.index');
// }
