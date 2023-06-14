<?php

namespace App\Processes\Tasks;

use App\Processes\Commands\StoreSource;
use Closure;

final class StoreSourceTask
{
    public function __construct(private readonly StoreSource $command)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $source = $this->command->handle($payload);
        $payload->put('source', $source);
        return $next($payload);
    }
}
