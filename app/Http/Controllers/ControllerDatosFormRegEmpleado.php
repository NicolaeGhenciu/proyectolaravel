<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rules\DniRule;

class ControllerDatosFormRegEmpleado extends Controller
{
    public function enviar()
    {
        request()->validate([
            'nif' => ['required', new DniRule],
            'nombre' => 'required|min:3|max:100',
            'correo' => 'required|email',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'direccion' => 'required',
            'es_admin' => 'required|in:admin,operario',
        ]);
        return view('formRegEmpleado');
    }
}
