<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerFormRegEmpleado extends Controller
{
    public function __invoke(Request $request)
    {
        return view('formRegEmpleado', $request);
    }
}
