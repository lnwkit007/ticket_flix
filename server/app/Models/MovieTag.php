<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovieTag extends Model
{
    use SoftDeletes;
    
    protected $table = 'movie_tag';
    protected $fillable = ['movie_tag_name'];
    protected $hidden = ['created_at', 'updated_at', 'pivot'];

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
