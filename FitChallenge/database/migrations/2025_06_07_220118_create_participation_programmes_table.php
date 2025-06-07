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
        Schema::create('participation_programme', function (Blueprint $table) {
            $table->id('id_participation');
            $table->dateTime('date_debut');
            $table->string('statut', 10);

            $table->unsignedBigInteger('id_programme');
            $table->unsignedBigInteger('id_utilisateur');

            $table->foreign('id_programme')->references('id_programme')->on('programme')->onDelete('cascade');
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateur')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participation_programmes');
    }
};