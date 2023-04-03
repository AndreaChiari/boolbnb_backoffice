@extends('layouts.app')

@section('title', 'Aggiungi progetto')

@section('content')
    <header>
        <h1 class="my-5 text-white">Aggiungi Appartamento:</h1>
    </header>

    {{-- FORM --}}
    @include('includes.apartments.form')
@endsection
