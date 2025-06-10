<?php

namespace App\Http\Controllers;

use App\Models\Defi;
use App\Models\VideoDefi;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDefiRequest;

class DefisController extends Controller
{

    public function index()
    {
        $defis = Defi::where('statut', 'validé')->latest()->get();

        return Inertia::render('Defis', [
            'defis' => $defis,
        ]);
    }

        public function PageDefis()
    {
        return Inertia::render('PageDefis');
    }

    
    public function defiscreation(StoreDefiRequest $request)
    {   
        $validated = $request->validated();
        
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->back()->withErrors(['error' => 'Vous devez être connecté pour créer un défi.']);
        }
        
        $defi = Defi::create([
            ...$validated,
            'date_creation' => now(),
            'statut' => 'en cours',
            'prix' => '1',
            'id_utilisateur' =>  $userId, 
        ]);

        // $request->file('video') récupère le fichier uploadé (ici la vidéo)
        // store('videos', 'public') déplace le fichier uploadé dans le dossier storage/app/public/videos.

            $video = $request->file('video');
            $path = $video->store('videos', 'public');

            VideoDefi::create([
                'titre' => $video->getClientOriginalName(),
                'url' => $path,
                'id_defi' => $defi->id_defi,
            ]);



        return redirect()->back()->with('success', 'Défi en cours de validation');
    }
}
