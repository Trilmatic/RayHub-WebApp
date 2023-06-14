<?php

namespace App\Processes\Commands;

use App\Models\Source;
use Illuminate\Support\Facades\DB;

final class StoreSource
{
    public function handle($payload)
    {
        return DB::transaction(callback: static fn () => Source::create(
            [
                'user_id' => $payload->get('user')->id,
                'path' => $payload->get('path'),
                'source_type' => $payload->get('sourceType'),
                'content_type' => $payload->get('contentType'),
                'ip' => $payload->get('ip'),
            ]
        ), attempts: 2,);
    }
}
