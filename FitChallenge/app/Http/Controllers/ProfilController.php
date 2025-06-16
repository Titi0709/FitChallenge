<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Inertia\Inertia;

class ProfilController extends Controller
{
    public function showProfil(Request $request)
    {
        $utilisateur = Utilisateur::find(auth()->id());
        return Inertia::render('Profil', [
            'utilisateur' => $utilisateur
        ]);
    }
}