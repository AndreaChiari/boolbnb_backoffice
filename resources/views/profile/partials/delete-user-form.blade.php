<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Elimina Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Una volta che il tuo Account sarà eliminato, tutti i suoi dati saranno permanentemente eliminati. Assicurati di salvare tutti i dati o le informazioni che desideri conservere.') }}
        </p>
    </header>

    <!-- Modal trigger button -->
    <button type="button" class="btn-backoffice bordered p-2 d-flex align-items-center justify-content-center fs-5"
        data-bs-toggle="modal" data-bs-target="#delete-account">
        {{ __('Elimina account') }}
    </button>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="delete-account" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="delete-account" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-account">Elimina Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Sei sicuro di voler cancellare il tuo Account?') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Una volta che il tuo Account sarà eliminato, tutti i suoi dati saranno permanentemente eliminati. Per favore inserisci la tua Password per confermare.') }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-backoffice bordered fs-5" data-bs-dismiss="modal">Annulla</button>

                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')


                        <div class="input-group">

                            <input id="password" name="password" type="password" class="form-control"
                                placeholder="{{ __('Password') }}" />

                            @error('password')
                                <span class="invalid-feedback mt-2" role="alert">
                                    <strong>{{ $errors->userDeletion->get('password') }}</strong>
                                </span>
                            @enderror



                            <button type="submit" class="btn btn-danger">
                                {{ __('Elimina Account') }}
                            </button>
                            <!--  -->
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</section>
