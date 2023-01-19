<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rules\DniRule;

use App\Models\Empleado;

class ControllerEmpleados extends Controller
{
    public function formularioInsertar(Request $request)
    {
        return view('formRegEmpleado', $request);
    }

    public function validarInsertar()
    {
        $datos = request()->validate([
            'nif' => ['required', new DniRule],
            'nombre_y_apellidos' => 'required|min:3|max:100|regex:/^[^,]*$/',
            'clave' => 'required|min:6|max:15|regex:/^[^,]*$/',
            'fecha_alta' => 'required',
            'correo' => 'required|email',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'direccion' => 'required|min:6|max:100',
            'es_admin' => 'required',
        ]);

        Empleado::create($datos);

        session()->flash('message', 'El empleado ha sido registrado correctamente.');

        return redirect()->route('formRegEmpleado');
    }
}
