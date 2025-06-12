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


            

         return back();


    }
}
