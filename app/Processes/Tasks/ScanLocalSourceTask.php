<?php

namespace App\Processes\Tasks;

use App\Processes\Commands\ScanLocalSource;
use Closure;

final class ScanLocalSourceTask
{
    public function __construct(private readonly ScanLocalSource $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $payload = $this->command->handle($payload);
        return $next($payload);
    }
}
