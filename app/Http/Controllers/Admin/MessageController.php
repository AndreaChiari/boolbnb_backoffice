<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();

        return view('admin.messages.index', compact('messages'));
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
    public function show(string $id)
    {
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
    public function update(Request $request, Messsage $id)
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
        $message->delete();

        return to_route('admin.messages.index');
    }
}
