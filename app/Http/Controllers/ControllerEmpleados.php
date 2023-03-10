<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Rules\DniRule;

use App\Models\Empleado;

class ControllerEmpleados extends Controller
{
    public function formularioInsertar(Request $request)
    {
        return view('formRegEmpleado', $request);
    }

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

    public function listar()
    {
        $empleados = Empleado::orderBy('id', 'desc')->paginate(10);
        return view('listaEmpleados', compact('empleados'));
    }

    public function mensajeBorrar(Empleado $empleado)
    {
        return view('mensajeBorrarEmpleado', compact('empleado'));
    }

    public function borrarEmpleado(Empleado $empleado)
    {
        $empleado->delete();
        session()->flash('message', 'El empleado ha sido borrado correctamente.');
        return redirect()->route('listaEmpleados');
    }

    public function forModEmpleado(Empleado $empleado)
    {
        $empleados = Empleado::all();
        return view('forModEmpleado', compact('empleado'));
    }

    //_________

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

    public function verMiCuenta(Empleado $empleado)
    {
        $empleados = Empleado::all();
        return view('miCuenta', compact('empleado'));
    }

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
