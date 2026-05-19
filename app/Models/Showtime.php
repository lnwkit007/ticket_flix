<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Showtime extends Model
{
    protected $table = 'showtimes';
    protected $fillable = ['start_time', 'base_price', 'movie_id', 'theater_id'];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function theater(): BelongsTo
    {
        return $this->belongsTo(Theater::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
