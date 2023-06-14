<?php

namespace App\Processes\Commands;

use App\Models\SourceFile;
use Illuminate\Support\Facades\DB;

final class CheckSourceFile
{

    public function handle($source, $file)
    {
        $path = $source->path . '\\' . $file;
        if ($type = mime_content_type($path)) {
            //dd($this->isVideo($type));
            return (object) [
                'name' => $file,
                'path' => $path,
                'type' => $type,
                'isVideo' => $this->isVideo($type),
            ];
        } else {
            throw new \Exception('Failed to get file ' . $path, 6542);
        }
    }

    public function isVideo($type)
    {
        return str_starts_with($type, "video/");
    }
}
