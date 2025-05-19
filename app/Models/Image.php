<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\TMDBService;

class Image extends Model
{
    protected $fillable = [
        'movie_id',
        'file_path',
        'type'
    ];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function getFullPathAttribute()
    {
        return app(TMDBService::class)->getImageUrl($this->file_path);
    }
} 