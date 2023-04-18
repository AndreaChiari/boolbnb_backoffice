@extends('layouts.app')

@section('title', 'Statistiche')

@section('content')
    <div id="statistics">
        <div class="container py-5 text-white">
            <h1>Statistiche</h1>
            <form action="{{ route('admin.statistics.index', $apartment->id) }}" class="mb-5">
                @csrf
                <label for="start_date">Data Iniziale</label>
                <input type="date" id="start_date" name="start_date" value="{{ $start_date }}">
                <label for="end_date">Data finale</label>
                <input type="date" id="end_date" name="end_date" value="{{ $end_date }}">
                <button class="btz">Invia</button>
            </form>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="graph-container">
                        @foreach ($views as $view)
                            <div class="graph-bar" style="height: calc(50px * {{ $view->count }})">
                                <div class="graph-bar-inner"></div>
                                <div class="graph-bar-overlay">
                                    <span class="graph-count">{{ $view->count }}</span>
                                    <span class="graph-date">{{ $view->date }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
