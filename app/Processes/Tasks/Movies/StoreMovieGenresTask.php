<?php

namespace App\Processes\Tasks\Movies;

use App\Models\Movies\MovieGenre;
use App\Processes\Commands\Movies\StoreMovieGenre;
use Closure;

final class StoreMovieGenresTask
{
    public function __construct(private readonly StoreMovieGenre $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        foreach ($payload->get('genres') as $genre) {
            if (!MovieGenre::where(
                'tmdb_id',
                $genre['id']
            )->exists()) {
                $this->command->handle($genre);
            }
        }

        return $next($payload);
    }
}
