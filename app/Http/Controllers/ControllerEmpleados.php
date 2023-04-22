<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Rules\DniRule;

use App\Models\Empleado;

class ControllerEmpleados extends Controller
{
    /**
     * formularioInsertar - Muestra el formulario para insertar un nuevo empleado
     *
     * @param Request $request La solicitud HTTP recibida
     * return nos lleva a la vista del formulario de registro
     */

    public function formularioInsertar(Request $request)
    {
        return view('formRegEmpleado', $request);
    }

    /**
     * validarInsertar - valida los datos para insertar un nuevo empleado
     *
     * return nos lleva a la vista del formulario
     */

    public function validarInsertar()
    {
        $datos = request()->validate([
            'nif' => ['required', new DniRule],
            'nombre_y_apellidos' => 'required|min:3|max:100',
            'password' => 'required|min:6|max:15|regex:/^[^,]*$/',
            'fecha_alta' => 'required',
            'email' => 'required|email',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'direccion' => 'required|min:6|max:100',
            'es_admin' => 'required',
        ]);

        $datos['password'] = Hash::make($datos['password']);

        Empleado::create($datos);

        session()->flash('message', 'El empleado ha sido registrado correctamente.');

        return redirect()->route('formRegEmpleado');
    }

    /**
     * listar - Muestra ua lista paginada de empleados
     *
     * return nos lleva a la vista listarEmpleados
     */

    public function listar()
    {
        $empleados = Empleado::orderBy('id', 'desc')->paginate(10);
        return view('listaEmpleados', compact('empleados'));
    }

    /**
     * mensajeBorrar - muestra un mensaje de confirmacion de borrado de un empleado
     *
     * @param Empleado $empleado es el empleado que vamos a borrar
     * return nos lleva a la vista 
     */

    public function mensajeBorrar(Empleado $empleado)
    {
        return view('mensajeBorrarEmpleado', compact('empleado'));
    }

    /**
     * borrarEmpleado - borra un empleado
     *
     * @param Empleado $empleado el empleado que se va a borrar
     * return retorna la vista listaEmpleados una vez borrado el empleado
     */

    public function borrarEmpleado(Empleado $empleado)
    {
        $empleado->delete();
        session()->flash('message', 'El empleado ha sido borrado correctamente.');
        return redirect()->route('listaEmpleados');
    }

    /**
     * forModEmpleado - Muestra el formulario para modificar un empleado
     *
     * @param Empleado $empleado Es el empleado que vamos a modificar
     * return nos lleva a la vista del formulario
     */

    public function forModEmpleado(Empleado $empleado)
    {
        $empleados = Empleado::all();
        return view('forModEmpleado', compact('empleado'));
    }

    /**
     * modificarEmpleado: Actualiza la información de un empleado
     *
     * @param Empleado $empleado El empleado que va a ser modificado.
     * return retorna la vista listaEmpleados una vez modificado el empleado
     */

    public function modificarEmpleado(Empleado $empleado)
    {
        $datos = request()->validate([
            'nif' => ['required', new DniRule],
            'nombre_y_apellidos' => 'required|min:3|max:100',
            //'password' => 'required|min:6|max:15|regex:/^[^,]*$/',
            'fecha_alta' => 'required',
            'email' => 'required|email',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'direccion' => 'required|min:6|max:100',
            'es_admin' => 'required',
        ]);

        //$datos['password'] = Hash::make($datos['password']);

        $empleado->update($datos);
        session()->flash('message', 'La tarea ha sido modificada correctamente.');
        return redirect()->route('listaEmpleados');
    }

    /**
     * verMiCuenta - Muestra el formulario para modificar un empleado
     *
     * @param Empleado $empleado Es el empleado que vamos a modificar
     * return nos lleva a la vista del formulario
     */

    public function verMiCuenta(Empleado $empleado)
    {
        $empleados = Empleado::all();
        return view('miCuenta', compact('empleado'));
    }

    /**
     * modificarMiCuenta: Actualiza la información de un empleado
     *
     * @param Empleado $empleado El empleado que va a ser modificado.
     * return retorna la vista miCuenta una vez modificado el empleado
     */

    public function modificarMiCuenta(Empleado $empleado)
    {
        $datos = request()->validate([
            'email' => 'required|email',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'direccion' => 'required|min:6|max:100',
            'fecha_alta' => 'required',
        ]);

        $empleado->update($datos);
        session()->flash('message', 'Los datos han sido actualizados correctamente.');
        return redirect()->route('miCuenta', $empleado);
    }
}
