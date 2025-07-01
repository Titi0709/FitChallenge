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
        Schema::create('video_defi', function (Blueprint $table) {
            $table->id('id_video');
            $table->string('titre', 100);
            $table->string('url', 200); // j’ai mis VARCHAR(200) car `url` ne doit pas être `int` comme sur ton MLD

            // Clé étrangère vers défi
            $table->unsignedBigInteger('id_defi');
            $table->foreign('id_defi')->references('id_defi')->on('defi')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_defis');
    }
};