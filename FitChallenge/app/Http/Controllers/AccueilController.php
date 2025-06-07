<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccueilController extends Controller
{
        public function accueil()
    {
        return Inertia::render('Accueil'); 
    }
}
