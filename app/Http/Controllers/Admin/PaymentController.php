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
    public function index()
    {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        $apartments = Apartment::where('id', Auth::id())->get();
        $sponsorships = Sponsorship::where('id', Auth::id())->get();

        $token = $gateway->ClientToken()->generate();
        return view('admin.braintree.payment_form', ['token' => $token], compact('apartments', 'sponsorships'));
    }
}
