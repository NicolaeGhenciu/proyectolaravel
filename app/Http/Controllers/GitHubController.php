<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;

class GitHubController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        $empleadoExist = Empleado::where('email', $user->email)->first();

        if ($empleadoExist) {
            // Si el usuario existe en la base de datos, podemos autenticarlo.
            Auth::login($empleadoExist);

            if ($empleadoExist->es_admin === 1) {
                return redirect()->route('listaEmpleados');
            } else {
                return redirect()->route('listaTareasOperario');
            }
        } else {
            // Si el usuario no existe en la base de datos, podemos crear un nuevo registro para él.
            $empleado = new Empleado();
            $empleado->nombre_y_apellidos = $user->nickname;
            $empleado->email = $user->email;
            $empleado->es_admin = 0;
            $empleado->save();

            // Y luego autenticarlo.
            Auth::login($empleado);

            // Finalmente, redirigimos al usuario a la página deseada.
            return redirect()->route('listaTareasOperario');
        }
    }
}
