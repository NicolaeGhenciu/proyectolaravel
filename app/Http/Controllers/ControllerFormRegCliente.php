<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;

class ControllerFormRegCliente extends Controller
{
    public function __invoke(Request $request)
    {
        $paises = Pais::all();
        return view('formRegCliente', compact('paises'));
    }
}
