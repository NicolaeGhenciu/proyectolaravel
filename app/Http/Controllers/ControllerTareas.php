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

    /**
     * formularioInsertar - Muestra el formulario para insertar una tarea
     *
     * @param  Request $request La solicitud HTTP recibida
     * return nos lleva a la vista del formulario
     */

    public function formularioInsertar(Request $request)
    {
        $provincias = Provincia::all();
        //$empleados = Empleado::all();
        $empleados = Empleado::whereNotNull('nif')->get();
        $clientes = Cliente::all();
        return view('formTarea', compact('provincias', 'empleados', 'clientes'));
    }

    /**
     * validarInsertar - valida los datos para insertar la tarea
     *
     * return nos lleva a la vista del formulario tarea
     */

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

    /**
     * Muestra una lista de tareas
     *
     * return La vista de listaTareas con los resultados de la búsqueda
     */

    public function listar()
    {
        //$tareas = Tarea::orderBy('fecha_realizacion', 'desc')->paginate(10);
        $tareas = Tarea::whereHas('cliente', function ($query) {
            $query->whereNull('clientes.deleted_at');
        })
            ->orderBy('fecha_realizacion', 'desc')
            ->paginate(10);

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
        //$empleados = Empleado::all();
        $empleados = Empleado::whereNotNull('nif')->get();
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

    public function formTareaParaClientes(Request $request)
    {
        $provincias = Provincia::all();
        $empleados = Empleado::all();
        $clientes = Cliente::all();
        return view('formTareaParaCliente', compact('provincias'));
    }

    public function validarformTareaParaCliente()
    {

        $datos = request()->validate([
            'cliente_cif' => 'required',
            'telefono_cliente' => 'required',

            'clientes_id' => '',
            'nombre_y_apellidos' => 'required|min:3|max:100|regex:/^[^,]*$/',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'correo' => 'required|email',
            'descripcion' => 'required',
            'direccion' => '',
            'poblacion' => 'required',
            'codigo_postal' => ['required', 'regex:/^(0[1-9]|[1-4][0-9]|5[0-2])[0-9]{3}$/'],
            'provincias_cod' => 'required',
            'estado' => '',
            'empleados_id' => '',
            'fecha_realizacion' => 'required|after:now',
        ]);

        $cliente = Cliente::where('cif', $datos['cliente_cif'])
            ->where('telefono', $datos['telefono_cliente'])
            ->first();

        if (
            $cliente != null
        ) {
            //Quitamos los que no nos 
            unset($datos['cliente_cif']);
            unset($datos['telefono_cliente']);

            $datos['fecha_creacion'] = (new \DateTime())->format('Y-m-d');
            $datos['estado'] = "P";
            $datos['clientes_id'] = $cliente->id;

            Tarea::create($datos);

            //dd($datos);
            session()->flash('message', 'La tarea ha sido registrada correctamente.');
            return redirect()->route('formTareaParaClientes');
        }
        session()->flash('error', 'El cliente introducido no existe.');
        return redirect()->route('formTareaParaClientes');
    }
}
