@extends('layouts.app')

@section('title', 'Messaggi')

@section('content')

    <div class="container py-5">
        @forelse ($messages as $message)
            <div class="row border">
                <div class="col-5 d-flex align-items-center py-2 ps-3">
                    <p class="mb-0"><b>Oggetto:</b> {{ $message->object }}</p>
                </div>
                <div class="col-5 d-flex align-items-center py-2">
                    <p class="mb-0"><b>Da:</b> {{ $message->email }}</p>
                </div>
                <div class="col-2 p-2 d-flex justify-content-center align-items-center">
                    <a href="" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                </div>
            </div>
        @empty
            <div class="row row-cols-1">
                <div class="col d-flex align-items-center justify-content-center p-2">Non ci sono messaggi</div>
            </div>
        @endforelse
    </div>


@endsection
