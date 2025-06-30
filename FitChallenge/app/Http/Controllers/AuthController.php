<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;
use Inertia\Inertia;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller

{

    public function afficherConnexion()
    {
        return Inertia::render('Login');
    }


    public function afficherInscription()
    {
        return Inertia::render('Register');
    }


    public function connexion(LoginRequest $request)
    {
         // Vérif des identifiants
        $credentials = $request->validated();

        $user = Utilisateur::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['mot_de_passe'], $user->mot_de_passe)) {
            // Connexion si OK
            Auth::login($user);
            return redirect('/')->with('success', 'Connection réussi !');
        }
         // Sinon erreur
        return back()->withErrors([
            'email' => 'Identifiants invalides.',
        ])->onlyInput('email');
    }



public function inscription(RegisterRequest $request)
{
    try {
        $validated = $request->validated();

        // throw new \Exception('Erreur forcée pour test');
        
        $user = Utilisateur::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'mot_de_passe' => Hash::make($validated['mot_de_passe']),
            'role' => 'utilisateur',
            'date_inscription' => now(),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Bienvenue dans la team !');

    } catch (\Exception ) {


        return back()->with('message', 'Une erreur est survenue pendant l’inscription. Veuillez réessayer plus tard.');

    }
}



    public function deconnexion(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/connexion');
    }
}
