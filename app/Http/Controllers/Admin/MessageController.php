<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Apartment $apartment)
    {
        $messages = Message::where('apartment_id', $apartment->id)->orderBy('is_read')->orderBy('created_at')->get();
        $messages_count = count($messages);
        $unread_messages_count = Message::where('is_read', 0)->where('apartment_id', $apartment->id)->count();
        $apartment_id = $apartment->id;

        if ($apartment->user_id !== Auth::id()) abort(403, 'Access Denied');
        return view('admin.messages.index', compact('messages', 'messages_count', 'unread_messages_count', 'apartment_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.messages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $message = new Message();

        $message->fill($data);

        $message->save();

        return redirect()->route('admin.messages.show', $message->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        if ($message->apartment->user_id !== Auth::id()) abort(403, 'Access Denied');
        $message->is_read = 1;
        $message->save();
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $message = Message::findOrFail($id);
        return view('admin.messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        $data = $request->all();

        $message->update($data);

        return redirect()->route('admin.messages.show', $message->id);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $apartment_id = $message->apartment->id;
        $message->delete();

        return to_route('admin.messages.index', $apartment_id);
    }
}
