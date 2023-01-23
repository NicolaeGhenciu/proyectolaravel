<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pais;
use App\Models\Cliente;

use App\Rules\CifRules;



class ControllerClientes extends Controller
{
    public function formularioInsertar(Request $request)
    {
        $paises = Pais::all();
        return view('formRegCliente', compact('paises'));
    }

    public function validarInsertar()
    {

        $validatedData = request()->validate([
            'cif' => ['required', new CifRules],
            'nombre_y_apellidos' => 'required|min:3|max:100|regex:/^[^,]*$/',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'correo' => 'required|email',
            'cuenta_corriente' => 'required|regex:/^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/',
            'importe_cuota_mensual' => 'required|regex:/^[0-9]+(\.[0-9]+)?$/',
            'pais' => 'required',
            'moneda' => 'required',
        ]);

        Cliente::create($validatedData);

        session()->flash('message', 'El cliente ha sido registrado correctamente.');

        return redirect()->route('formRegCliente');
    }

    public function listar()
    {
        $clientes = Cliente::orderBy('id', 'desc')->paginate(10);
        $paises = Pais::all();
        return view('listaClientes', compact('clientes','paises'));
    }

    public function mensajeBorrar(Cliente $cliente)
    {
        return view('mensajeBorrarCliente', compact('cliente'));
    }

    public function borrarCliente(Cliente $cliente)
    {
        $cliente->delete();
        session()->flash('message', 'El cliente ha sido borrado correctamente.');
        return redirect()->route('listaClientes');
    }
}
