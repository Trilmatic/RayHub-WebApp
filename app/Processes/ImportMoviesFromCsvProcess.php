<?php

namespace App\Processes;

use App\Processes\Process;
use App\Processes\Tasks\Movies\ImportMoviesFromCsvTask;

final class ImportMoviesFromCsvProcess extends Process
{
    protected array $tasks = [
        ImportMoviesFromCsvTask::class,
    ];
}
