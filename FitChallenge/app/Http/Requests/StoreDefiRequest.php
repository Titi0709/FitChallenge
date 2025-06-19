<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreDefiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'titre' => 'required|string|max:50',
            'description' => 'required|string|max:500',
            'type_exercice' => 'required|string|max:50',
            'objectif' => 'required|string|max:100',
            'duree' => 'required|integer',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120', // max 5 Mo
            'video' => 'required|file|mimes:mp4,avi,mov|max:51200', // max 50 Mo
        ];
    }


    public function messages()
    {
        return [
            'titre.required' => 'Le titre est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'type_exercice.required' => 'Le type d\'exercice est obligatoire.',
            'objectif.required' => 'L\'objectif est obligatoire.',
            'duree.required' => 'La durée est obligatoire.',
            'image.required' => 'L\'image est obligatoire.',
            'prix.required' => 'Le prix est obligatoire.',
        ];
    }
}
