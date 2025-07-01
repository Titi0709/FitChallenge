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
        Schema::create('badge_obtention', function (Blueprint $table) {
            $table->id('id_badge_obtention');
            $table->dateTime('date_obtention');

            $table->unsignedBigInteger('id_utilisateur');
            $table->unsignedBigInteger('id_badge');

            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateur')->onDelete('cascade');
            $table->foreign('id_badge')->references('id_badge')->on('badge')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badge_obtentions');
    }
};