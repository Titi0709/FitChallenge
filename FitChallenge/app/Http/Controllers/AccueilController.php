<?php


namespace App\Http\Controllers;
use Inertia\Inertia;

use App\Models\Defi;
use App\Models\Programme;
use App\Models\ParticipationDefi;

class AccueilController extends Controller
{
    public function index()
    {
        $defis = Defi::latest()->take(5)->get();
        $programmes = Programme::latest()->take(5)->get();
        $challenges = ParticipationDefi::with('defi') // si besoin du nom du défi
                            ->latest()
                            ->take(5)
                            ->get();

        return Inertia::render('Accueil', [
            'defis' => $defis,
            'programmes' => $programmes,
            'challenges' => $challenges,
        ]);
    }
}
