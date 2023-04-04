@extends('layouts.app')

@section('title', 'Messaggi')

@section('content')

    <div class="container py-5">
        @if ($messages_count)
            <h2 class="text-center mb-5">Hai {{ $messages_count }} @if ($messages_count === 1)
                    messaggio
                @else
                    messaggi
                @endif
                @if ($unread_messages_count)
                    di cui {{ $unread_messages_count }} non
                    @if ($unread_messages_count === 1)
                        letto
                    @else
                        letti
                    @endif
                @endif
            </h2>
        @endif
        @forelse ($messages as $message)
            <div class="row border @if ($message->is_read) is-read @endif">
                <div class="col-1 d-flex align-items-center justify-content-center">
                    @if ($message->is_read)
                        <i class="fa-solid fa-envelope-open fa-2x"></i>
                    @else
                        <i class="fa-solid fa-envelope fa-2x"></i>
                    @endif
                </div>
                <div class="col-5 d-flex align-items-center py-2 ps-3">
                    <p class="mb-0"><b>Oggetto:</b> {{ $message->object }}</p>
                </div>
                <div class="col-4 d-flex align-items-center py-2">
                    <p class="mb-0"><b>Da:</b> {{ $message->email }}</p>
                </div>
                <div class="col-2 p-2 d-flex justify-content-center align-items-center">
                    <a href="{{ route('admin.messages.show', $message->id) }}" class="btn btn-primary"><i
                            class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        @empty
            <div class="row row-cols-1">
                <div class="col d-flex align-items-center justify-content-center p-2">Non ci sono messaggi</div>
            </div>
        @endforelse
        <div class="buttons d-flex justify-content-end mt-5">
            <a href="{{ route('admin.apartments.show', $apartment_id) }}" class="btn btn-secondary">Indietro</a>
        </div>
    </div>


@endsection
