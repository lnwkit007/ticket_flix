<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TheaterType extends Model
{
    protected $table = 'theater_type';
    protected $fillable = ['theater_type_name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function theaters(): HasMany
    {
        return $this->hasMany(Theater::class);
    }
}
