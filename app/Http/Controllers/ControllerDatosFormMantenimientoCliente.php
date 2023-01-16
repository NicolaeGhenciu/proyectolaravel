<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerDatosFormMantenimientoCliente extends Controller
{
    public function enviar()
    {
        request()->validate([
            'concepto' => 'required',
            'importe' => 'required',
            'pagada' => 'required',
            'fechaDePago' => 'required',
            'notas' => 'required',
        ]);
        return view('formMantenimientoCliente');
    }
}
