<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProvaController extends Controller
{
    public function prova()
    {
        $address = 'Via 2 Giugno, 5, 73048, Nardò';
        $response = Http::get("https://api.tomtom.com/search/2/geocode/$address.json?key=lCdijgMp1lmgVifAWwN8K9Jrfa9XcFzm");
        dd($response->json());
    }
}
