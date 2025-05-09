<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Services\TMDBService;

class Actor extends Model
{
    protected $fillable = [
        'tmdb_id',
        'name',
        'profile_path',
        'biography',
        'birth_date',
        'death_date',
        'place_of_birth'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date'
    ];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_actor')
            ->withPivot('character_name', 'order_number');
    }

    public function getProfileUrlAttribute()
    {
        return app(TMDBService::class)->getImageUrl($this->profile_path);
    }
} 