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
        Schema::create('defi', function (Blueprint $table) {
            $table->id('id_defi');
            $table->string('titre', 50);
            $table->string('description', 500);
            $table->string('type_exercice', 50);
            $table->string('objectif', 100);
            $table->integer('duree');
            $table->string('image', 500);
            $table->dateTime('date_creation');
            $table->integer('prix');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defis');
    }
};
