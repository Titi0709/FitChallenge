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
        Schema::create('message', function (Blueprint $table) {
            $table->id('id_message');
            $table->string('contenu', 500);
            $table->dateTime('date_envoi');

            $table->unsignedBigInteger('id_utilisateur_envoyeur');
            $table->unsignedBigInteger('id_utilisateur_receveur');

            $table->foreign('id_utilisateur_envoyeur')->references('id_utilisateur')->on('utilisateur')->onDelete('cascade');
            $table->foreign('id_utilisateur_receveur')->references('id_utilisateur')->on('utilisateur')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};