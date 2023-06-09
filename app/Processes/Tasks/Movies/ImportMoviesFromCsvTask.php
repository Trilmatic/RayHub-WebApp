<?php

namespace App\Processes\Tasks\Movies;

use App\Imports\MoviesImport;
use Closure;
use Maatwebsite\Excel\Facades\Excel;

final class ImportMoviesFromCsvTask
{
    public function __invoke($payload, Closure $next): mixed
    {
        $import = Excel::import(new MoviesImport, "static/movies.csv");
        //dd($import);
        return $next($payload);
    }
}
