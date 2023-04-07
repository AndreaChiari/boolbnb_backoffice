@extends('layouts.app')
@section('content')
    <div class="jumbotron p-5 mb-4 bg-light rounded-3">
        <div class="container py-5">
            {{-- @if ($sponsorships->count() > 0)
                <h1 class="text-center">I NOSTRI APPARTAMENTI SPONSORIZZATI</h1>
            @else
                <h1 class="text-center">Benvenuti alla home, inserisci un appartamento</h1>
            @endif --}}
        </div>
    </div>

    <div class="content">
        <div class="container">
            <details class="fw-lighter">
                <summary>Info</summary>
                Benvenuti nel nostro back office, il luogo dove potete gestire al meglio le vostre inserzioni di
                appartamenti! Qui potete aggiungere nuovi appartamenti e inserire tutte le informazioni necessarie per farli
                conoscere ai nostri visitatori. Potete inserire dettagliate descrizioni dell'appartamento, comprensive di
                tutte le caratteristiche, i servizi disponibili e la posizione geografica. Potete anche caricare foto
                dell'appartamento e della zona circostante, per mostrare ai vostri potenziali ospiti tutti i dettagli della
                vostra proprietà.
            </details>
        </div>
    </div>
@endsection
