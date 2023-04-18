<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Apartment $apartment, Request $request)
    {
        $data = $request->all();
        if (Arr::exists($data, 'end_date')) {
            $end_date = Carbon::createFromFormat('Y-m-d', $data['end_date'])->format('Y-m-d');
        } else {
            $end_date = Carbon::today()->format('Y-m-d');
        }
        if (Arr::exists($data, 'start_date')) {
            $start_date = Carbon::createFromFormat('Y-m-d', $data['start_date'])->format('Y-m-d');
        } else {
            $start_date = Carbon::today()->subDays(7)->format('Y-m-d');
        }

        $views = View::select(DB::raw('CAST(date AS DATE) as date'), DB::raw('COUNT(*) as count'))
            ->where('apartment_id', $apartment->id)
            ->whereBetween('date', [$start_date, $end_date])
            ->groupBy('date')
            ->get();

        return view('admin.apartments.statistics.index', compact('apartment', 'start_date', 'end_date', 'views'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
