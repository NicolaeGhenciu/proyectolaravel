<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class SessionController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $role = $user->role;

            $request->session()->put('user', $user);
            $request->session()->put('role', $role);

            return redirect()->intended('dashboard');
        }

        return redirect()->back()->withInput($request->only('email'))->withErrors(['email' => 'These credentials do not match our records.']);
    }
}
