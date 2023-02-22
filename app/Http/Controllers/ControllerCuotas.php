<?php

namespace App\Http\Controllers;

use App\Mail\NosecaenMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Cliente;
use App\Models\Cuota;
use App\Models\Tarea;

use PDF;

class ControllerCuotas extends Controller
{

    //formulario Remesa Mensual

    public function formularioRemesa(Request $request)
    {
        $clientes = Cliente::all();
        return view('formRemesaMensual', compact('clientes'));
    }

    public function validarInsertarRemesa()
    {
        $data = request()->validate([
            'concepto' => 'required',
            'fecha_emision' => 'required|after:now',
            'notas' => 'required',
        ]);

        $clientes = Cliente::all();

        foreach ($clientes as $cliente) {
            $data['clientes_id'] = $cliente->id;
            $data['importe'] = $cliente->cuota_mensual;

            $cuota = Cuota::create($data);

            //-----enviar correos cuota remesa mensual

            // $email = 'nicoadrianx42x@gmail.com';

            // $pdf = PDF::loadView('facturas.factura', compact('cuota'));
            // $pdf_content = $pdf->output();

            // $asunto = "Factura $cuota->id $cuota->concepto";

            // Mail::send('email.cuotaPDF', ['cliente' => $cliente, 'asunto' => $asunto], function ($message) use ($email, $pdf_content, $asunto) {
            //     $message->to($email)
            //         ->subject($asunto)
            //         ->attachData($pdf_content, "$asunto.pdf");
            // });
        }

        session()->flash('message', 'La cuota ha sido creada correctamente.');

        return redirect()->route('formRemesaMensual');
    }

    //Formulario Cuota Excepcional

    public function formularioCuota(Request $request)
    {
        $clientes = Cliente::whereNull('deleted_at')->get();
        return view('formCuotaExcepcional', compact('clientes'));
    }

    public function validarCuotaExcepcional()
    {
        $data = request()->validate([
            'clientes_id' => 'required',
            'concepto' => 'required',
            'fecha_emision' => 'required|after:now',
            'importe' => 'required',
            'notas' => 'required',
        ]);

        $cuota = Cuota::create($data);

        //-----Enviar Cuota excepcional por correo automaticamente

        $cliente = Cliente::where('id', $data['clientes_id'])->first();
        //$cliente = Cliente::where('id', $data['clientes_id'])->whereNotNull('deleted_at')->first();

        //dd($cliente);

        $email = 'nicoadrianx42x@gmail.com';

        $pdf = PDF::loadView('facturas.factura', compact('cuota'));
        $pdf_content = $pdf->output();


        $asunto = "Factura $cuota->id $cuota->concepto";

        Mail::send('email.cuotaPDF', ['cliente' => $cliente, 'asunto' => $asunto], function ($message) use ($email, $pdf_content, $asunto) {
            $message->to($email)
                ->subject($asunto)
                ->attachData($pdf_content, "$asunto.pdf");
        });

        session()->flash('message', 'La cuota ha sido creada correctamente.');

        return redirect()->route('formularioCuota');
    }

    //Listar Cuotas

    public function listar($filtro = "")

    {
        $tareas = Tarea::all();
        switch ($filtro) {
            case "NO":
                $cuotas = Cuota::where('pagada', 'NO')
                    ->whereHas('cliente', function ($query) {
                        $query->whereNull('deleted_at');
                    })
                    ->orderBy('fecha_emision', 'asc')
                    ->paginate(10);
                break;
            case "SI":
                $cuotas = Cuota::where('pagada', 'SI')
                    ->whereHas('cliente', function ($query) {
                        $query->whereNull('deleted_at');
                    })
                    ->orderBy('fecha_emision', 'asc')
                    ->paginate(10);
                break;
            case "fecha_pago":
                $cuotas = Cuota::orderBy('fecha_pago', 'desc')
                    ->whereHas('cliente', function ($query) {
                        $query->whereNull('deleted_at');
                    })
                    ->paginate(10);
                break;
            default:
                $cuotas = Cuota::orderBy('fecha_emision', 'desc')
                    ->whereHas('cliente', function ($query) {
                        $query->whereNull('deleted_at');
                    })
                    ->paginate(10);
                break;
        }
        return view('listaCuotas', compact('cuotas', 'tareas'));
    }

    //Borrar Cuota

    public function mensajeBorrar(Cuota $cuota)
    {
        return view('mensajeBorrarCuota', compact('cuota'));
    }

    public function borrarCuota(Cuota $cuota)
    {
        $cuota->delete();
        session()->flash('message', 'La cuota ha sido borrada correctamente.');
        return redirect()->route('listaCuotas', 'fecha_emision');
    }


    //Modificar Cuota

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
        return redirect()->route('listaCuotas', 'fecha_emision');
    }

    public function generarFacturaPdf(Cuota $cuota)
    {
        $pdf = PDF::loadView('facturas.factura', compact('cuota'));

        return $pdf->download('Factura Cuta ' . $cuota->id . ' ' . $cuota->concepto . '.pdf');
    }
}
