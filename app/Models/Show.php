<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Show extends Model
{
    protected $fillable = [
        'movie_id', 
        'hall_id',  // Add this line
        'date', 
        'start_time', 
        'end_time', 
        'price', 
        'total_seats', 
        'available_seats'
    ];

    protected $casts = [
    'start_time' => 'datetime',
];

    protected $with = ['movie', 'hall'];  // This will eager load the relationships

    public function movie()
{
    return $this->belongsTo(Movie::class);
}

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}