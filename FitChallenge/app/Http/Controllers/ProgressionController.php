<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Defi;
use App\Models\ParticipationDefi;

class ProgressionController extends Controller
{

public function showprogression()
{
    $userId = Auth::id();

    // Défis où l'utilisateur participe
    $participations = ParticipationDefi::with('defi')
        ->where('id_utilisateur', $userId)
        ->get();

    // Défis créés par l'utilisateur
    $mesDefis = Defi::where('id_utilisateur', $userId)->get();

    return Inertia::render('Progression', [
        'participations' => $participations,
        'mesDefis' => $mesDefis,
    ]);
}


public function updateParticipation(Request $request, $id)
{
    $participation = ParticipationDefi::findOrFail($id);
    $participation->statut = $request->statut;
    $participation->save();
    return back()->with('success', 'Statut mis à jour !');
}

public function destroyParticipation($id)
{
    $participation = ParticipationDefi::findOrFail($id);
    $participation->delete();
    return back()->with('success', 'Participation abandonnée avec succès.');
}
    
}
