@extends('layouts.app')

@section('title', $message->object)

@section('content')
    <div class="container py-5">
        <div class="message-card card p-3">
            <time class="mb-3 text-end">{{ $message->getReceivedDate() }}</time>
            <h3 class="message-title text-center mb-5">{{ $message->object }}</h3>
            <h6 class="message-mail mb-5">Da: {{ $message->name }}</h6>
            <h6 class="message-mail mb-5">E-mail: {{ $message->email }}</h6>
            <p class="message-content">{{ $message->content }}</p>
        </div>
    </div>
    <div class="buttons container d-flex justify-content-end align-items-center">
        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="deleteForm me-2">
            @method('DELETE')
            @csrf
            <button class="btn-backoffice py-2 px-3" type="submit"><i class="fa-regular fa-trash-can"></i></button>
        </form>
        <a href="{{ route('admin.messages.index', $message->apartment->id) }}"
            class="btn-backoffice bordered p-2 d-flex align-items-center justify-content-center"><i
                class="fa-solid fa-arrow-left"></i></a>
    </div>
@endsection
