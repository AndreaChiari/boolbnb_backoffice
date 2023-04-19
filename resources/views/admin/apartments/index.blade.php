@extends('layouts.app')

@section('title', 'Apartments')

@section('content')
    <section id="apartments">
        <div class="container py-5 mt-5">
            <div class="d-flex justify-content-end my-4">
                <a href="{{ route('admin.apartments.create') }}"
                    class="btn-backoffice p-2 bordered d-flex align-items-center justify-content-center">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                @foreach ($apartments as $apartment)
                    @php
                        $new_messages = array_filter($apartment->messages->toArray(), function ($message) {
                            return !$message['is_read'];
                        });
                        $new_messages_count = count($new_messages) > 99 ? '99+' : count($new_messages);
                    @endphp
                    <div class="col mb-4">
                        <a href="{{ route('admin.apartments.show', $apartment->id) }}">
                            <div class="card h-100">
                                <figure>
                                    <img src="{{ $apartment->getThumbUrl() }}" class="card-img-top"
                                        alt="{{ $apartment->address }}">
                                    <div class="overlay p-3">
                                        <span class="views d-flex align-items-center"><i
                                                class="fa-solid fa-eye me-2"></i>{{ count($apartment->views) }}</span>
                                        @if ($apartment->isSponsored())
                                            <div class="sponsored d-flex justify-content-evenly px-2">
                                                <span> SPONSORED </span>
                                                @include('includes.timer')
                                            </div>
                                        @endif
                                        <form class="visibility" method="POST"
                                            action="{{ route('admin.apartments.toggle-visibility', $apartment->id) }}">
                                            @method('PATCH')
                                            @csrf
                                            <div class="position-relative mt-3">
                                                <button class="btn-backoffice position-absolute bottom-50 end-0">
                                                    @if ($apartment->visibility)
                                                        <i class="fa-regular fa-eye mx-0"></i>
                                                    @else
                                                        <i class="fa-regular fa-eye-slash mx-0"></i>
                                                    @endif
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </figure>
                                <div class="card-body">
                                    <h2 class="card-title text-center">{{ $apartment->name }}</h2>
                                    <div class="buttons row justify-content-center align-items-center">
                                        <div class="col-4 d-flex justify-content-center mb-3">
                                            <a href="{{ route('admin.apartments.show', $apartment->id) }}"
                                                class="btn-backoffice d-flex flex-column align-items-center txt-small"><i
                                                    class="fa-solid fa-circle-info mb-1"></i>
                                                <p class="mb-0 text-center">Dettagli</p>
                                            </a>
                                        </div>
                                        <div class="col-4 d-flex justify-content-center mb-3">
                                            <a href="{{ route('admin.apartments.edit', $apartment->id) }}"
                                                class="btn-backoffice d-flex flex-column align-items-center txt-small"><i
                                                    class="fa-regular fa-pen-to-square mb-1"></i>
                                                <p class="mb-0 text-center">Modifica</p>
                                            </a>
                                        </div>
                                        <div class="col-4 d-flex justify-content-center mb-3">
                                            <form action="{{ route('admin.apartments.destroy', $apartment->id) }}"
                                                method="POST" class="deleteForm">
                                                @method('DELETE')
                                                @csrf
                                                <button
                                                    class="btn-backoffice d-flex flex-column align-items-center txt-small"
                                                    type="submit"><i class="fa-regular fa-trash-can mb-1"></i>
                                                    <p class="mb-0 text-center">Elimina</p>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-4 d-flex justify-content-center mb-3">
                                            <a href="{{ route('admin.sponsorships.index', $apartment->id) }}"
                                                class="btn-backoffice d-flex flex-column align-items-center txt-small"><i
                                                    class="fa-regular fa-credit-card mb-1"></i>
                                                <p class="mb-0 text-center">Sponsorizza</p>
                                            </a>
                                        </div>
                                        <div class="col-4 d-flex justify-content-center mb-3">
                                            <a href="{{ route('admin.messages.index', $apartment->id) }}"
                                                class="btn-backoffice d-flex flex-column align-items-center txt-small">
                                                <i class="fa-regular fa-envelope mb-1"></i>
                                                @if ($new_messages_count)
                                                    <div class="messages-notification small text-center">
                                                        {{ $new_messages_count }}
                                                    </div>
                                                @endif
                                                <p class="mb-0 text-center">Messaggi</p></button>
                                            </a>
                                        </div>
                                        <div class="col-4 d-flex justify-content-center mb-3">
                                            <a href="{{ route('admin.statistics.index', $apartment->id) }}"
                                                class="btn-backoffice d-flex flex-column align-items-center txt-small"><i
                                                    class="fa-solid fa-chart-line mb-1"></i>
                                                <p class="mb-0 text-center">Statistiche</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@section('scripts')

@endsection

@endsection
