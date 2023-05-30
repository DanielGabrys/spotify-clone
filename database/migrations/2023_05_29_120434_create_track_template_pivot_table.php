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
        Schema::create('track_template_pivot', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("template_id")->unsigned();
            $table->bigInteger("tag_id")->unsigned();

            $table->foreign('template_id')->references('id')->on('template')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_template');
    }
};
