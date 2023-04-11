<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get();

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apartment = new Apartment();
        $services = Service::orderBy('id')->get();

        return view('admin.apartments.create', compact('apartment', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['string', 'required'],
                'price' => ['numeric', 'required'],
                'rooms' => ['numeric', 'required'],
                'beds' => ['numeric', 'required'],
                'square_meters' => ['numeric', 'nullable'],
                'bathrooms' => ['numeric', 'nullable'],
                'address' => ['string', 'required'],
                'thumb' => ['file'],
                'description' => ['string', 'nullable'],
            ],
            [
                'name.string' => 'Il nome deve essere una stringa',
                'name.required' => 'Il nome è un campo obbligatorio',
                'price.numeric' => 'Il prezzo deve essere un valore numerico.',
                'price.required' => 'Il prezzo è un campo obbligatorio..',
                'beds.numeric' => 'I letti devono essere valori numerici.',
                'beds.required' => 'I letti sono un campo obbligatorio.',
                'suqare_meters.numeric' => 'I metri quadrati devono essere valori numerici.',
                'bathrooms.numeric' => 'I bagni devono essere valori numerici.',
                'bathrooms.required' => 'I bagni sono un campo obbligatorio.',
                'address.string' => "L'indirizzo deve essere una stringa.",
                'address.required' => "L'indirizzo è un campo obbligatorio.",
                'description.string' => "La descrizione deve essere una stringa.",
            ]
        );

        $data = $request->all();

        $apartment = new Apartment();

        if (Arr::exists($data, 'thumb')) {
            $thumb_url = Storage::put('apartments', $data['thumb']);
            $data['thumb'] = $thumb_url;
        };

        $apartment->fill($data);

        $apartment->user_id = Auth::id();

        $apartment->save();

        if (Arr::exists($data, 'services')) $apartment->services()->sync($data['services']);

        return redirect()->route('admin.apartments.show', $apartment->id)->with('type', 'success')->with('msg', "L'appartamento $apartment->name è stato creato con successo.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        $services = Service::all();
        $new_messages = Message::where('is_read', 0)->where('apartment_id', $apartment->id)->count();
        if ($new_messages >= 100) $new_messages = '99+';
        return view('admin.apartments.show', compact('apartment', 'services', 'new_messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $apartment = Apartment::findOrFail($id);
        $services = Service::orderBy('id')->get();
        $apartment_services = $apartment->services->pluck('id')->toArray();

        return view('admin.apartments.edit', compact('apartment', 'services', 'apartment_services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {
        $request->validate(
            [
                'name' => ['string', 'required'],
                'price' => ['numeric', 'required'],
                'rooms' => ['numeric', 'required'],
                'beds' => ['numeric', 'required'],
                'square_meters' => ['numeric', 'nullable'],
                'bathrooms' => ['numeric', 'required'],
                'address' => ['string', 'required'],
                'thumb' => ['file'],
                'description' => ['string', 'nullable'],
            ],
            [
                'name.string' => 'Il nome deve essere una stringa',
                'name.required' => 'Il nome è un campo obbligatorio',
                'price.numeric' => 'Il prezzo deve essere un valore numerico.',
                'price.required' => 'Il prezzo è un campo obbligatorio..',
                'beds.numeric' => 'I letti devono essere valori numerici.',
                'beds.required' => 'I letti sono un campo obbligatorio.',
                'suqare_meters.numeric' => 'I metri quadrati devono essere valori numerici.',
                'bathrooms.numeric' => 'I bagni devono essere valori numerici.',
                'bathrooms.required' => 'I bagni sono un campo obbligatorio.',
                'address.string' => "L'indirizzo deve essere una stringa.",
                'address.required' => "L'indirizzo è un campo obbligatorio.",
                'description.string' => "La descrizione deve essere una stringa.",
            ]
        );

        $data = $request->all();

        if (Arr::exists($data, 'thumb')) {
            if ($apartment->thumb) Storage::delete($apartment->thumb);
            $thumb_url = Storage::put('apartments', $data['thumb']);
            $data['thumb'] = $thumb_url;
        };

        $apartment->update($data);

        if (Arr::exists($data, 'services')) $apartment->services()->sync($data['services']);
        else if (count($apartment->services)) $apartment->services()->detach();

        return redirect()->route('admin.apartments.show', $apartment->id)->with('type', 'warning')->with('msg', "L'appartmento $apartment->name è stato modificato con successo.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        if ($apartment->thumb) Storage::delete($apartment->thumb);

        $apartment->delete();

        return to_route('admin.apartments.index')->with('type', 'danger')->with('msg', "L'appartamento $apartment->name è stato rimmosso con successo.");
    }

    public function toggleVisibility(Apartment $apartment)
    {
    }
}
