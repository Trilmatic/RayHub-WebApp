<?php

namespace App\Processes;

use Illuminate\Pipeline\Pipeline;

abstract class Process
{
    protected array $tasks = [];

    public function run(object $payload)
    {
        return app(Pipeline::class)->send(passable: $payload,)
            ->through(pipes: $this->tasks,)
            ->thenReturn();
    }
}
