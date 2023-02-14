<?php

namespace App\Http\Controllers;

use App\Mail\SiempreColgadosMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class ControllerFactura extends Controller
{
    public function store(Request $request)
    {
        $message = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'content' => $request->content,
            'archivo' => $request->file('archivo')
        ];

        Mail::to($message['email'])->send(new SiempreColgadosMail($message));
    }
}
