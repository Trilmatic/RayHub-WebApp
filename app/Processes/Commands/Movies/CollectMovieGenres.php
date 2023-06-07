<?php

namespace App\Processes\Commands\Movies;

use Illuminate\Support\Facades\Http;

final class CollectMovieGenres
{
    public function handle()
    {
        $response = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=' . env('TMDB_KEY'));
        return $response->collect()->get('genres');
    }
}
