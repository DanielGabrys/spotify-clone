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
        Schema::create('song_tag', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("song_id")->unsigned();
            $table->bigInteger("tag_id")->unsigned();

            $table->foreign('song_id')->references('id')->on('song')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_song_tag');
    }
};
