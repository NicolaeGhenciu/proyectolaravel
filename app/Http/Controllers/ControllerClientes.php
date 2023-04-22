<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pais;
use App\Models\Cliente;
use App\Models\Cuota;

use App\Rules\CifRules;

use PDF;

class ControllerClientes extends Controller
{
    /**
     * formularioInsertar - Muestra el formulario para insertar un nuevo cliente
     *
     * @param Request $request La solicitud HTTP recibida
     * return nos lleva a la vista del formulario de registro
     */

    public function formularioInsertar(Request $request)
    {
        $paises = Pais::all();
        return view('formRegCliente', compact('paises'));
    }

    /**
     * validarInsertar - valida los datos de formulario de registro de un nuevo cliente
     *
     * return nos lleva a la vista del formulario de registro
     */
    public function validarInsertar()
    {

        $validatedData = request()->validate([
            'cif' => ['required', new CifRules],
            'nombre_y_apellidos' => 'required|min:3|max:100|regex:/^[^,]*$/',
            'telefono' => 'required|regex:/^(?:(?:\+?[0-9]{2,4})?[ ]?[6789][0-9 ]{8,13})$/',
            'correo' => 'required|email',
            'cuenta_corriente' => 'required|regex:/^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/',
            'cuota_mensual' => 'required',
            'pais_id' => 'required',
            'moneda' => 'required',
        ]);

        Cliente::create($validatedData);

        session()->flash('message', 'El cliente ha sido registrado correctamente.');

        return redirect()->route('formRegCliente');
    }

    /**
     * listar - Muestra ua lista paginada de clientes
     *
     * return nos lleva a la vista listaClientes
     */

    public function listar()
    {
        $clientes = Cliente::orderBy('id', 'desc')->paginate(10);
        $paises = Pais::all();
        return view('listaClientes', compact('clientes', 'paises'));
    }

    public function generarlistaClientesRusosPdf()
    {
        $clientes = Cliente::where('pais_id', 643)->orderBy('id', 'desc')->paginate(10);

        $paises = Pais::all();

        $sumasCuotas = [];
        foreach ($clientes as $cliente) {
            $cuotas = Cuota::where('clientes_id', $cliente->id)->get();
            $sumaCuotas = 0;
            foreach ($cuotas as $cuota) {
                $sumaCuotas += $cuota->importe;
            }
            $sumasCuotas[$cliente->id] = $sumaCuotas;
        }

        $pdf = PDF::loadView('facturas.rusos', compact('clientes', 'paises', 'sumasCuotas'));

        return $pdf->download('Listado de clientes Rusos.pdf');
    }

    public function listaClientesRusos()
    {
        $clientes = Cliente::where('pais_id', 643)->orderBy('id', 'desc')->paginate(10);
        $paises = Pais::all();

        $sumasCuotas = [];
        foreach ($clientes as $cliente) {
            $cuotas = Cuota::where('clientes_id', $cliente->id)->get();
            $sumaCuotas = 0;
            foreach ($cuotas as $cuota) {
                $sumaCuotas += $cuota->importe;
            }
            $sumasCuotas[$cliente->id] = $sumaCuotas;
        }

        return view('listaClientesRusos', compact('clientes', 'paises', 'sumasCuotas'));
    }

    /**
     * mensajeBorrar - muestra un mensaje de confirmacion de borrado de un cliente
     *
     * @param Cliente $cliente es el cliente que vamos a borrar
     * return nos lleva a la vista 
     */

    public function mensajeBorrar(Cliente $cliente)
    {
        return view('mensajeBorrarCliente', compact('cliente'));
    }

    /**
     * borrarCliente - borra un cliente
     *
     * @param  Cliente $cliente el cliente que se va a borrar
     * return retorna la vista listaClientes una vez borrado el cliente
     */

    public function borrarCliente(Cliente $cliente)
    {
        $cliente->delete();
        session()->flash('message', 'El cliente ha sido borrado correctamente.');
        return redirect()->route('listaClientes');
    }
}
