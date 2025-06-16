<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DefisController;
use App\Http\Controllers\ProgressionController;
use App\Http\Controllers\ProfilController;

Route::get('/', [AccueilController::class, 'index'])->name('accueil');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/Cataloguedefis', [DefisController::class, 'Cataloguedefis'])->name('catalogue.defis');



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

});