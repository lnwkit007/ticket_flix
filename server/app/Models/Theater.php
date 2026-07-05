<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theater extends Model
{
    use SoftDeletes;
    
    protected $table = 'theaters';
    protected $fillable = ['theater_name', 'seats_maximum', 'theater_type_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function theater_type(): BelongsTo
    {
        return $this->belongsTo(TheaterType::class, 'theater_type_id', 'id');
    }

    public function showtimes(): HasMany
    {
        return $this->hasMany(Showtime::class);
    }
}
