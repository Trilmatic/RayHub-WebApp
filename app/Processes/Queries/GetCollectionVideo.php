<?php

namespace App\Processes\Queries;

use App\Models\SourceFile;

final class GetCollectionVideo
{
    public function handle($hash)
    {
        $record = SourceFile::where('hash', $hash);
        if (!$record->exists()) abort(404);
        return $record->first();
    }
}
