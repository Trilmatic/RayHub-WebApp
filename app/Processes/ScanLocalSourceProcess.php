<?php

namespace App\Processes;

use App\Processes\Process;
use App\Processes\Tasks\ScanLocalSourceTask;
use App\Processes\Tasks\StoreSourceFilesTask;
use App\Processes\Tasks\StoreSourceTask;

final class ScanLocalSourceProcess extends Process
{
    protected array $tasks = [
        ScanLocalSourceTask::class,
        StoreSourceTask::class,
        StoreSourceFilesTask::class,
    ];
}
