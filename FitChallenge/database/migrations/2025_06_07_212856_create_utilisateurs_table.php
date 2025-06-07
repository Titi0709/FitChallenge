<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->id('id_utilisateur'); // Clé primaire
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('email', 50)->unique();
            $table->string('mot_de_passe', 50);
            $table->string('role', 10); // valeur par défaut
            $table->dateTime('date_inscription');
            $table->timestamps(); // created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateur');
    }
};