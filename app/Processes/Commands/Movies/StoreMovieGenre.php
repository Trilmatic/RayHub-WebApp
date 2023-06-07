<?php

namespace App\Processes\Commands\Movies;

use App\Models\Movies\MovieGenre;
use Illuminate\Support\Facades\DB;

final class StoreMovieGenre
{
    public function handle($genre)
    {
        return DB::transaction(
            callback: static fn () =>
            MovieGenre::create([
                'tmdb_id' => $genre['id'],
                'name' => $genre['name'],
            ]),
            attempts: 2,
        );
    }
}
