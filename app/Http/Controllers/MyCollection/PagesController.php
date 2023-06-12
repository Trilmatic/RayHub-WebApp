<?php

namespace App\Http\Controllers\MyCollection;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

final class PagesController
{
    public function index(Request $request)
    {
        return Inertia::render('MyCollection/Setup', [
            'folders' => []
        ]);
    }

    public function scan(Request $request)
    {
        $folder = $request->get('folder');
        $folderType = $request->get('folderType');

        $folderCollection = collect(
            [
                'path' => $folder,
                'type' => $folderType,
            ]
        );

        //dd($folder);

        if ($entries = scandir($folder)) {
            $folderCollection->put('entries', array_diff($entries, array('.', '..')));
        }

        return Inertia::render('MyCollection/Setup', [
            'folders' => [$folderCollection->toArray()]
        ]);
    }

    public function play(Request $request)
    {
    }
}
