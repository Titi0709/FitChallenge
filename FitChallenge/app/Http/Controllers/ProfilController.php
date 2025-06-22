<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;
use Inertia\Inertia;


class ProfilController extends Controller
{
    public function afficherProfil()
    {
        return Inertia::render('Profil');
    }


    public function modifierMotDePasse(UpdatePasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->mot_de_passe)) {
            return back()->withErrors(['old_password' => 'Ancien mot de passe incorrect.']);
        }

        $user->mot_de_passe = bcrypt($request->new_password);

        $user->save();

        return to_route('profil.afficher')->with('success', 'Mot de passe modifié avec succès !');
    }
}
