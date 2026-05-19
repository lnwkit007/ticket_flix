<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MovieTag extends Model
{
    protected $table = 'movie_tag';
    protected $fillable = ['movie_tag_name'];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(
            Movie::class,
            'movie_tag_pivot',
            'movie_tag_id',
            'movie_id'
        );
    }
}
