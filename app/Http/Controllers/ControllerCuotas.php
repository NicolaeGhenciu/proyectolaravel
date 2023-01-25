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
}
