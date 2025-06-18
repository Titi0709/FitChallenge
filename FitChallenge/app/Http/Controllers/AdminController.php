<?php
namespace App\Http\Controllers;

use App\Models\Defi;
use App\Models\VideoDefi;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('AdminIndex');
    }

    public function defis()
    {
        $defis = Defi::where('statut', 'en cours')->get();
        return Inertia::render('AdminDefis', ['defis' => $defis]);
    }

    public function showDefi($id)
    {
        $defi = Defi::findOrFail($id);
        $video = VideoDefi::where('id_defi', $defi->id_defi)->first();
        return Inertia::render('AdminDefiAdmin', [
            'defi' => $defi,
            'video' => $video,
        ]);
    }

    public function deleteDefi($id)
    {
        Defi::destroy($id);
        return back()->with('success', 'Défi supprimé !');
    }

    public function validerDefi($id)
    {
        $defi = Defi::findOrFail($id);
        $defi->statut = 'validé';
        $defi->save();
        return back()->with('success', 'Défi validé !');
    }
}