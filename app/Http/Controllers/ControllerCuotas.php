<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Cliente;
use App\Models\Cuota;
use App\Models\Tarea;

use PDF;

class ControllerCuotas extends Controller
{

    /**
     * formularioRemesa - Muestra el formulario para insertar una remesa mensual
     *
     * @param  Request $request La solicitud HTTP recibida
     * return nos lleva a la vista del formulario
     */

    public function tiposCambio()
    {
        $url = "https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
        $xml = file_get_contents($url);
        $data = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $json = json_encode($data);
        $array = json_decode($json, true);

        // Puedes imprimir el JSON resultante para verificar su contenido

        $monedas = array();

        foreach ($array['Cube']['Cube']['Cube'] as $moneda) {
            $monedas[$moneda['@attributes']['currency']] = $moneda['@attributes']['rate'];
        }
        //dd($monedas);
        return view('listaMonedas', ['monedas' => $monedas]);
    }

    public function formularioRemesa(Request $request)
    {
        $clientes = Cliente::all();
        return view('formRemesaMensual', compact('clientes'));
    }

    /**
     * validarInsertarRemesa -valida los datos para insertar la remesa mensual
     *
     * return nos lleva a la vista del formulario remesa
     */

    public function validarInsertarRemesa()
    {
        $data = request()->validate([
            'concepto' => 'required',
            'fecha_emision' => 'required|after:now',
            'notas' => 'required',
        ]);

        $clientes = Cliente::get();

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

    /** 
     * formularioCuota excepcional - Muestra el formulario para insertar una Cuota Excepcional
     *
     * @param  Request $request La solicitud HTTP recibida
     * return nos lleva a la vista del formulario para insertar una cuota excepcional
     */

    public function formularioCuota(Request $request)
    {
        $clientes = Cliente::whereNull('deleted_at')->get();
        return view('formCuotaExcepcional', compact('clientes'));
    }

    /**
     * validarCuotaExcepcional - Valida los datos para insertar una cuota excepcional
     *
     * return retorna a la vista de formularioCuota
     */

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

        $cliente = Cliente::where('id', $data['clientes_id'])->first();
        //$cliente = Cliente::where('id', $data['clientes_id'])->whereNotNull('deleted_at')->first();

        //dd($cliente);

        $email = 'nicoadrianx42x@gmail.com';

        //-----Conversion de moneda

        $tipo_cambio = "";

        if ($cliente['moneda'] != "EUR") {
            $tipo_cambio = $this->obtenerTipoDeCambio($cliente, $cuota);
        }

        //dd($tipo_cambio, $cliente, $cuota);

        //-----Generamos el PDF

        $pdf = PDF::loadView('facturas.factura', compact('cuota', 'cliente', 'tipo_cambio'));

        $pdf_content = $pdf->output();

        //-----Enviar Cuota excepcional por correo automaticamente

        $asunto = "Factura $cuota->id $cuota->concepto";

        Mail::send('email.cuotaPDF', ['cliente' => $cliente, 'asunto' => $asunto], function ($message) use ($email, $pdf_content, $asunto) {
            $message->to($email)
                ->subject($asunto)
                ->attachData($pdf_content, "$asunto.pdf");
        });

        session()->flash('message', 'La cuota ha sido creada correctamente.');

        return redirect()->route('formularioCuota');
    }

    /**
     * Muestra una lista de cuotas
     *
     * @param  string $filtro El filtro a aplicar a la lista de cuotas
     * return La vista de listaCuotas con los resultados de la búsqueda
     */

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

    /**
     * mensajeBorrar - muestra un mensaje de confirmacion de borrado de una cuota
     *
     * @param Cuota $cuota es la cuota que vamos a borrar
     * return nos lleva a la vista 
     */

    public function mensajeBorrar(Cuota $cuota)
    {
        return view('mensajeBorrarCuota', compact('cuota'));
    }

    /**
     * borrarCuota - borra una cuota
     *
     * @param  Cuota $cuota la cuota que se va a borrar
     * return retorna la vista listaCuotas una vez borrado la cuota
     */

    public function borrarCuota(Cuota $cuota)
    {
        $cuota->delete();
        session()->flash('message', 'La cuota ha sido borrada correctamente.');
        return redirect()->route('listaCuotas', 'fecha_emision');
    }

    /**
     * forModCuota - Muestra el formulario para modificar una cuota
     *
     * @param  Cuota $cuota Es la cuota que vamos a modificar
     * return nos lleva a la vista del formulario
     */

    public function forModCuota(Cuota $cuota)
    {
        $clientes = Cliente::all();
        return view('forModCuota', compact('cuota', 'clientes'));
    }

    /**
     * modificarCuota: Actualiza la información de una cuota
     *
     * @param Cuota $cuota La cuota que va a ser modificada.
     * return retorna la vista listaCuotas una vez modificado la cuota
     */

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

    /**
     * generarFacturaPdf: Genera un archivo PDF de la factura
     *
     * @param Cuota $cuota La cuota para la cual se generará la factura.
     * return te descarga la factura generada
     */

    public function generarFacturaPdf(Cuota $cuota)
    {
        $cliente = Cliente::where('id', $cuota['clientes_id'])->first();

        $tipo_cambio = "";

        if ($cliente['moneda'] != "EUR") {
            $tipo_cambio = $this->obtenerTipoDeCambio($cliente, $cuota);
        }

        $pdf = PDF::loadView('facturas.factura', compact('cuota', 'cliente', 'tipo_cambio'));

        return $pdf->download('Factura Cuota ' . $cuota->id . ' ' . $cuota->concepto . '.pdf');
    }

    /**
     * obtenerTipoDeCambio: Obtiene el tipo de cambio entre la moneda del cliente y el euro
     * utilizando la API de Fixer.io.
     *
     * @param $cliente Los datos del cliente.
     * @param $cuota Los datos de la cuota.
     * @return array Un array que devuelve el importe de la conversion, el rate y la fecha de conversion.
     */
    public function obtenerTipoDeCambio($cliente, $cuota)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/fixer/convert?to=EUR&from=" . $cliente['moneda'] . "&amount=" . $cuota['importe'] . "",
            CURLOPT_HTTPHEADER => [
                "Content-Type: text/plain",
                "apikey: KSpigeqxDQS4Ur61vCKKhliO3BrEheWc"
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        return [
            'importe_api' => $response["result"],
            'fecha_conversion' => $response["date"],
            'rate' => $response["info"]["rate"]
        ];
    }
}
