<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Provincia;
use App\Models\Empleado;
use App\Models\Cliente;
use App\Models\Tarea;

class ControllerTareas extends Controller
{

    public function formularioInsertar(Request $request)
    {
        $provincias = Provincia::all();
        $empleados = Empleado::all();
        $clientes = Cliente::all();
        return view('formTarea', compact('provincias', 'empleados', 'clientes'));
    }

    public function validarInsertar()
    {
        $datos = request()->validate([
            'cliente' => 'required',
            'nombre_y_apellidos' => 'required|min:3|max:100|regex:/^[^,]*$/',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'correo' => 'required|email',
            'descripcion' => 'required',
            'direccion' => 'required',
            'poblacion' => 'required',
            'codigo_postal' => ['required', 'regex:/^(0[1-9]|[1-4][0-9]|5[0-2])[0-9]{3}$/'],
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

    public function listar()
    {
        $tareas = Tarea::orderBy('fecha_realizacion', 'desc')->paginate(10);
        return view('listaTareas', compact('tareas'));
    }

    public function detallesTarea(Tarea $tarea)
    {
        return view('detallesTarea', compact('tarea'));
    }

    public function mensajeBorrar(Tarea $tarea)
    {
        return view('mensajeBorrarTarea', compact('tarea'));
    }

    public function borrarTarea(Tarea $tarea)
    {
        $tarea->delete();
        session()->flash('message', 'La tarea ha sido borrada correctamente.');
        return redirect()->route('listaTareas');
    }
}
