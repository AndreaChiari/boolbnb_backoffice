@extends('layouts.app')

@section('title', $message->object)

@section('content')
    <div class="container py-5">
        <div class="card p-3">
            <time class="mb-3 text-end">{{ $message->getReceivedDate() }}</time>
            <h3 class="text-center mb-5">{{ $message->object }}</h3>
            <h6 class="mb-5">Da: {{ $message->email }}</h6>
            <p>{{ $message->content }}</p>
        </div>
    </div>
    <div class="buttons container d-flex justify-content-end">
        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="deleteForm me-2">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger flex-fill" type="submit"><i class="fa-solid fa-trash"></i></button>
        </form>
        <a href="{{ route('admin.messages.index', $message->apartment->id) }}" class="btn btn-secondary">Indietro</a>
    </div>
@endsection
