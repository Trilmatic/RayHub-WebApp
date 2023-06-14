<?php

namespace App\Processes\Tasks;

use App\Processes\Commands\CheckSourceFile;
use App\Processes\Commands\StoreSourceFile;
use Closure;

final class StoreSourceFilesTask
{
    public function __construct(private readonly CheckSourceFile $check, private readonly StoreSourceFile $store)
    {
    }

    public function __invoke($payload, Closure $next): mixed
    {
        $user = $payload->get('user');
        $source = $payload->get('source');
        $entries = $payload->get('entries');
        foreach ($entries as &$entry) {
            $file = $this->check->handle($source, $entry);
            $this->store->handle($user, $source, $file);
        }

        return $next($payload);
    }
}
