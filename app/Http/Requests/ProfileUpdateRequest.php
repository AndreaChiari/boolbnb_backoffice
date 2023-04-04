<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'birth_date' => ['required', 'date']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il campo Username è obbligatorio',
            'name.string' => 'Il campo Username deve essere una stringa',
            'name.max' => 'Il campo Username deve essere lungo un massimo di 255 caratteri',
            'name.unique' => 'Lo Username scelto è già in uso',
            'email.required' => 'Il campo Email è obbligatorio',
            'email.string' => 'Il campo Email deve essere una stringa',
            'email.max' => 'Il campo Email deve essere lungo un massimo di 255 caratteri',
            'email.email' => 'Il campo Email deve avere un formato valido',
            'email.unique' => 'La tua Email è già presente',
            'first_name.required' => 'Il campo Nome è obbligatorio',
            'first_name.string' => 'Il campo Nome deve essere una stringa',
            'first_name.max' => 'Il campo Nome deve essere lungo un massimo di 50 caratteri',
            'last_name.required' => 'Il campo Cognome è obbligatorio',
            'last_name.string' => 'Il campo Cognome deve essere una stringa',
            'last_name.max' => 'Il campo Cognome deve essere lungo un massimo di 50 caratteri',
            'birth_date.required' => 'Il campo Data di nascita è obbligatorio',
            'birth_date.date' => 'Il formato del campo Data di nascita è errato'
        ];
    }
}
