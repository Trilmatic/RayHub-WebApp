<?php

namespace App\Processes;

use App\Processes\Process;
use App\Processes\Tasks\Movies\CollectMovieGenresTask;
use App\Processes\Tasks\Movies\StoreMovieGenresTask;

final class SyncMovieGenresProcess extends Process
{
    protected array $tasks = [
        CollectMovieGenresTask::class,
        StoreMovieGenresTask::class,
    ];
}
