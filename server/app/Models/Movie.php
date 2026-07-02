<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;

    protected $table = 'movies';
    protected $fillable = ['movie_title', 'movie_synopsis', 'movie_poster'];
    protected $hidden = ['created_at', 'updated_at']; 

    public function showtimes(): HasMany
    {
        return $this->hasMany(Showtime::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            MovieTag::class,
            'movie_tag_pivot',
            'movie_id',
            'movie_tag_id'
        );
    }

    
    public function moviePoster() : Attribute 
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('storage/'. $value) : null
        );
    }
}
