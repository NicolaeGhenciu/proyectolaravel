<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerFormMantenimientoCliente extends Controller
{
    public function __invoke(Request $request)
    {
        return view('formMantenimientoCliente', $request);
    }
}
