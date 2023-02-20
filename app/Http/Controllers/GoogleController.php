<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Empleado;
use PhpParser\Node\Expr\Empty_;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {   
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/');
        }

        $existingUser = Empleado::where('email', $user->email)->first();

        dd($existingUser);

        if ($existingUser) {
            Auth::login($existingUser, true);
        } else {
            $newUser                    = new Empleado;
            $newUser->name              = $user->name;
            $newUser->email             = $user->email;
            $newUser->google_id         = $user->id;
            $newUser->password          = bcrypt('123456');
            $newUser->save();
            Auth::login($newUser, true);
        }

        return redirect()->to('/miCuenta');
    }
}
