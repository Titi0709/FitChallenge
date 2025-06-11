<?php


namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Defi;
use App\Models\Programme;
use App\Models\ParticipationDefi;

class AccueilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $defis = Defi::where('statut', 'validé')->latest()->take(5)->get();
        $programmes = Programme::latest()->take(5)->get();
        $challenges = ParticipationDefi::with('defi')
            ->where('id_utilisateur', Auth::id())
            ->latest()
            ->get();

        return Inertia::render('Accueil', [
            'defis' => $defis,
            'programmes' => $programmes,
            'challenges' => $challenges,
            'user' =>$user,
        ]);
    }
}
