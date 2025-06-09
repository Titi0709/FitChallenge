<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;
use Inertia\Inertia;

class AuthController extends Controller 

{

public function showLogin()
{
    return Inertia::render('Login');
}


public function showRegister()
{
    return Inertia::render('Register');
}


public function login(Request $request)
{
    $credentials = $request->validate([
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
    ], [
        'email.regex' => 'Le format de l\'email est invalide.',
        'mot_de_passe.regex' => 'Le mot de passe contient des caractères interdits.',
    ]);

    $user = Utilisateur::where('email', $credentials['email'])->first();

    if ($user && Hash::check($credentials['mot_de_passe'], $user->mot_de_passe)) {
        Auth::login($user);
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'Identifiants invalides.',
    ])->onlyInput('email');
}



public function register(Request $request)
{
    $validated = $request->validate([
        'nom' => [
            'required',
            'string',
            'max:50',
            'regex:/^[a-zA-ZÀ-ÿ\s]+$/u', // lettres + espaces uniquement
        ],
        'prenom' => [
            'required',
            'string',
            'max:50',
            'regex:/^[a-zA-ZÀ-ÿ\s]+$/u', // lettres + espaces uniquement
        ],
        'email' => [
            'required',
            'email',
            'max:50',
            'unique:utilisateur,email',
        ],
        'mot_de_passe' => ['required', 'min:6', 'confirmed'],
    ]);

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
}


// Déconnexion
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}
}