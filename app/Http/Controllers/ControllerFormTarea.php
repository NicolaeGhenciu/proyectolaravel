<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use App\Models\Empleado;
use App\Models\Cliente;
use App\Models\Tarea;
use Illuminate\Http\Request;

class ControllerFormTarea extends Controller
{
    public function __invoke(Request $request)
    {
        $provincias = Provincia::all();
        $empleados = Empleado::all();
        $clientes = Cliente::all();
        return view('formTarea', compact('provincias', 'empleados', 'clientes'));
    }

    public function listar()
    {
        $tareas = Tarea::orderBy('fecha_realizacion', 'desc')->paginate(10);
        return view('listaTareas', compact('tareas'));
    }

    public function mensajeBorrar(Request $request)
    {
        $tarea = Tarea::find($request->id);
        return view('mensajeBorrarTarea', compact('tarea'));
    }

    public function borrarTarea(Request $request)
    {
        Tarea::find($request->id)->delete();
        $tareas = Tarea::orderBy('fecha_realizacion', 'desc')->paginate(10);
        session()->flash('message', 'La tarea ha sido borrada correctamente.');
        return redirect()->route('listarTareas');
    }
}
