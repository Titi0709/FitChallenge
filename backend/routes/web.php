<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return '✅ Connexion à MySQL OK';
    } catch (\Exception $e) {
        return '❌ Erreur MySQL : ' . $e->getMessage();
    }
});
