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


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/Cataloguedefis', [DefisController::class, 'Cataloguedefis'])->name('catalogue.defis');


Route::fallback(
    function () {
        return Inertia::render('EnTravaux');
    }
);

Route::middleware(['auth'])->group(function () {

    Route::get('/CreateDefi', [DefisController::class, 'CreateDefi'])->name('create.defi');
    Route::post('/defis-creation', [DefisController::class, 'defiscreation'])->name('defis.creation');
    Route::get('/defi/{id}', [DefisController::class, 'showDefi'])->name('defi.show');
    Route::post('/participation-defi', [DefisController::class, 'participer'])->name('defi.participer');


    Route::put('/participation-defi/{id}', [ProgressionController::class, 'updateParticipation']);
    Route::delete('/participation-defi/{id}', [ProgressionController::class, 'destroyParticipation'])->name('participation.destroy');
    Route::delete('/defi/{id}', [ProgressionController::class, 'destroyDefis'])->name('defi.destroy');
    Route::get('/progression', [ProgressionController::class, 'showprogression'])->name('progression.show');

    Route::get('/profil', [ProfilController::class, 'showprofil'])->name('profil.show');
    Route::put('/profil/update-password', [ProfilController::class, 'updatePassword'])->name('profil.update-password');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/defi', [AdminController::class, 'defis'])->name('admin.defis');
    Route::get('/admin/defisadmin/{id}', [AdminController::class, 'showDefi'])->name('admin.defisadmin');
    // Actions
    Route::delete('/admin/defi/{id}', [AdminController::class, 'deleteDefi'])->name('admin.defi.delete');
    Route::put('/admin/defi/{id}/valider', [AdminController::class, 'validerDefi'])->name('admin.defi.valider');
});
