<?php

namespace App\Imports;

use App\Models\Movies\Movie;
use App\Models\Movies\MovieGenre;
use App\Models\Movies\MovieGenresPivot;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class MoviesImport implements ToModel, WithChunkReading, WithBatchInserts, WithUpserts, WithUpsertColumns, WithHeadingRow, ShouldQueue
{

    //use SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        //Create or update movie
        $movie = new Movie([
            'tmdb_id'     => $row['id'],
            'title'     => $row['title'],
            'original_language'     => $row['original_language'],
            'overview'     => $row['overview'],
            'release_date'     => $row['release_date'],
            'popularity'     => $row['popularity'],
            'runtime'     => $row['runtime'],
            'status'     => $row['status'],
            'tagline'     => $row['tagline'],
            'vote_average'     => $row['vote_average'],
            'vote_count'     => $row['vote_count'],
            'poster_path'     => $row['poster_path'],
            'backdrop_path'     => $row['backdrop_path'],
        ]);

        //Pivot genres for movie
        $genres = explode('-', $row['genres']);
        foreach ($genres as $genre) {
            $genre_record = MovieGenre::where('name', $genre);
            if ($genre_record->exists()) {
                $pivot = MovieGenresPivot::where([['genre_tmdb_id', $genre_record->id], ['movie_tmdb_id', $movie->id]]);
                if (!$pivot->exists()) {
                    new MovieGenresPivot([
                        'genre_tmdb_id' => $genre_record->id,
                        'movie_tmdb_id' => $movie->id,
                    ]);
                }
            }
        }

        return $movie;
    }

    /*public function rules(): array
    {
        return [
            'title' => [
                'required',
            ],
        ];
    }*/

    public function chunkSize(): int
    {
        return 10000;
    }

    public function batchSize(): int
    {
        return 2000;
    }

    public function uniqueBy()
    {
        return 'tmdb_id';
    }

    public function upsertColumns()
    {
        return ['popularity', 'runtime', 'overview', 'status', 'release_date', 'tagline', 'vote_average', 'vote_count', 'poster_path', 'backdrop_path'];
    }
}
