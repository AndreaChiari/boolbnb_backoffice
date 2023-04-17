<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function getIp()
    {
        $ip = file_get_contents("http://ipecho.net/plain");
        return response()->json($ip);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now();
        $views = View::where('apartment_id', $data['apartment_id'])->get()->toArray();
        $isUnique = true;

        foreach ($views as $view) {
            if (($view['ip'] === $data['ip']) && ($now->floatDiffInHours($view['date'], false) > 0)) {
                $isUnique = false;
            }
        }
        if ($isUnique) {
            $view = new View();

            $view->apartment_id = $data['apartment_id'];
            $view->ip = $data['ip'];
            $view->date = $now;

            $view->save();
        }
    }
}
