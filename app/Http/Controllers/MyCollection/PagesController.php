<?php

namespace App\Http\Controllers\MyCollection;

use App\Models\Source;
use App\Processes\Queries\GetCollectionVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

final class PagesController
{
    public function index(Request $request)
    {
        return Inertia::render('MyCollection/Index', [
            'videos' => $request->user()->videos()->orderBy('name', 'desc')->get()
        ]);
    }

    public function setup(Request $request)
    {
        return Inertia::render('MyCollection/Setup', [
            'sources' => $request->user()->sources()->with('videos')->withCount('other_files')->get()
        ]);
    }

    public function play(Request $request, $hash)
    {
        $handler = new GetCollectionVideo();
        $video = $handler->handle($hash);
        return Inertia::render('MyCollection/PlayVideo', [
            'video' => $video
        ]);
    }
}
