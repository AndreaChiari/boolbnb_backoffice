@extends('layouts.app')

@section('title', $apartment->address)

@section('content')
    <div id="apartment-show" class="container my-5">
        <div class="card container-detail-main">
            <div class="row g-0 container-main">
                <div class="col-md-4">
                    <figure class="text-center h-100">
                        <img src="{{ $apartment->getThumbUrl() }}" alt="{{ $apartment->address }}"
                            class="img-fluid h-100 detail-main-img" style="object-fit: cover;">
                        <div class="overlay p-3">
                            <span class="views d-flex align-items-center"><i class="fa-solid fa-eye me-2"></i>
                                {{ count($apartment->views) }}</span>
                            @if ($apartment->isSponsored())
                                <div class="sponsored d-flex justify-content-evenly px-2"><span> SPONSORED
                                    </span>
                                    @include('includes.timer')
                                </div>
                            @endif

                        </div>
                    </figure>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="row flex-column flex-lg-row align-items-center mb-4">
                            <h1
                                class="card-title col-12 col-lg-8 col-xl-9 mb-3 mb-lg-0 d-flex justify-content-center justify-content-lg-start">
                                {{ $apartment->name }}</h1>
                            <form
                                class="col-12 col-lg-4 col-xl-3 visibility d-flex align-items-center justify-content-center justify-content-lg-end"
                                method="POST" action="{{ route('admin.apartments.toggle-visibility', $apartment->id) }}">
                                @method('PATCH')
                                @csrf
                                <p class="mb-2 text-color-main">Visibilità</p>
                                <button class="btn-backoffice py-2 px-3">
                                    @if ($apartment->visibility)
                                        <i class="fa-regular fa-eye"></i>
                                    @else
                                        <i class="fa-regular fa-eye-slash"></i>
                                    @endif
                                </button>
                            </form>
                        </div>
                        <p class="address card-text">{{ $apartment->address }}</p>
                        <p class="description card-text">{{ $apartment->description }}</p>
                        <div
                            class="details d-flex align-items-center text-center justify-content-evenly mx-5 mb-3 pt-3 text-wrap">
                            <div class="flex-fill">
                                <div class="detail-box mb-2">
                                    <i class="fa-solid fa-person-shelter fa-2x"></i>
                                    <div class="number">{{ $apartment->rooms }}</div>
                                </div>
                                <p class="text-color-secondary">Stanze</p>
                            </div>
                            <div class="flex-fill">
                                <div class="detail-box mb-2">
                                    <i class="fa-solid fa-bed fa-2x"></i>
                                    <div class="number">{{ $apartment->beds }}</div>
                                </div>
                                <p class="text-color-secondary">Letti</p>
                            </div>
                            <div class="flex-fill">
                                <div class="detail-box mb-2">
                                    <i class="fa-solid fa-restroom fa-2x"></i>
                                    <div class="number">{{ $apartment->bathrooms }}</div>
                                </div>
                                <p class="text-color-secondary">Bagni</p>
                            </div>
                        </div>

                        @if (count($apartment->services))
                            <div class="services row justify-content-center mx-2 border-secondary-color rounded-5 p-3 mb-3">
                                <h5 class="text-center mb-5">Servizi</h5>
                                @foreach ($apartment->services as $service)
                                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center">
                                        <i class="{{ $service->icon }} my-3 fa-2x"></i>
                                        <p class="mb-0">{{ $service->name }}</p>
                                    </div>
                                @endforeach
                            </div>

                        @endif
                        <p class="card-text price fw-bold fs-4">{{ $apartment->price }} € / notte</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="images container">
        <div class="row">
            @forelse ($apartment->apartmentPics as $pic)
                <form action="{{ route('admin.apartment-pics.destroy', $pic->id) }}" method="POST"
                    class="additional-img col-6 col-md-4 col-xl-2 d-flex justify-content-center align-items-center mb-3">
                    @method('DELETE')
                    @csrf
                    <img src="{{ asset('storage/' . $pic->thumb) }}" alt="{{ $pic->id }}">
                    <button class="btn-backoffice" type="submit"><i class="fa-regular fa-trash-can"></i></button>
                </form>
            @empty
            @endforelse
            <form class="col-6 col-md-4 col-xl-2 mb-3" action="{{ route('admin.apartment-pics.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div id="img-loader" class="d-flex justify-content-center align-items-center">
                    <i class="fa-solid fa-plus fa-2x"></i>
                </div>
                <input name="thumb" id="add-image" type="file" class="d-none">
                <input name="apartment_id" type="hidden" value="{{ $apartment->id }}">
                <button id="load-button" class="d-none btn-backoffice bordered">Carica Immagine</button>
            </form>
        </div>
    </div>


    {{-- Bottoni --}}
    <div class="container buttons d-flex my-5 justify-content-end align-items-center">
        <a class="btn-backoffice py-2 px-1 me-3" href="{{ route('admin.messages.index', $apartment->id) }}">
            <i class="fa-solid fa-envelope"></i>
            @if ($new_messages)
                <p class="messages-notification text-center">{{ $new_messages }}</p>
            @endif
        </a>
        <a href="{{ route('admin.sponsorships.index', $apartment->id) }}" class="btn-backoffice py-2 px-1 me-3"><i
                class="fa-regular fa-credit-card"></i></a>
        <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn-backoffice py-2 px-1 me-3"><i
                class="fa-regular fa-pen-to-square"></i></a>
        <a href="{{ route('admin.statistics.index', $apartment->id) }}" class="btn-backoffice"><i
                class="fa-solid fa-chart-line me-3"></i></a>
        <form class="deleteForm" action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn-backoffice py-2 px-1 me-5" type="submit"><i class="fa-regular fa-trash-can"></i></button>
        </form>
        <a class="btn-backoffice bordered p-2 d-flex align-items-center justify-content-center"
            href="{{ route('admin.apartments.index') }}"><i class="fa-solid fa-arrow-left"></i></a>
    </div>
@endsection

@section('scripts')
    <script>
        const imgLoader = document.getElementById('img-loader');
        const imgInput = document.getElementById('add-image');
        const submitForm = document.getElementById('submit-img');
        const loadButton = document.getElementById('load-button');
        imgLoader.addEventListener('click', () => {
            imgInput.click()
        })

        // Ascolto il cambio del caricamento file
        imgInput.addEventListener('change', () => {
            // Controllo se ho caricato un file
            if (imgInput.files && imgInput.files[0]) {
                const reader = new FileReader();
                reader.readAsDataURL(imgInput.files[0])

                // Quando sei pronto (ossia quando ha preparato il dato, promemoria: onload è un 'addeventlistener')
                reader.onload = e => {
                    imgLoader.innerHTML = `<img src="${e.target.result}" alt="preview">`;
                    loadButton.classList.remove('d-none');
                }

            } else {
                imgLoader.innerHTML = `<i class="fa-solid fa-plus fa-2x"></i>`;
                loadButton.classList.add('d-none');
            }
        })
    </script>
@endsection
