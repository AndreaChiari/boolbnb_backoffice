<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\Sponsorship;
use App\Models\Apartment;
use vendor\braintree\braintree_php\lib\Braintree\Gateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        session_start();
        if (isset($request->all()['apartment'])) {
            $_SESSION["aparment_id"] = $request->all()['apartment'];
            $apartment = Apartment::where('id', $_SESSION["aparment_id"])->first();
        } else $apartment = Apartment::where('id', $_SESSION["aparment_id"])->first();
        if (isset($request->all()['sponsorship'])) {
            $_SESSION["sponsorship_id"] = $request->all()['sponsorship'];
            $sponsorship = Sponsorship::where('id', $_SESSION["sponsorship_id"])->first();
        } else $sponsorship = Sponsorship::where('id', $_SESSION["sponsorship_id"])->first();


        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->ClientToken()->generate();
        return view('admin.braintree.payment_form', compact('token', 'apartment', 'sponsorship'));
    }

    public function checkout(Request $request)
    {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $amount = $request->amount;
        $nonce =  $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;
            $apartment = Apartment::find($request->all()['apartment']);
            $sponsorship = Sponsorship::find($request->all()['sponsorship']);
            $sponsorship_duration = $sponsorship->duration;
            $start_date = now();
            $end_date = date_add(now(), date_interval_create_from_date_string("$sponsorship_duration hours"));
            $apartment->sponsorships()->attach($sponsorship->id, ['start_date' => $start_date, 'end_date' => $end_date]);
            return to_route('admin.apartments.show', $apartment->id)->with('msg', 'Transazione riuscita! N. Transazione: ' . $transaction->id);
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return back()->withErrors('Transazione negata' . $result->message);
        }
    }
}
