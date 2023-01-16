<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerDatosFormTarea extends Controller
{
    public function enviar()
    {
        request()->validate([

        ]);
        return view('formTarea');
    }
}
