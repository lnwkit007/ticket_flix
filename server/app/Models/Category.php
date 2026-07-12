<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class);
    }
}
