@if ($apartment->exists)
    <form action="{{ route('admin.apartments.update', $apartment->id) }}" method="POST" class="text-white"
        enctype="multipart/form-data">
        @method('PUT')
    @else
        <form action="{{ route('admin.apartments.store') }}" method="POST" class="text-white" enctype="multipart/form-data"
            novalidate>
@endif
@csrf

<div>
    <label for="price">Prezzo:</label>
    <input type="text" name="price" id="price" required>
</div>
<div>
    <label for="rooms">Stanze:</label>
    <input type="number" name="rooms" id="rooms" required>
</div>
<div>
    <label for="beds">Letti:</label>
    <input type="number" name="beds" id="beds">
</div>
<div>
    <label for="bathrooms">Bagni:</label>
    <input type="number" name="bathrooms" id="bathrooms" required>
</div>
<div>
    <label for="square_meters">Metri quadrati:</label>
    <input type="number" name="square_meters" id="square_meters">
</div>
<div>
    <label for="address">Indirizzo:</label>
    <input type="text" name="address" id="address" required>
</div>

{{-- Immagine --}}
<div class="col-md-7">
    <div class="mb-3">
        <label for="thumb" class="form-label">Immagine</label>
        <input type="file" name="thumb" id="thumb" class="form-control @error('thumb') is-invalid @enderror"
            value="{{ old('thumb', $apartment->thumb) }}">
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
<div class="col-md-1">
    <img class="img-fluid" id="img-preview"
        src="{{ $apartment->thumb ? asset('storage/' . $apartment->thumb) : 'https://marcolanci.it/utils/placeholder.jpg' }}"
        alt="">
</div>
<div>
    <label for="description">Descrizione:</label>
    <textarea name="description" id="description"></textarea>
</div>
<div>
    <label for="visibility">Visibilità:</label>
    <input type="checkbox" name="visibility" id="visibility" value="1">
</div>
 {{-- Servizi --}}
    <div class="row mb-5">
        <div class="col-10">
            {{-- @foreach ($ as $) --}}
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="tag-{{ $loop->iteration }}"
                        value="{{ $->id }}" name="s[]" @if (in_array($->id, old('s', $apartment_s ?? []))) checked @endif>
                    <label class="form-check-label" for="-{{ $loop->iteration }}">{{ $->label }}</label>
                </div>
            @endforeach
            @error('')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
{{-- Bottone --}}
<footer class="d-flex justify-content-between mb-3">
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
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('img-preview');

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
@endsection
