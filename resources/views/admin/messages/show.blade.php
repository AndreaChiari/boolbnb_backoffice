@extends('layouts.app')

@section('title', $message->object)

@section('content')
    <div class="container py-5">
        <div class="card p-3">
            <h3 class="text-center mb-5">{{ $message->object }}</h3>
            <h6 class="mb-5">Da: {{ $message->email }}</h6>
            <p>{{ $message->content }}</p>
        </div>
    </div>
    <div class="buttons container d-flex justify-content-end">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Indietro</a>
    </div>
@endsection
