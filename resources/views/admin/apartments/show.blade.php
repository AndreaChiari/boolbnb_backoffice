@extends('layouts.app')

@section('title', $apartment->address)

@section('content')

    <div href="{{ route('admin.apartments.show', $apartment['id']) }}" style="text-decoration: none; color:black">
        <div class="card d-flex flex-column align-items-center h-100 justify-content-between">
            <figure class="text-center h-50 w-100">
                <img class="img-fluid" src="{{ $apartment->thumb }}" alt="{{ $apartment->address }}" class="img-fluid h-100">
            </figure>
            <div class="info text-center">
                <h1 class="mb-3">apartment {{ $apartment->address }}</h1>
                <p>{{ $apartment->description }}</p>
            </div>
        </div>
    </div>

    <div class="container buttons d-flex my-5 justify-content-end">
        <a class="btn btn-secondary" href="{{ route('admin.apartments.index') }}">Indietro</a>
    </div>

@endsection
