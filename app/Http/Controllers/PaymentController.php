<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;

use PayPal\Exception\PayPalConnectionException;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $paypalConfig = Config::get('services.paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $paypalConfig['client_id'],
                $paypalConfig['secret']
            )
        );
    }


    public function pagarConPaypal($cuota)
    {
        //sb-0dxrw25143926@personal.example.com
        //_?5+mL4[
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($cuota); // Intentar pasarle las variables de importe e iso moneda
        $amount->setCurrency('EUR');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        //$transaction->setDescription('Esto es una descripcion');

        $callbackURL = url('/paypal/status');
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackURL)
            ->setCancelUrl($callbackURL);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);


        try {
            $payment->create($this->apiContext);
            echo $payment;

            return redirect()->away($payment->getApprovalLink());
            // echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";

        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function paypalStatus(Request $request)
    {
        // dd($request->all());
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            session()->flash('message', 'La cuota ha sido pagada correctamente.');
            return redirect()->route('listaCuotas', 'fecha_emision');
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        $result = $payment->execute($execution, $this->apiContext);

        //dd($result); aqui vemos el resultado

        if ($result->getState() === 'approved') {
            //Cambiar el redirect y poner el session message verde de exito
            session()->flash('message', 'La cuota ha sido pagada correctamente.');
            return redirect()->route('listaCuotas', 'fechaEmision');
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.'; //Cambiar el redirect y poner el session error rojo de exito
        return redirect()->route('listaCuotas', 'fecha_emision');
    }
}
