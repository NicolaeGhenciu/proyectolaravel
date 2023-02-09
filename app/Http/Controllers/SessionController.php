<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        //dd($credentials);
        //dd($empleado = Empleado::where('email', $request->email)->first());
        //dd(Auth::attempt($credentials));

        if (Auth::attempt($credentials)) {
            //dd(Empleado::where('email', $request->email)->first());
            $empleado = Empleado::where('email', $request->email)->first();
            //dd($empleado->es_admin);
            
            if ($empleado->es_admin === 1) {
                
                return redirect()->route('listaEmpleados');
            } else {
                
                return redirect()->route('listaTareas');
            }
        }

        return redirect()->back()->withInput()->withErrors(['correo' => 'Correo o contraseña incorrectos']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
