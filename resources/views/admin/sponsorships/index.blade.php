@extends('layouts.app')

@section('title', 'Sponsor')

@section('content')
    <section class="general">
        <div class="container spon">
            @foreach ($sponsorships as $sponsorship)
                <div
                    class="box @if ($sponsorship->duration === 24) green @elseif ($sponsorship->duration === 72) purple @else gold @endif">
                    <span></span>
                    <div class="content">
                        <h2>{{ $sponsorship->name }}</h2>
                        <p>Sponsorizza il tuo appartamento per {{ $sponsorship->duration }} ore</p>
                        <p>Prezzo: {{ $sponsorship->price }} €</p>
                        <a href="{{ route('admin.payments', ['apartment' => $apartment->id, 'sponsorship' => $sponsorship->id]) }}"
                            class="btn btn-primary">Acquista ora</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <div class="container">
        <div class="d-flex mb-5 justify-content-end mb-2 me-2">
            <a class="btn-backoffice bordered px-2 py-1" href="{{ route('admin.apartments.index') }}"><i
                    class="fa-solid fa-arrow-left"></i></a>
        </div>
    </div>
@endsection
