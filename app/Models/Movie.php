<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Services\TMDBService;

class Movie extends Model
{
    protected $fillable = [
        'tmdb_id',
        'title',
        'original_title',
        'overview',
        'poster_path',
        'backdrop_path',
        'release_date',
        'runtime',
        'vote_average',
        'vote_count',
        'status',
        'tagline',
        'budget',
        'revenue',
        'homepage',
        'imdb_id'
    ];

    protected $casts = [
        'release_date' => 'date',
        'runtime' => 'integer',
        'vote_average' => 'float',
        'vote_count' => 'integer',
        'budget' => 'integer',
        'revenue' => 'integer'
    ];

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class, 'movie_actor')
            ->withPivot('character_name', 'order_number');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function getPosterUrlAttribute()
    {
        return app(TMDBService::class)->getImageUrl($this->poster_path);
    }

    public function getBackdropUrlAttribute()
    {
        return app(TMDBService::class)->getImageUrl($this->backdrop_path);
    }
}
