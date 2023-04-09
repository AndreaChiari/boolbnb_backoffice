@extends('layouts.app')

@section('title', 'Modifica Appartamento')

@section('content')
    <header class="container">
        <h1 class="form-title my-5">Modifica Appartamento:</h1>
    </header>

    {{-- FORM --}}
    @include('includes.form')
@endsection
