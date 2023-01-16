<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use App\Models\Empleado;
use Illuminate\Http\Request;

class ControllerFormTarea extends Controller
{
    public function __invoke(Request $request)
    {
        $provincias = Provincia::all();
        $empleados = Empleado::all();
        return view('formTarea', compact('provincias', 'empleados'));
    }
}
