<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cliente;

use App\Models\Cuota;

use App\Models\Tarea;

class ControllerCuotas extends Controller
{
    public function formularioInsertar(Request $request)
    {
        $clientes = Cliente::all();
        return view('formCuota', compact('clientes'));
    }

    public function validarInsertar()
    {
        $data = request()->validate([
            'clientes_id' => 'required',
            'concepto' => 'required',
            'fecha_emision' => 'required',
            'importe' => 'required',
            'pagada' => 'required',
            'fecha_pago' => 'required',
            'notas' => 'required',
        ]);

        Cuota::create($data);

        session()->flash('message', 'La cuota ha sido creada correctamente.');

        return redirect()->route('formCuota');
    }

    public function listar()
    {
        $cuotas = Cuota::orderBy('fecha_emision', 'asc')->paginate(10);
        $tareas = Tarea::all();
        return view('listaCuotas', compact('cuotas', 'tareas'));
    }

    public function mensajeBorrar(Cuota $cuota)
    {
        return view('mensajeBorrarCuota', compact('cuota'));
    }

    public function borrarCuota(Cuota $cuota)
    {
        $cuota->delete();
        session()->flash('message', 'La cuota ha sido borrada correctamente.');
        return redirect()->route('listaCuotas');
    }

    public function forModCuota(Cuota $cuota)
    {
        $clientes = Cliente::all();
        return view('forModCuota', compact('cuota', 'clientes'));
    }

    public function modificarCuota(Cuota $cuota)
    {
        $datos = request()->validate([
            'clientes_id' => 'required',
            'concepto' => 'required',
            'fecha_emision' => 'required',
            'importe' => 'required',
            'pagada' => 'required',
            'fecha_pago' => 'required',
            'notas' => 'required',
        ]);

        $cuota->update($datos);
        session()->flash('message', 'La cuota ha sido modificada correctamente.');
        return redirect()->route('listaCuotas');
    }
}
