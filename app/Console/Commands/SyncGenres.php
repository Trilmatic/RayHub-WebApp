<?php

namespace App\Console\Commands;

use App\Processes\SyncMovieGenresProcess;
use Illuminate\Console\Command;

class SyncGenres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-genres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synces genres with TMDB database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $process = new SyncMovieGenresProcess();
        $payload = collect([]);
        $process->run($payload);
    }
}
