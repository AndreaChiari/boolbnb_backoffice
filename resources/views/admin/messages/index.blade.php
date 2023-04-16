@extends('layouts.app')

@section('title', 'Messaggi')

@section('content')

    <div class="container py-5">
        @if ($messages_count)
            <h2 class="messages-title text-center mb-5">Hai {{ $messages_count }} @if ($messages_count === 1)
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
            <div class="d-flex table-header">
                <p class="text-white mail-object-header">Oggetto:</p>
                <p class="text-white mail-from-header">Da:</p>
                <p class="text-white mail-email-header">E-mail:</p>
                <p class="text-white mail-at-header">Il:</p>
            </div>
        @endif
        @forelse ($messages as $message)
            <div
                class="message-row row flex-column flex-xl-row align-items-center p-3 p-lg-0 @if ($message->is_read) is-read @endif">
                <div></div>
                <div class="col-xl-2 d-flex align-items-center justify-content-center ms-5 py-2 px-0 text-center">
                    <p class="mb-0"><b class="d-xl-none">Oggetto:</b> {{ $message->object }}</p>
                </div>
                <div class="col-xl-2 d-flex align-items-center justify-content-center py-2 px-0 text-center">
                    <p class="mb-0"><b class="d-xl-none">Da:</b> {{ $message->name }}</p>
                </div>
                <div class="col-xl-2 d-flex align-items-center justify-content-center py-2 px-0 text-center">
                    <p class="mb-0"><b class="d-xl-none">Email:</b> {{ $message->email }}</p>
                </div>
                <div class="col-xl-2 d-flex align-items-center justify-content-center py-2 px-0 text-center">
                    <p class="mb-0"><b class="d-xl-none">Il:</b> {{ $message->getReceivedDate() }}</p>
                </div>
                <div class="col-xl-2 p-2 d-flex justify-content-center align-items-center">
                    <a href="{{ route('admin.messages.show', $message->id) }}" class="btn-messages-index me-2"><i
                            class="fa-solid fa-eye"></i></a>
                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="deleteForm">
                        @method('DELETE')
                        @csrf
                        <button class="btn-messages-index flex-fill" type="submit"><i
                                class="fa-solid fa-trash me-4"></i></button>
                    </form>
                    <div class="col-1 d-flex align-items-center justify-content-center">
                        @if ($message->is_read)
                            <i class="fa-solid fa-envelope-open fa-2x"></i>
                        @else
                            <i class="fa-solid fa-envelope unread fa-2x"></i>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="row row-cols-1">
                <div class="col d-flex align-items-center justify-content-center p-2 no-messages">Non ci sono messaggi!
                </div>
            </div>
        @endforelse
        <div class="buttons d-flex justify-content-end mt-5">
            <a href="{{ route('admin.apartments.show', $apartment_id) }}"
                class="btn-backoffice bordered p-2 d-flex align-items-center justify-content-center"><i
                    class="fa-solid fa-arrow-left"></i></a>
        </div>
    </div>


@endsection
