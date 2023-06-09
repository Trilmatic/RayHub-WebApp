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
        Schema::table('movie_genres_pivots', function (Blueprint $table) {
            $table->foreign('movie_genre_tmdb_id')->references('tmdb_id')->on('movie_genres')->onDelete('CASCADE');
            $table->foreign('movie_tmdb_id')->references('tmdb_id')->on('movies')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
