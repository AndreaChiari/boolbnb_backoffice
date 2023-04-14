@extends('layouts.app')

@section('title', 'Sponsor')

@section('content')
    <section class="general">
        <div class="container p-5 h-50">
            <div class="row justify-content-center">
                @foreach ($sponsorships as $sponsorship)
                    <div class="col-md-4">
                        <div
                            class="sponsor-card @if ($sponsorship->duration === 24) sponsor-green @elseif ($sponsorship->duration === 72) sponsor-purple @else sponsor-gold @endif">
                            <div class="sponsor-header">
                                <h3>{{ $sponsorship->name }}</h3>
                            </div>
                            <div class="sponsor-body">
                                <h5>Descrizione offerta</h5>
                                <p>Sponsorizza il tuo appartamento per {{ $sponsorship->duration }} ore</p>
                                <p>Prezzo: {{ $sponsorship->price }} €</p>
                            </div>
                            <div class="sponsor-footer">
                                <a href="{{ route('admin.payments', ['apartment' => $apartment->id, 'sponsorship' => $sponsorship->id]) }}"
                                    class="btn btn-primary">Acquista ora</a>
                            </div>
                        </div>
                    </div>
                @endforeach
    </section>
@endsection
