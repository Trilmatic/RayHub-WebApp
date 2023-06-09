<?php

namespace App\Models\Movies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    protected $fillable = ['tmdb_id', 'name', 'title', 'overview', 'original_language', 'popularity', 'runtime', 'status', 'tagline', 'vote_average', 'vote_count', 'poster_path', 'backdrop_path'];
    use HasFactory, SoftDeletes;
}
