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

    public function ver()
    {
        $tareas = Tarea::paginate(10);
        return view('verTareas', compact('tareas'));
    }
}
