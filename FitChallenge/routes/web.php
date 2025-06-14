<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DefisController;

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

});