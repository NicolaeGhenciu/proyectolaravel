<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rules\CifRules;

class ControllerDatosFormRegCliente extends Controller
{

    public function enviar()
    {
        request()->validate([
            'cif' => ['required', new CifRules],
            'nombre' => 'required|min:3|max:100',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'correo' => 'required|email',
            'cuentaCorriente' => 'required|regex:/^ES\d{2}\s\d{4}\s\d{4}\s\d{2}\s\d{10}$/',
            'importeCuotaMensual' => 'required',
            'paises' => 'required',
            'monedas' => 'required',
        ]);
        return view('formRegCliente');
    }
}
