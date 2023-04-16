<?php

namespace App\Http\Controllers;

use App\Models\ApartmentPic;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ApartmentPicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate(
            [
                'thumb' => 'required|file',
                'apartment_id' => 'required|exists:apartments,id',
            ],
            [
                'thumb.required' => 'il file immagine è obbligatorio',
                'thumb.file' => 'L\'immagine deve essere un file valido',
                'apartment_id.required' => 'Il riferimento all\'appartamento non è presente',
                'apartment_id.exists' => 'L\'appartamento a cui si fa riferimento non esiste',
            ]
        );
        $data = $request->all();

        $apartment_pic = new ApartmentPic();

        $apartment_id = $data['apartment_id'];

        if (Arr::exists($data, 'thumb')) {
            $thumb_url = Storage::put('apartments', $data['thumb']);
            $data['thumb'] = $thumb_url;
        };

        $apartment_pic->fill($data);

        $apartment_pic->save();

        return redirect()->route('admin.apartments.show', $apartment_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(ApartmentPic $apartmentPic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApartmentPic $apartmentPic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApartmentPic $apartmentPic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApartmentPic $apartmentPic)
    {
        if ($apartmentPic->thumb) Storage::delete($apartmentPic->thumb);

        $apartmentPic->delete();

        return back()->with('type', 'success')->with('msg', "L'immagine è stata rimmossa con successo.");
    }
}
