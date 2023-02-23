<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Hash;

use App\Rules\DniRule;
use App\Models\Empleado;
use App\Models\Cuota;
use App\Models\Cliente;

use PDF;

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
            //$email = $datos['email'];

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

    public function enviarCuota(Cuota $cuota)
    {
        $email = 'nicoadrianx42x@gmail.com';

        $asunto = "Factura $cuota->id $cuota->concepto";

        $cliente = Cliente::where('id', $cuota['clientes_id'])->first();

        $tipo_cambio = "";

        if ($cliente['moneda'] != "EUR") {
            $tipo_cambio = $this->obtenerTipoDeCambio($cliente, $cuota);
        }

        $pdf = PDF::loadView('facturas.factura', compact('cuota', 'cliente', 'tipo_cambio'));
        $pdf_content = $pdf->output();

        Mail::send('email.cuotaPDF', ['cliente' => $cliente, 'asunto' => $asunto], function ($message) use ($email, $pdf_content, $asunto) {
            $message->to($email)
                ->subject($asunto)
                ->attachData($pdf_content, "$asunto.pdf");
        });

        session()->flash('message', 'La factura ha sido enviada al cliente correctamente.');

        return redirect()->route('listaCuotas', 'fecha_emision');
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

    public function obtenerTipoDeCambio($cliente, $cuota)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/fixer/convert?to=EUR&from=" . $cliente['moneda'] . "&amount=" . $cuota['importe'] . "",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: KSpigeqxDQS4Ur61vCKKhliO3BrEheWc"
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        return [
            'importe_api' => $response["result"],
            'fecha_conversion' => $response["date"],
            'rate' => $response["info"]["rate"]
        ];
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
