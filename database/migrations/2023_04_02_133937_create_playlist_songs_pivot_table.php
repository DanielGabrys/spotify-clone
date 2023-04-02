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
        Schema::create('playlist_songs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("song_id")->unsigned();
            $table->bigInteger("playlist_id")->unsigned();
            $table->timestamps();

            $table->foreign('song_id')->references('id')->on('song')->onDelete('cascade');
            $table->foreign('playlist_id')->references('id')->on('playlist')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlist_songs');
    }
};
