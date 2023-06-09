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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tmdb_id')->unique()->index();
            $table->text('title')->index();
            $table->date('release_date')->nullable();
            $table->text('overview')->nullable();
            $table->string('original_language')->nullable();
            $table->float('popularity')->nullable();
            $table->integer('runtime')->nullable();
            $table->string('status');
            $table->text('tagline')->nullable();
            $table->float('vote_average')->nullable();
            $table->integer('vote_count')->nullable();
            $table->text('poster_path')->nullable();
            $table->text('backdrop_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
