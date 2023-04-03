@extends('layouts.app')

@section('title', 'Edit apartment')

@section('content')
    <header>
        <h1 class="my-5 text-white">Edit Apartment:</h1>
    </header>

    {{-- FORM --}}
    @include('includes.form')
@endsection
