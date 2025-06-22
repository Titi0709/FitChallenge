<?php

namespace App\Http\Controllers;

use App\Models\Defi;
use App\Models\VideoDefi;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès réservé aux administrateurs.');
        }

        return Inertia::render('AdminIndex');
    }

    public function listeDefis()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès réservé aux administrateurs.');
        }

        $defis = Defi::where('statut', 'en cours')->get();
        return Inertia::render('AdminDefis', ['defis' => $defis]);
    }

    public function afficherDefi($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès réservé aux administrateurs.');
        }

        $defi = Defi::findOrFail($id);
        $video = VideoDefi::where('id_defi', $defi->id_defi)->first();

        return Inertia::render('AdminDefiAdmin', [
            'defi' => $defi,
            'video' => $video,
        ]);
    }

    public function supprimerDefi($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès réservé aux administrateurs.');
        }

        Defi::destroy($id);
        return back()->with('success', 'Défi supprimé !');
    }

    public function validerDefi($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Accès réservé aux administrateurs.');
        }

        $defi = Defi::findOrFail($id);
        $defi->statut = 'validé';
        $defi->save();

        return back()->with('success', 'Défi validé !');
    }
}
