<?php

namespace App\Console\Commands;

use App\Services\TMDBService;
use Illuminate\Console\Command;
use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
                
                // Check if movie already exists by title
                $movie = Movie::where('title', $movieData['title'])->first();
                
                if (!$movie) {
                    // Get more details about the movie
                    $details = $this->tmdbService->getMovieDetails($movieData['id']);
                    
                    // Create new movie record using admin-based approach
                    $movie = new Movie();
                    $movie->title = $details['title'];
                    $movie->storyline = $details['overview'];
                    
                    // Handle image (save the URL directly since we're not downloading)
                    if (!empty($details['poster_path'])) {
                        $movie->image = 'https://image.tmdb.org/t/p/w500' . $details['poster_path'];
                    }
                    
                    // Set category if available
                    if (!empty($details['genres']) && count($details['genres']) > 0) {
                        $genre = $details['genres'][0]['name'];
                        // Try to find matching category or create default
                        $category = Category::where('name', $genre)->first();
                        if ($category) {
                            $movie->category_id = $category->id;
                        }
                    }
                    
                    // Set other properties
                    $movie->release_date = $details['release_date'];
                    $movie->rating = $details['vote_average'] / 2; // Convert 10-scale to 5-scale
                    $movie->duration = $details['runtime'] ?? 0;
                    
                    $movie->save();
                    
                    $this->info("  - Added new movie: {$movie->title}");
                } else {
                    $this->info("  - Movie already exists: {$movie->title}");
                }
            }
            
            $this->info("Page {$page} completed.");
        }

        $this->info('All movies have been synced successfully!');
    }
}