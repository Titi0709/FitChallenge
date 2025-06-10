<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nom' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/u',
            ],
            'prenom' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/u',
            ],
            'email' => [
                'required',
                'email',
                'max:50',
                'unique:utilisateur,email',
            ],
            'mot_de_passe' => ['required', 'min:6', 'confirmed'],
        ];
    }
        public function messages()
    {
        return [
            'nom.regex' => 'Le nom ne doit contenir que des lettres et des espaces.',
            'prenom.regex' => 'Le prénom ne doit contenir que des lettres et des espaces.',
            'email.unique' => 'Cet email est déjà utilisé.',
        ];
    }
}


