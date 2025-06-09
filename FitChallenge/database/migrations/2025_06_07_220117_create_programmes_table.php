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
        Schema::create('programme', function (Blueprint $table) {
            $table->id('id_programme');
            $table->string('titre', 50);
            $table->string('description', 500);
            $table->string('type_exercice', 50);
            $table->string('objectif', 100);
            $table->integer('duree');
            $table->string('image', 500);
            $table->dateTime('date_creation');
            $table->integer('prix');
            $table->timestamps();

            $table->unsignedBigInteger('id_utilisateur');
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateur')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};