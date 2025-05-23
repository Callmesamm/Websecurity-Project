<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\TMDBService;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'storyline',
        'image',
        'release_date',
        'rating',
        'duration',
        'category_id'
    ];

    protected $casts = [
        'release_date' => 'date',
        'duration' => 'integer',
        'rating' => 'float'
    ];

    /**
     * Get the category that owns the movie.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

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
