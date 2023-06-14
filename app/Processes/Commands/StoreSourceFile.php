<?php

namespace App\Processes\Commands;

use App\Models\SourceFile;
use Illuminate\Support\Facades\DB;

final class StoreSourceFile
{
    public function handle($user, $source, $file)
    {
        return DB::transaction(callback: static fn () => SourceFile::create(
            [
                'user_id' => $user->id,
                'source_id' => $source->id,
                'name' => $file->name,
                'path' => $file->path,
                'type' => $file->type,
                'is_video' => $file->isVideo,
            ]
        ), attempts: 2,);
    }
}
