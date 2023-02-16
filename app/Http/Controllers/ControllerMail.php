<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Hash;

use App\Rules\DniRule;
use App\Models\Empleado;

class ControllerMail extends Controller
{

    public function formRecuperarPass(Request $request)
    {
        return view('formRecuperarPass', $request);
    }

    public function validarRecuperarContraseña()
    {
        $datos = request()->validate([
            'nif' => ['required', new DniRule],
            'email' => 'required|email',
        ]);

        // Obtener el empleado que deseamos actualizar
        $empleado = Empleado::where('nif', $datos['nif'])
            ->where('email', $datos['email'])
            ->first();

        if ($empleado) {

            $pass = $this->generatePass();
            //dd($pass);

            $email = "nicoadrianx42x@gmail.com";

            $datos['password'] = $pass;

            $datos['password'] = Hash::make($datos['password']);
            // Actualizar los datos del empleado
            $empleado->update($datos);

            //enviar contraseña por correo

            Mail::send('email.recuperarPass', ['pass' => $pass, 'empleado' => $empleado], function ($message) use ($email) {
                $message->to($email)
                    ->subject('Nueva contraseña');
            });

            session()->flash('message', 'Se ha enviado la nueva contraseña a tu email.');
        } else {
            session()->flash('error', 'Los datos introducidos no coinciden con ningun empleado.');
        }
        return redirect()->route('formRecuperarPass');
    }

    public function generatePass()
    {
        $password = '';
        $length = 8;

        // Generar la contraseña aleatoria
        $upper = false;
        $number = false;
        while (strlen($password) < $length || !$upper || !$number) {
            $char = chr(random_int(33, 126));
            if (ctype_upper($char)) {
                $upper = true;
            } elseif (ctype_digit($char)) {
                $number = true;
            }
            $password .= $char;
        }
        return $password;
    }

    // public function enviarCorreo()
    // {
    //     $to = 'nicoadrianx42x@gmail.com';
    //     $subject = 'Correo de prueba';
    //     $body = 'Este es un correo electrónico de prueba enviado directamente desde Laravel.';
    //     Mail::raw($body, function (Message $message) use ($to, $subject) {
    //         $message->to($to)
    //             ->subject($subject);
    //     });
    //     return 'Correo electrónico enviado';
    // }
}
