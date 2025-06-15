<?php

namespace App\Http\Controllers;

use App\Models\Defi;
use App\Models\VideoDefi;
use App\Models\ParticipationDefi;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDefiRequest;

class DefisController extends Controller
{

    public function Cataloguedefis()
    {
        $defis = Defi::where('statut', 'validé')->latest()->get();

        return Inertia::render('Cataloguedefis', [
            'defis' => $defis,
        ]);
    }

        public function CreateDefi()
    {
        return Inertia::render('CreateDefi');
    }

    
    public function defiscreation(StoreDefiRequest $request)
    {   
        $validated = $request->validated();
       
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->back()->withErrors(['error' => 'Vous devez être connecté pour créer un défi.']);
        }
          
        $imagePath = null;

        $image = $request->file('image');
        $imagePath = $image->store('images', 'public');

        $validated['image'] = $imagePath;
        
        $defi = Defi::create([
            ...$validated,
            'date_creation' => now(),
            'statut' => 'en cours',
            'prix' => '1',
            'id_utilisateur' =>  $userId, 
        ]);

            $video = $request->file('video');
            $path = $video->store('videos', 'public');

            VideoDefi::create([
                'titre' => $video->getClientOriginalName(),
                'url' => $path,
                'id_defi' => $defi->id_defi,
            ]);


         
            return redirect()->route('accueil')->with('message', 'Ton defis sera disponlibe dans les plus brefs délais après vérification du defis !');

    }

    public function showDefi($id)
    {
        $defi = Defi::findOrFail($id);
        $video = VideoDefi::where('id_defi', $defi->id_defi)->first();

        return Inertia::render('Defi', [
            'defi' => $defi,
            'video' => $video,
        ]);
    }


public function participer(Request $request)
{
    $request->validate([
        'id_defi' => 'required|exists:defi,id_defi',
    ]);

    $userId = Auth::id();


    $exists = ParticipationDefi::where('id_defi', $request->id_defi)
        ->where('id_utilisateur', $userId)
        ->exists();

    if ($exists) {
        
        $defi = Defi::findOrFail($request->id_defi);
        $video = VideoDefi::where('id_defi', $defi->id_defi)->first();

        return Inertia::render('Defi', [
            'defi' => $defi,
            'video' => $video,
            'error' => 'Vous participez déjà à ce défi.',

        ]);
    }

    ParticipationDefi::create([
        'date_debut' => now(),
        'statut' => 'en cours',
        'id_defi' => $request->id_defi,
        'id_utilisateur' => $userId,
    ]);

    return to_route('progression.show')->with('success', 'Défi rejoint avec succès !');
}

}
