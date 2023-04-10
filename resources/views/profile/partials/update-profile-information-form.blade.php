<section>
    <header>
        <h2>
            {{ __('Informazioni del Profilo') }}
        </h2>

        <p class="mt-1">
            {{ __('Aggiorna le informazioni del tuo Profilo e il tuo Indirizzo Email.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" novalidate>
        @csrf
        @method('patch')


        <div class="mb-2">
            <label for="name">{{ __('Username') }}</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name"
                autocomplete="name" value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-2">
            <label for="email">
                {{ __('Email') }}
            </label>

            <input id="email" name="email" type="email"
                class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}"
                required autocomplete="username" />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-muted">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-outline-dark">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                </div>
            @endif
        </div>

        <div class="mb-2">
            <label for="first_name">{{ __('Nome') }}</label>
            <input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name"
                id="first_name" value="{{ old('first_name', $user->first_name) }}" required autofocus>
            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-2">
            <label for="last_name">{{ __('Cognome') }}</label>
            <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name"
                id="last_name" value="{{ old('last_name', $user->last_name) }}" required autofocus>
            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-2">
            <label for="birth_date">{{ __('Data di nascita') }}</label>
            <input class="form-control @error('birth_date') is-invalid @enderror" type="date" name="birth_date"
                id="birth_date" value="{{ old('birth_date', $user->birth_date) }}" required autofocus>
            @error('birth_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-4">
            <button class="btn-backoffice bordered p-2 d-flex align-items-center justify-content-center"
                type="submit"><i class="fa-regular fa-floppy-disk"></i></button>

            @if (session('status') === 'profile-updated')
                <script>
                    const show = true;
                    setTimeout(() => show = false, 2000)
                    const el = document.getElementById('profile-status')
                    if (show) {
                        el.style.display = 'block';
                    }
                </script>
                <p id='profile-status' class="fs-5 text-muted">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
