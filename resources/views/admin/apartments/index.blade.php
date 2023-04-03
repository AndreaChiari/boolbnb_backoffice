@extends('layouts.app')

@section('title', 'Apartaments')

@section('content')
    <section id="apartaments">
        <div class="container py-5 mt-5">
            <div class="text-center my-4">
                <a href="{{ route('admin.apartments.create') }}" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i> Aggiungi un nuovo appartamento
                </a>
            </div>
            <div class="row d-flex g-5 flex-wrap">
                @foreach ($apartments as $apartment)
                    <div class="col-6 my-5" style="height: 400px;">
                        <a href="{{ route('admin.apartments.show', $apartment['id']) }}"
                            style="text-decoration: none; color:black">
                            <div class="card d-flex flex-column-reverse align-items-center h-100 justify-content-between">
                                <figure class="text-center h-50 w-100">
                                    <img src="{{ asset('storage/' . $apartment->thumb) }}" alt="{{ $apartment->address }}"
                                        class="img-fluid h-100">
                                </figure>
                                <div class="info text-center">
                                    <h1>apartment {{ $apartment->address }}</h1>
                                </div>
                            </div>
                        </a>
                        <div class="d-flex justify-content-center align-items-center mt-2 mb-5 gap-3">
                            <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn btn-warning"><i
                                    class="fa-solid fa-arrow-up me-2"></i>Modifica</a>
                            <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
