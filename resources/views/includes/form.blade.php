@if ($apartment->exists)
    <form action="{{ route('admin.apartments.update', $apartment->id) }}" method="POST" class="container"
        enctype="multipart/form-data">
        @method('PUT')
    @else
        <form action="{{ route('admin.apartments.store') }}" method="POST" class="container" enctype="multipart/form-data"
            novalidate>
@endif
@csrf
<div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label" for="price">Prezzo:</label>
            <input  class="form-control" type="text" name="price" id="price" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label" for="rooms">Stanze:</label>
            <input class="form-control" type="number" name="rooms" id="rooms" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label" for="beds">Letti:</label>
            <input class="form-control" type="number" name="beds" id="beds">
        </div>
    </div>
    <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label" for="square_meters">Metratura:</label>
            <input class="form-control" type="number" name="square_meters" id="square_meters">
        </div>
    </div>
        <div class="col-md-2">
        <div class="mb-3">
            <label class="form-label" for="bathrooms">Bagni:</label>
            <input class="form-control" type="number" name="bathrooms" id="bathrooms">
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label" for="address">Indirizzo:</label>
            <input class="form-control" class="" type="text" name="address" id="address" required>
        </div>
    </div>
    {{-- Immagine --}}
<div class="col-md-10">
    <div class="mb-3">
        <label for="thumb" class="form-label">Immagine</label>
        <input class="form-control" type="file" name="thumb" id="thumb" class="form-control @error('thumb') is-invalid @enderror"
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
<div class="col-md-2">
    <img class="img-fluid" id="thumb-preview"
        src="{{ $apartment->thumb ? asset('storage/' . $apartment->thumb) : 'https://marcolanci.it/utils/placeholder.jpg' }}"
        alt="">
</div>
{{-- Descrizione --}}
<div class="col-md-12">
    <label class="form-label" for="description">Descrizione:</label>
    <textarea class="form-control" name="description" id="description" cols="100" rows="5"></textarea>
</div>
<div class="my-3">
    <label for="visibility">Visibilità:</label>
    <input  type="checkbox" name="visibility" id="visibility" value="1">
</div>
</div>





<div class="row align-items-center">

 {{-- Servizi --}}
    {{-- <div class="row mb-5">
        <div class="col-10">
            @foreach ($ as $)
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
    </div> --}}
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
@endsection
