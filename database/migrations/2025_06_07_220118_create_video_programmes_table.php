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
        Schema::create('video_programme', function (Blueprint $table) {
            $table->id('id_video');
            $table->string('titre', 100);
            $table->string('url', 200); // corrigé ici aussi

            $table->unsignedBigInteger('id_programme');
            $table->foreign('id_programme')->references('id_programme')->on('programme')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_programmes');
    }
};