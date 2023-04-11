@extends('layouts.app')

@section('title', $apartment->address)

@section('content')
    <div id="apartment-show" class="container mt-5">
        <div class="card container-detail-main">
            <div class="row g-0 container-main">
                <div class="col-md-4">
                    <figure class="text-center h-100">
                        <img src="{{ $apartment->getThumbUrl() }}" alt="{{ $apartment->address }}"
                            class="img-fluid h-100 detail-main-img" style="object-fit: cover;">
                    </figure>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row align-items-center mb-4">
                            <h1 class="card-title col-10 mb-0">{{ $apartment->name }}</h1>
                            <form class="col-2 visibility d-flex align-items-center" method="POST"
                                action="{{ route('admin.apartments.toggle-visibility', $apartment->id) }}">
                                @method('PATCH')
                                @csrf
                                <p class="mb-1 text-color-main">Visibilità</p>
                                <button class="btn-backoffice py-2 px-3">
                                    @if ($apartment->visibility)
                                        <i class="fa-regular fa-eye"></i>
                                    @else
                                        <i class="fa-regular fa-eye-slash"></i>
                                    @endif
                                </button>
                            </form>
                        </div>
                        <p class="address card-text">{{ $apartment->address }}</p>
                        <p class="description card-text">{{ $apartment->description }}</p>
                        <p class="card-text price fw-bold fs-4">{{ $apartment->price }} € / notte</p>
                        <div class="services row justify-content-end">
                            @if ($apartment->services)
                                @foreach ($apartment->services as $service)
                                    <div class="col-4 col-sm-3 col-md-2 text-center">
                                        <i class="{{ $service->icon }} my-3 fa-2x"></i>
                                        <p>{{ $service->name }}</p>
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
    <div class="container buttons d-flex my-5 justify-content-end align-items-center">
        <a class="btn-backoffice py-2 px-3 me-2" href="{{ route('admin.messages.index', $apartment->id) }}">
            <i class="fa-solid fa-envelope"></i>
            @if ($new_messages)
                <p class="messages-notification text-center">{{ $new_messages }}</p>
            @endif
        </a>
        <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn-backoffice py-2 px-3 me-2"><i
                class="fa-regular fa-pen-to-square"></i></a>
        <form class="deleteForm" action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn-backoffice py-2 px-3 me-5" type="submit"><i class="fa-regular fa-trash-can"></i></button>
        </form>
        <a class="btn-backoffice bordered p-2 d-flex align-items-center justify-content-center"
            href="{{ route('admin.apartments.index') }}"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
@endsection
