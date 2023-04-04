@extends('layouts.app')

@section('title', $apartment->address)

@section('content')

    <div href="{{ route('admin.apartments.show', $apartment['id']) }}" style="text-decoration: none; color:black">
        <div class="card d-flex flex-column align-items-center h-100 justify-content-between">
            <figure class="text-center h-50 w-100">
                <img class="img-fluid" src="{{ $apartment->getThumbUrl() }}" alt="{{ $apartment->address }}"
                    class="img-fluid h-100">
            </figure>
            <div class="info text-center">
                <h1 class="mb-3">apartment {{ $apartment->address }}</h1>
                <p>{{ $apartment->description }}</p>
                <p class="fw-bold fs-4">{{ $apartment->price }} € / notte</p>
            </div>
        </div>
    </div>

    <div class="container buttons d-flex my-5 justify-content-end">
        <a class="btn btn-primary me-2" href="{{ route('admin.messages.index', $apartment->id) }}"><i
                class="fa-solid fa-envelope"></i></a>
        <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn btn-warning me-2"><i
                class="fa-solid fa-arrow-up me-2"></i>Modifica</a>
        <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger me-2" type="submit"><i class="fa-solid fa-trash"></i></button>
        </form>
        <a class="btn btn-secondary" href="{{ route('admin.apartments.index') }}">Indietro</a>
    </div>

@endsection
