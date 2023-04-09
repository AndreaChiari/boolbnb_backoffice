@extends('layouts.app')

@section('title', 'Apartments')

@section('content')
    <section id="apartments">
        <div class="container py-5 mt-5">
            <div class="d-flex justify-content-end my-4">
                <a href="{{ route('admin.apartments.create') }}" class="btn-backoffice px-2 bordered">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach ($apartments as $apartment)
                    <div class="col mb-4">
                        <a href="{{ route('admin.apartments.show', $apartment['id']) }}">
                            <div class="card h-100">
                                <img src="{{ $apartment->getThumbUrl() }}" class="card-img-top"
                                    alt="{{ $apartment->address }}">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h2 class="card-title text-center mb-4">{{ $apartment->name }}</h2>
                                        <div class="details row text-center justify-content-around mb-3">
                                            <div class="col">
                                                <div class="mb-2">
                                                    <i class="fa-solid fa-person-shelter"></i>
                                                </div>
                                                <div class="number">{{ $apartment->rooms }}</div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-2">
                                                    <i class="fa-solid fa-bed"></i>
                                                </div>
                                                <div class="number">{{ $apartment->beds }}</div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-2">
                                                    <i class="fa-solid fa-restroom"></i>
                                                </div>
                                                <div class="number">{{ $apartment->bathrooms }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="price card-text text-center fw-bold mb-3">{{ $apartment->price }} € /
                                            notte</p>
                                        {{-- Bottoni --}}
                                        <div
                                            class="buttons d-flex justify-content-center align-items-center mt-3 mb-2 gap-2">
                                            <a href="{{ route('admin.apartments.edit', $apartment->id) }}"
                                                class="btn-backoffice py-2 px-3"><i
                                                    class="fa-regular fa-pen-to-square"></i></a>
                                            <form action="{{ route('admin.apartments.destroy', $apartment->id) }}"
                                                method="POST" class="deleteForm">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn-backoffice py-2 px-3 flex-fill" type="submit"><i
                                                        class="fa-regular fa-trash-can"></i></button>
                                            </form>
                                            <a href="{{ route('admin.messages.index', $apartment->id) }}"
                                                class="btn-backoffice py-2 px-3"><i class="fa-regular fa-envelope"></i></a>
                                            <a href="" class="btn-backoffice py-2 px-3"><i
                                                    class="fa-solid fa-chart-line"></i></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@section('scripts')

@endsection

@endsection
