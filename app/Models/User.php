<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens,Notifiable;

    protected $table = 'users';
    protected $fillable = ['user_name', 'user_email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
