@extends('layouts.app')

@section('title', 'Statistiche')

@section('content')
    <div class="container py-5 text-white">
        <h1>Statistiche</h1>
        <form action="{{ route('admin.statistics.index', $apartment->id) }}" class="mb-5">
            @csrf
            <label for="start_date">Data Iniziale</label>
            <input type="date" id="start_date" name="start_date" value="{{ $start_date }}">
            <label for="end_date">Data finale</label>
            <input type="date" id="end_date" name="end_date" value="{{ $end_date }}">
            <button>Invia</button>
        </form>
        <div class="row justify-content-center">
            @foreach ($views as $view)
                <div class="col-1 d-flex flex-column justify-content-end align-items-center">
                    <p class="graph d-flex align-items-end justify-content-center p-2 rounded"
                        style="height: calc(50px * {{ $view->count }})">
                        <span>{{ $view->count }}</span>
                    </p>
                    <p>{{ $view->date }}</p>
                </div>
            @endforeach
        </div>
    </div>

@endsection
