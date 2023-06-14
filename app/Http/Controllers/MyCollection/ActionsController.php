<?php

namespace App\Http\Controllers\MyCollection;

use App\Processes\Queries\GetCollectionVideo;
use App\Processes\ScanLocalSourceProcess;
use Illuminate\Http\Request;
use App\Streamer\VideoStreamer;

final class ActionsController
{
    public function __construct(private readonly ScanLocalSourceProcess $scan)
    {
    }

    public function scan(Request $request)
    {
        $payload = $request->collect();
        $payload->put('user', $request->user());
        $this->scan->run($payload);

        return redirect()->back();
    }

    public function source(Request $request, $hash)
    {
        $handler = new GetCollectionVideo();
        $video = $handler->handle($hash);
        VideoStreamer::streamFile($video->path);
    }
}
