<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255', 'unique:' . User::class],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'first_name' => ['required', 'string', 'max:50'],
                'last_name' => ['required', 'string', 'max:50'],
                'birth_date' => ['required', 'date']
            ],
            [
                'name.required' => 'Il campo Username è obbligatorio',
                'name.string' => 'Il campo Username deve essere una stringa',
                'name.max' => 'Il campo Username deve essere lungo un massimo di 255 caratteri',
                'name.unique' => 'Lo Username scelto è già in uso',
                'email.required' => 'Il campo Email è obbligatorio',
                'email.string' => 'Il campo Email deve essere una stringa',
                'email.max' => 'Il campo Email deve essere lungo un massimo di 255 caratteri',
                'email.email' => 'Il campo Email deve avere un formato valido',
                'email.unique' => 'La tua Email è già presente',
                'password.required' => 'Il campo Password è obbligatorio',
                'password.confirmed' => 'i campi Password e Conferma Password devono corrispondere',
                'first_name.required' => 'Il campo Nome è obbligatorio',
                'first_name.string' => 'Il campo Nome deve essere una stringa',
                'first_name.max' => 'Il campo Nome deve essere lungo un massimo di 50 caratteri',
                'last_name.required' => 'Il campo Cognome è obbligatorio',
                'last_name.string' => 'Il campo Cognome deve essere una stringa',
                'last_name.max' => 'Il campo Cognome deve essere lungo un massimo di 50 caratteri',
                'birth_date.required' => 'Il campo Data di nascita è obbligatorio',
                'birth_date.date' => 'Il formato del campo Data di nascita è errato'
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,

        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('admin.apartments.index');
    }
}
