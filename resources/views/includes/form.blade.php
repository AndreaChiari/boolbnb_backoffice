@if ($apartment->exists)
    <form id="form" action="{{ route('admin.apartments.update', $apartment->id) }}" method="POST" class="container"
        enctype="multipart/form-data">
        @method('PUT')
    @else
        <form id="form" action="{{ route('admin.apartments.store') }}" method="POST" class="container"
            enctype="multipart/form-data" novalidate>
@endif
@csrf
<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="price">Prezzo:</label>
            <input class="form-control" type="number" name="price" id="price" required min="0"
                value="{{ old('title', $apartment->price) }}">
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label" for="rooms">Stanze:</label>
            <input class="form-control" type="number" name="rooms" id="rooms" min="1"
                value="{{ old('title', $apartment->rooms) }}">
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label" for="beds">Letti:</label>
            <input class="form-control" type="number" name="beds" id="beds" min="1"
                value="{{ old('title', $apartment->beds) }}">
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label" for="square_meters">Metratura:</label>
            <input class="form-control" type="number" name="square_meters" id="square_meters" min="1"
                value="{{ old('title', $apartment->square_meters) }}">
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label" for="bathrooms">Bagni:</label>
            <input class="form-control" type="number" name="bathrooms" id="bathrooms" min="0"
                value="{{ old('title', $apartment->bathrooms) }}">
        </div>
    </div>
    <div class="col-md-12 address-container">
        <div class="mb-3">
            <label class="form-label" for="address">Indirizzo:</label>
            <input class="form-control" class="" type="text" name="address" id="address" required
                value="{{ old('title', $apartment->address) }}" onkeyup="fetchApiSearch()">
            <div class="address-error text-danger d-none">Il campo è errato</div>
            <ul id="suggestions" class="d-none border rounded-2 list-unstyled">


            </ul>
        </div>
    </div>

    {{-- Immagine --}}
    <div class="col-md-10">
        <div class="mb-3">
            <label for="thumb" class="form-label">Immagine</label>
            <input type="file" name="thumb" id="thumb"
                class="form-control @error('thumb') is-invalid @enderror" value="{{ old('thumb', $apartment->thumb) }}">
            @error('thumb')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @else
                <div class="text-muted">Inserisci l'immagine</div>
            @enderror
        </div>
    </div>

    {{-- Anteprima immagine --}}
    <div class="col-md-2">
        <img class="img-fluid shadow" id="thumb-preview"
            src="{{ $apartment->thumb ? $apartment->getThumbUrl() : 'https://marcolanci.it/utils/placeholder.jpg' }}"
            alt="">
    </div>
    {{-- Descrizione --}}
    <div class="col-md-12 mb-3">
        <label class="form-label" for="description">Descrizione:</label>
        <textarea class="form-control" name="description" id="description" cols="100" rows="5">{{ old('title', $apartment->description) }}</textarea>
    </div>
    {{-- Servizi --}}
    <div class="col-md-12">
        <label class="form-label">Servizi:</label>
        <div class="services border rounded-2 p-3 mb-3">
            <div class="row">
                @foreach ($services as $service)
                    <div class="col-6 mb-2">
                        <input class="form-check-input" type="checkbox" value="{{ $service->id }}"
                            id="{{ $service->id }}" name="services[]"
                            @if (in_array($service->id, old('services', $apartment_services ?? []))) checked @endif>
                        <label class="form-check-label" for="{{ $service->id }}">{{ $service->name }}</label>
                        <i class="{{ $service->icon }}"></i>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="my-3">
        <label for="visibility">Visibilità:</label>
        <input type="checkbox" name="visibility" id="visibility" value="1">
    </div>
</div>


{{-- Bottone --}}
<footer class=" d-flex justify-content-between mb-3">
    <a href="{{ route('admin.apartments.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <button type="submit" class="btn btn-success">
        <i class="fa-solid fa-floppy-disk"></i>
    </button>
</footer>
</form>



@section('scripts')
    {{-- ! Script per la gestione dell'anteprima immagine --}}
    <script>
        // Creo una constante d'appoggio
        const placeholder = 'https://marcolanci.it/utils/placeholder.jpg';

        // Prendo gli elementi dal dom
        const imageInput = document.getElementById('thumb');
        const imagePreview = document.getElementById('thumb-preview');

        // Ascolto il cambio del caricamento file
        imageInput.addEventListener('change', () => {
            // Controllo se ho caricato un file
            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();
                reader.readAsDataURL(imageInput.files[0])

                // Quando sei pronto (ossia quando ha preparato il dato, promemoria: onload è un 'addeventlistener')
                reader.onload = e => {
                    imagePreview.src = e.target.result;
                }

            } else imagePreview.src = placeholder;
        })
    </script>
    <script>
        const addressInput = document.getElementById('address');
        const suggestionsField = document.getElementById('suggestions');
        const form = document.getElementById('form');
        const alert = document.querySelector('.address-error');
        let suggestions = [];
        const fetchApiSearch = () => {
            if (addressInput.value) {
                suggestionsField.classList.remove('d-none');
                suggestionsField.scrollTo(0, 0);
                axios.get(
                        `https://api.tomtom.com/search/2/search/${addressInput.value}.json?key=lCdijgMp1lmgVifAWwN8K9Jrfa9XcFzm`
                    )
                    .then(res => {
                        suggestions = [];
                        let suggestionList = '';
                        res.data.results.forEach(result => {
                            suggestions.push(result.address.freeformAddress);
                        });
                        suggestions.forEach(suggestion => {
                            suggestionList +=
                                `<li class="suggestion-element border-top p-2">${suggestion}</li>`;
                        })
                        suggestionsField.innerHTML = suggestionList;
                        const suggestionElements = document.querySelectorAll('.suggestion-element');
                        suggestionElements.forEach(element => {
                            element.addEventListener('click', () => {
                                addressInput.value = element.innerText;
                                suggestionsField.classList.add('d-none');
                            })
                        })

                    })
            }
        }
        form.addEventListener('submit', (e) => {
            console.log('ciao');
            e.preventDefault();
            if (suggestions.includes(addressInput.value)) form.submit();
            else alert.classList.remove('d-none') & suggestionsField.classList.add('d-none');
        })

        window.addEventListener('click', () => suggestionsField.classList.add('d-none'));
    </script>
@endsection
