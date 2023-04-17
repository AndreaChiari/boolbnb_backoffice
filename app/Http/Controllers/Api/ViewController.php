<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function getIp()
    {
        $ip = file_get_contents("http://ipecho.net/plain");
        return response()->json($ip);
    }
}
