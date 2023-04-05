@extends('layouts.app')

@section('title', 'Apartments')

@section('content')
    <section id="apartments">
        <div class="container py-5 mt-5">
            <div class="d-flex justify-content-end my-4">
                <a href="{{ route('admin.apartments.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach ($apartments as $apartment)
                    <div class="col mb-4">
                        <div class="card h-100 shadow-sm">
                            <a href="{{ route('admin.apartments.show', $apartment['id']) }}"
                                style="text-decoration: none; color:black">
                                <img src="{{ $apartment->getThumbUrl() }}" class="card-img-top"
                                    alt="{{ $apartment->address }}">
                            </a>
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title">{{ $apartment->address }}</h5>
                                    <ul class="list-unstyled mb-0">
                                        <li>Numero stanze: {{ $apartment->rooms }}</li>
                                        <li>Numero letti: {{ $apartment->beds }}</li>
                                        <li>Numero bagni: {{ $apartment->bathrooms }}</li>
                                    </ul>
                                </div>
                                <div>
                                    <p class="card-text fw-bold fs-4">{{ $apartment->price }} € / notte</p>
                                    {{-- Bottoni --}}
                                    <div class="d-flex justify-content-center align-items-center mt-2 mb-2 gap-3">
                                        <a href="{{ route('admin.apartments.edit', $apartment->id) }}"
                                            class="btn btn-warning"><i class="fa-solid fa-arrow-up "></i></a>
                                        <form action="{{ route('admin.apartments.destroy', $apartment->id) }}"
                                            method="POST" class="deleteForm">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger flex-fill" type="submit"><i
                                                    class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
