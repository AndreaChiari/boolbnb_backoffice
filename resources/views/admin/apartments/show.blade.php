@extends('layouts.app')

@section('title', $apartment->address)

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-4">
                    <figure class="text-center">
                        <img src="{{ $apartment->getThumbUrl() }}" alt="{{ $apartment->address }}" class="img-fluid"
                            height="400" width="500">
                    </figure>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h1 class="card-title">{{ $apartment->address }}</h1>
                        <p class="card-text">{{ $apartment->description }}</p>
                        <p class="card-text fw-bold fs-4">{{ $apartment->price }} € / notte</p>
                        <div class="row justify-content-end align-items-center">
                            @if ($apartment->services)
                                @foreach ($apartment->services as $service)
                                    <div class="col-4 col-sm-3 col-md-2 text-center">
                                        <i class="{{ $service->icon }} my-3 fa-2x"></i>
                                    </div>
                                @endforeach
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottoni --}}
    <div class="container buttons d-flex my-5 justify-content-end">
        <a class="btn btn-primary me-2" href="{{ route('admin.messages.index', $apartment->id) }}"><i
                class="fa-solid fa-envelope"></i></a>
        <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn btn-warning me-2"><i
                class="fa-solid fa-arrow-up"></i></a>
        <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger me-2" type="submit"><i class="fa-solid fa-trash"></i></button>
        </form>
        <a class="btn btn-secondary" href="{{ route('admin.apartments.index') }}">Indietro</a>
    </div>

@endsection
