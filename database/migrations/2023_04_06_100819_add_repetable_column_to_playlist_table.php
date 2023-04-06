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
        Schema::table('playlist', function (Blueprint $table) {
            $table->boolean('repeatable')->default(false);
            $table->boolean('taggable')->default(false);
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('playlist', function (Blueprint $table) {
            $table->dropColumn('repeatable');
            $table->dropColumn('taggable');
            $table->dropColumn('image');
        });
    }
};
