<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rules\CifRules;

use App\Models\Cliente;
use Symfony\Component\Console\Input\Input;

class ControllerDatosFormRegCliente extends Controller
{

    public function enviar()
    {

        $validatedData = request()->validate([
            'cif' => ['required', new CifRules],
            'nombre_y_apellidos' => 'required|min:3|max:100|regex:/^[^,]*$/',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'correo' => 'required|email',
            'cuenta_corriente' => 'required|regex:/^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/',
            'importe_cuota_mensual' => 'required|regex:/^[0-9]+(\.[0-9]+)?$/',
            'pais' => 'required',
            'moneda' => 'required',
        ]);

        Cliente::create($validatedData);

        session()->flash('message', 'El cliente ha sido registrado correctamente.');

        return redirect()->route('formRegCliente');
    }
}
