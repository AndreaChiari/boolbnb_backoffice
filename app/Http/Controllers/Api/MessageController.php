<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\MessageSentMail;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'apartment_id' => 'required|exists:apartments,id',
            'email' => 'email|required',
            'object' => 'string|required',
            'content' => 'string|required'
        ], [
            'apartment_id.required' => 'L\'identificativo dell\'appartamento è obbligatorio',
            'apartment_id.exists' => 'L\'identificativo dell\'appartamento non esiste',
            'email.email' => 'L\'indirizzo email deve avere un formato valido',
            'email.required' => 'L\'email è obbligatoria',
            'object.string' => 'L\'oggetto deve essere un testo',
            'object.required' => 'L\'oggetto è obbligatorio',
            'content.string' => 'Il messaggio deve essere un testo',
            'content.required' => 'Il messaggio è obbligatoria',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Errore di validazione',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();

        $new_message = new Message();
        $new_message->fill($data);

        $new_message->save();

        $mail = new MessageSentMail($new_message);
        $user = User::findOrFail($new_message->apartment->user_id);
        $address = $user->email;
        Mail::to($address)->send($mail);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
