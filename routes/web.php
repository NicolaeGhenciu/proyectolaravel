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