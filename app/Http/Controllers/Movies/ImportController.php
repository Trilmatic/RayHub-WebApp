<?php

namespace App\Http\Controllers\Movies;

use App\Processes\ImportMoviesFromCsvProcess;
use Illuminate\Http\Request;

final class ImportController
{
    public function __construct(private readonly ImportMoviesFromCsvProcess $process)
    {
    }

    public function __invoke()
    {
        $payload = collect([]);
        $this->process->run($payload);

        return redirect()->back()->with('success');
    }
}
