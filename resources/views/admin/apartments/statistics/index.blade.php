@extends('layouts.app')

@section('title', 'Statistiche')

@section('content')
    <div id="statistics">
        <div class="container p-3 text-white my-5">
            <h1 class="mb-5 text-center">Statistiche per <span class="text-color-main">"{{ $apartment->name }}"</span></h1>
            <form id="statistics_form" action="{{ route('admin.statistics.index', $apartment->id) }}"
                class="d-flex flex-column flex-md-row align-items-center justify-content-center mb-5">
                @csrf
                <div class="col-6 col-md-3 d-flex align-items-center me-3 mb-3 mb-md-0">
                    <label for="start_date" class="col-2 me-3">Dal:</label>
                    <input class="form-control" type="date" id="start_date" name="start_date"
                        value="{{ $start_date }}">

                </div>
                <div class="col-6 col-md-3 d-flex align-items-center me-3">
                    <label for="end_date" class="col-2 me-3">Al:</label>
                    <input class="form-control" type="date" id="end_date" name="end_date" value="{{ $end_date }}">
                </div>
            </form>
            <div class="row justify-content-center">
                <div class="col-12">
                    <h4 class="text-center mb-4">Visite totali: {{ $tot_views }}</h4>
                    <div class="graph-container p-3">
                        @foreach ($views as $view)
                            <div class="display-flex flex-column">
                                <div class="graph-bar" style="height: calc(50px * {{ $view->count }})">
                                    <div class="graph-bar-inner"></div>
                                    <div class="graph-bar-overlay">
                                        <span class="graph-count text-center">{{ $view->count }}</span>
                                        <span
                                            class="graph-date text-center d-md-none">{{ date('d-m-Y', strtotime($view->date)) }}</span>
                                    </div>
                                </div>
                                <div class="d-none d-md-block graph-date mt-5">{{ date('d-m-Y', strtotime($view->date)) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex mb-5 justify-content-end mb-2 me-2">
        <a class="btn-backoffice p-1" href="{{ route('admin.apartments.index') }}"><i
                class="fa-solid fa-arrow-left"></i></a>
    </div>
@endsection

@section('scripts')
    <script>
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');
        const statisticsForm = document.getElementById('statistics_form');

        startDate.addEventListener('change', () => {
            statisticsForm.submit();
        });

        endDate.addEventListener('change', () => {
            statisticsForm.submit();
        });
    </script>
@endsection
