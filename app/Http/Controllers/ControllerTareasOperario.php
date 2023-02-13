<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Provincia;
use App\Models\Empleado;
use App\Models\Cliente;
use App\Models\Tarea;

use Illuminate\Support\Facades\Auth;

class ControllerTareasOperario extends Controller
{
    public function detallesTarea(Tarea $tarea)
    {
        return view('detallesTarea', compact('tarea'));
    }

    public function listar()
    {
        $tareas = Tarea::where('empleados_id', Auth::user()->id)
            ->orderBy('fecha_realizacion', 'desc')
            ->paginate(10);

        return view('listaTareas', compact('tareas'));
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
        return redirect()->route('listaTareasOperario');
    }
}
