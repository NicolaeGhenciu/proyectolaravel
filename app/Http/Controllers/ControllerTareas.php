<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Provincia;
use App\Models\Empleado;
use App\Models\Cliente;
use App\Models\Tarea;

use Illuminate\Support\Facades\Auth;

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
            'clientes_id' => 'required',
            'nombre_y_apellidos' => 'required|min:3|max:100|regex:/^[^,]*$/',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'correo' => 'required|email',
            'descripcion' => 'required',
            'direccion' => '',
            'poblacion' => 'required',
            'codigo_postal' => ['required', 'regex:/^(0[1-9]|[1-4][0-9]|5[0-2])[0-9]{3}$/'],
            'provincias_cod' => 'required',
            'estado' => 'required',
            'empleados_id' => 'required',
            'fecha_realizacion' => 'required|after:now',
        ]);

        $datos['fecha_creacion'] = (new \DateTime())->format('Y-m-d');

        Tarea::create($datos);

        session()->flash('message', 'La tarea ha sido registrado correctamente.');

        return redirect()->route('formTarea');
    }

    public function listar()
    {
        if (Auth::check() && Auth::user()->es_admin === 1) {
            $tareas = Tarea::orderBy('fecha_realizacion', 'desc')->paginate(10);
        } else {
            $tareas = Tarea::where('empleados_id', Auth::user()->id)
                ->orderBy('fecha_realizacion', 'desc')
                ->paginate(10);
        }
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

    public function forModTarea(Tarea $tarea)
    {
        $provincias = Provincia::all();
        $empleados = Empleado::all();
        $clientes = Cliente::all();
        return view('forModTarea', compact('tarea', 'provincias', 'empleados', 'clientes'));
    }

    public function modificarTarea(Tarea $tarea)
    {
        $datos = request()->validate([
            'clientes_id' => 'required',
            'nombre_y_apellidos' => 'required|min:3|max:100',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'correo' => 'required|email',
            'descripcion' => 'required',
            'direccion' => '',
            'poblacion' => 'required',
            'codigo_postal' => ['required', 'regex:/^(0[1-9]|[1-4][0-9]|5[0-2])[0-9]{3}$/'],
            'provincias_cod' => 'required',
            'estado' => 'required',
            'empleados_id' => 'required',
            'fecha_realizacion' => 'required',
            'anotaciones_anteriores' => '',
            'anotaciones_posteriores' => '',
            'fichero_resumen' => 'file'
        ]);

        if (request()->hasFile('fichero_resumen')) {

            $fichero_resumen = request()->file('fichero_resumen');
            $nombre_fichero = $fichero_resumen->getClientOriginalName();
            $path = $fichero_resumen->storeAs('public/files', $nombre_fichero);

            $datos['fichero_resumen'] = $nombre_fichero;
        }

        $tarea->update($datos);
        session()->flash('message', 'La tarea ha sido modificada correctamente.');
        return redirect()->route('listaTareas');
    }

    public function formCompletarTarea(Tarea $tarea)
    {
        return view('formCompletarTarea', compact('tarea'));
    }

    public function validarCompletarTarea(Tarea $tarea)
    {
        $datos = request()->validate([
            'fecha_realizacion' => 'required',
            'anotaciones_anteriores' => '',
            'anotaciones_posteriores' => '',
            'fichero_resumen' => 'file',
            'estado' => 'required'
        ]);

        if (request()->hasFile('fichero_resumen')) {

            $fichero_resumen = request()->file('fichero_resumen');
            $nombre_fichero = $fichero_resumen->getClientOriginalName();
            $path = $fichero_resumen->storeAs('public/files', $nombre_fichero);

            $datos['fichero_resumen'] = $nombre_fichero;
        }

        $tarea->update($datos);
        session()->flash('message', 'La tarea ha sido completada correctamente.');
        return redirect()->route('listaTareas');
    }
}
