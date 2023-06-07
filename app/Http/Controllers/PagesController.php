<?php

namespace App\Http\Controllers;

use App\Models\Movies\MovieGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

final class PagesController
{
    public function welcome(Request $request)
    {
        return Inertia::render('Welcome', [
            'movie_genres' => MovieGenre::all(),
        ]);
    }
}
