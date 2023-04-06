<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        function distance($lat1, $lon1, $lat2, $lon2)
        {
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                return 0;
            } else {
                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $kilometers = $dist * 60 * 1.1515 * 1.609344;
                return $kilometers;
            }
        }

        //Get all apartments http://127.0.0.1:8000/api/apartments

        $apartments = Apartment::with('services', 'sponsorships', 'apartmentPics')->get();

        //Get apartments in range http://127.0.0.1:8000/api/apartments?lat={lat}&lon={lon}&range={range}

        if (isset($request->lat) && isset($request->lon) && isset($request->range)) {
            $apartments = Apartment::with('services', 'sponsorships', 'apartmentPics')->get()->toArray();
            $lat1 = $request->lat;
            $lon1 = $request->lon;
            $range = $request->range;

            $apartments = array_filter($apartments, function ($apartment) use ($lat1, $lon1, $range) {
                return distance($lat1, $lon1, $apartment['latitude'], $apartment['longitude']) <= $range;
            });
        }

        //Get sponsored apartments http://127.0.0.1:8000/api/apartments?sponsored=1

        if (isset($request->sponsored)) {
            $apartments = Apartment::with('services', 'sponsorships', 'apartmentPics')->get()->toArray();
            $apartments = array_filter($apartments, function ($apartment) {
                $now = Carbon::now();
                $sponsored = false;
                foreach ($apartment['sponsorships'] as $sponsorship) {
                    if ($now->floatDiffInDays($sponsorship['pivot']['end_date'], false) > 0) {
                        $sponsored = true;
                        break;
                    };
                }
                return $sponsored;
            });
        }


        return response()->json($apartments);
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

        //Get single apartment http://127.0.0.1:8000/api/apartments/1

        $apartment = Apartment::with('services', 'sponsorships', 'apartmentPics')->where('id', $id)->get();

        return response()->json($apartment);
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
