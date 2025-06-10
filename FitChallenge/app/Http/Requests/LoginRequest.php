<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'max:100',
                'regex:/^[^\'";\\\s<>]+@[^\'";\\\s<>]+\.[a-zA-Z]{2,}$/',
            ],
            'mot_de_passe' => [
                'required',
                'string',
                'min:6',
                'max:50',
                'regex:/^[^\'";\\<>]+$/',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.regex' => 'Le format de l\'email est invalide.',
            'mot_de_passe.regex' => 'Le mot de passe contient des caractères interdits.',
        ];
    }
}