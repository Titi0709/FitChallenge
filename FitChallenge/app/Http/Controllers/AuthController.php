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

public function showLogin()
{
    return Inertia::render('Login');
}


public function showRegister()
{
    return Inertia::render('Register');
}


public function login(LoginRequest $request)
{
    $credentials = $request->validated();

    $user = Utilisateur::where('email', $credentials['email'])->first();

    if ($user && Hash::check($credentials['mot_de_passe'], $user->mot_de_passe)) {
        Auth::login($user);
        return redirect('/')->with('success', 'Connection réussi !');
    }

    return back()->withErrors([
        'email' => 'Identifiants invalides.',
    ])->onlyInput('email');
}



public function register(RegisterRequest $request)
{
    $validated = $request->validated();

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


public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}
}