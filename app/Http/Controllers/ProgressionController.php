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

    public function afficherProgression()
    {
        $userId = Auth::id();


        $participations = ParticipationDefi::with('defi')
            ->where('id_utilisateur', $userId)
            ->get();


        $mesDefis = Defi::where('id_utilisateur', $userId)->get();

        return Inertia::render('Progression', [
            'participations' => $participations,
            'mesDefis' => $mesDefis,
        ]);
    }


    public function modifierParticipation(Request $request, $id)
    {
        $participation = ParticipationDefi::findOrFail($id);
        $participation->statut = $request->statut;
        $participation->save();
        return back()->with('success', 'Statut mis à jour !');
    }

    public function supprimerParticipation($id)
    {
        $participation = ParticipationDefi::findOrFail($id);
        $participation->delete();
        return redirect()->route('progression.afficher')->with('success', 'Participation supprimée avec succès.');
    }

    public function supprimerDefi($id)
    {
        $defi = Defi::findOrFail($id);
        $defi->delete();
        return redirect()->route('progression.afficher')->with('success', 'Défi supprimé avec succès.');
    }
}
