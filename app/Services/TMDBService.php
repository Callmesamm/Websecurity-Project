<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\Actor;
use App\Models\Image;
use Illuminate\Support\Facades\Http;

class TMDBService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.themoviedb.org/3';
    protected $imageBaseUrl = 'https://image.tmdb.org/t/p';

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.api_key');
    }

    public function getPopularMovies($page = 1)
    {
        $response = Http::get("{$this->baseUrl}/movie/popular", [
            'api_key' => $this->apiKey,
            'page' => $page
        ]);

        return $response->json();
    }

    public function getMovieDetails($tmdbId)
    {
        $response = Http::get("{$this->baseUrl}/movie/{$tmdbId}", [
            'api_key' => $this->apiKey,
            'append_to_response' => 'credits,images'
        ]);

        return $response->json();
    }

    public function getActorDetails($tmdbId)
    {
        $response = Http::get("{$this->baseUrl}/person/{$tmdbId}", [
            'api_key' => $this->apiKey
        ]);

        return $response->json();
    }

    public function syncMovie($tmdbId)
    {
        $movieData = $this->getMovieDetails($tmdbId);
        
        // Create or update movie
        $movie = Movie::updateOrCreate(
            ['tmdb_id' => $tmdbId],
            [
                'title' => $movieData['title'],
                'original_title' => $movieData['original_title'],
                'overview' => $movieData['overview'],
                'poster_path' => $movieData['poster_path'],
                'backdrop_path' => $movieData['backdrop_path'],
                'release_date' => $movieData['release_date'],
                'runtime' => $movieData['runtime'],
                'vote_average' => $movieData['vote_average'],
                'vote_count' => $movieData['vote_count'],
                'status' => $movieData['status'],
                'tagline' => $movieData['tagline'],
                'budget' => $movieData['budget'],
                'revenue' => $movieData['revenue'],
                'homepage' => $movieData['homepage'],
                'imdb_id' => $movieData['imdb_id']
            ]
        );

        // Sync actors
        foreach ($movieData['credits']['cast'] as $cast) {
            $actorData = $this->getActorDetails($cast['id']);
            
            $actor = Actor::updateOrCreate(
                ['tmdb_id' => $cast['id']],
                [
                    'name' => $cast['name'],
                    'profile_path' => $cast['profile_path'],
                    'biography' => $actorData['biography'],
                    'birth_date' => $actorData['birthday'],
                    'death_date' => $actorData['deathday'],
                    'place_of_birth' => $actorData['place_of_birth']
                ]
            );

            $movie->actors()->syncWithoutDetaching([
                $actor->id => [
                    'character_name' => $cast['character'],
                    'order_number' => $cast['order']
                ]
            ]);
        }

        // Sync images
        foreach ($movieData['images']['posters'] as $poster) {
            Image::updateOrCreate(
                [
                    'movie_id' => $movie->id,
                    'file_path' => $poster['file_path']
                ],
                ['type' => 'poster']
            );
        }

        foreach ($movieData['images']['backdrops'] as $backdrop) {
            Image::updateOrCreate(
                [
                    'movie_id' => $movie->id,
                    'file_path' => $backdrop['file_path']
                ],
                ['type' => 'backdrop']
            );
        }

        return $movie;
    }

    public function getImageUrl($path, $size = 'original')
    {
        return "{$this->imageBaseUrl}/{$size}{$path}";
    }
} 