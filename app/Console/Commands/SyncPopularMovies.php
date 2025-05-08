<?php

namespace App\Console\Commands;

use App\Services\TMDBService;
use Illuminate\Console\Command;

class SyncPopularMovies extends Command
{
    protected $signature = 'movies:sync-popular {--pages=1 : Number of pages to sync}';
    protected $description = 'Sync popular movies from TMDB';

    protected $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        parent::__construct();
        $this->tmdbService = $tmdbService;
    }

    public function handle()
    {
        $pages = $this->option('pages');
        $this->info("Starting to sync {$pages} pages of popular movies...");

        for ($page = 1; $page <= $pages; $page++) {
            $this->info("Syncing page {$page}...");
            
            $movies = $this->tmdbService->getPopularMovies($page);
            
            foreach ($movies['results'] as $movieData) {
                $this->info("Syncing movie: {$movieData['title']}");
                $this->tmdbService->syncMovie($movieData['id']);
            }
            
            $this->info("Page {$page} completed.");
        }

        $this->info('All movies have been synced successfully!');
    }
} 