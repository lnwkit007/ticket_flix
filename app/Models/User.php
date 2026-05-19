<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['user_name', 'user_email', 'password',];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
