<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'storyline',
        'image',
        'category',
        'rating',
        'release_date',
        'duration'
    ];

    protected $casts = [
        'release_date' => 'date',
        'rating' => 'float',
        'duration' => 'integer'
    ];

    public function shows()
    {
        return $this->hasMany(Show::class);
    }
}
