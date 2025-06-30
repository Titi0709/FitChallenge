<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DefisController;
use App\Http\Controllers\ProgressionController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AdminController;
use Inertia\Inertia;

Route::get('/', [AccueilController::class, 'index'])->name('accueil');


Route::get('/connexion', [AuthController::class, 'afficherConnexion'])->name('login');
Route::post('/connexion', [AuthController::class, 'connexion'])->name('connexion.tentative');
Route::get('/inscription', [AuthController::class, 'afficherInscription'])->name('inscription');
Route::post('/inscription', [AuthController::class, 'inscription'])->name('inscription.tentative');
Route::post('/deconnexion', [AuthController::class, 'deconnexion'])->name('deconnexion');


Route::get('/Cataloguedefis', [DefisController::class, 'Cataloguedefis'])->name('catalogue.defis');


Route::fallback(
    function () {
        return Inertia::render('EnTravaux');
    }
);

    // Vérif uti connecté avant accés routes
    Route::middleware(['auth'])->group(function () {

    Route::get('/creation-defi', [DefisController::class, 'creationDefi'])->name('defis.creation.afficher');
    Route::post('/defis', [DefisController::class, 'creerDefi'])->name('defis.creation');
    Route::get('/defi/{id}', [DefisController::class, 'afficherDefi'])->name('defis.afficher');
    Route::post('/defi/{id}/participer', [DefisController::class, 'participerDefi'])->name('defis.participer');

    Route::put('/participation/{id}', [ProgressionController::class, 'modifierParticipation']);
    Route::delete('/participation/{id}', [ProgressionController::class, 'supprimerParticipation'])->name('participation.supprimer');
    Route::delete('/defi/{id}', [ProgressionController::class, 'supprimerDefi'])->name('defis.supprimer');
    Route::get('/progression', [ProgressionController::class, 'afficherProgression'])->name('progression.afficher');

    Route::get('/profil', [ProfilController::class, 'afficherProfil'])->name('profil.afficher');
    Route::put('/profil/mot-de-passe', [ProfilController::class, 'modifierMotDePasse'])->name('profil.motdepasse');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.accueil');
    Route::get('/admin/defis', [AdminController::class, 'listeDefis'])->name('admin.defis');
    Route::get('/admin/defi/{id}', [AdminController::class, 'afficherDefi'])->name('admin.defis.afficher');

    Route::delete('/admin/defi/{id}', [AdminController::class, 'supprimerDefi'])->name('admin.defis.supprimer');
    Route::put('/admin/defi/{id}/valider', [AdminController::class, 'validerDefi'])->name('admin.defis.valider');
});
