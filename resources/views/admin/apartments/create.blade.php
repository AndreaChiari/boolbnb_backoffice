@extends('layouts.app')

@section('title', 'Aggiungi appartamento')

@section('content')
    <header class="container">
        <h1 class="form-title my-5">Aggiungi Appartamento:</h1>
    </header>

    {{-- FORM --}}
    @include('includes.form')
@endsection
