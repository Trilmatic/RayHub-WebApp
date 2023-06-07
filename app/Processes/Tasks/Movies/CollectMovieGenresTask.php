<?php

namespace App\Processes\Tasks\Movies;

use App\Processes\Commands\Movies\CollectMovieGenres;
use Closure;

final class CollectMovieGenresTask
{
    public function __construct(private readonly CollectMovieGenres $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $genres = $this->command->handle();
        $payload->put('genres', $genres);
        return $next($payload);
    }
}
