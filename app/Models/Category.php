<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get the movies that belong to the category.
     */
    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class);
    }
}
