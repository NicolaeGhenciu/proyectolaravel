<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tarea;

class ControllerDatosFormTarea extends Controller
{
    public function enviar()
    {
        $datos = request()->validate([
            'cliente' => 'required',
            'nombre_y_apellidos' => 'required|min:3|max:100|regex:/^[^,]*$/',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'correo' => 'required|email',
            'descripcion' => 'required',
            'direccion' => 'required',
            'poblacion' => 'required',
            'codigo_postal' => 'required', //|regex:/^(?:0[1-9]\d{3}|[1-4]\d{4}|5[0-2]\d{3})$/
            'provincia' => 'required',
            'estado' => 'required',
            'operario_encargado' => 'required',
            'fecha_realizacion' => 'required|after:now',
        ]);

        $datos['fecha_creacion'] = (new \DateTime())->format('Y-m-d');

        Tarea::create($datos);

        session()->flash('message', 'La tarea ha sido registrado correctamente.');

        return redirect()->route('formTarea');
    }
}
