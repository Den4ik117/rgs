<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'total_x',
        'total_y',
        'password',
        'group',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function samples()
    {
        return $this->hasMany(Sample::class);
    }

    public function isUser(): bool
    {
        return $this->role === Role::User->value;
    }

    public function isSponsor(): bool
    {
        return $this->role === Role::Sponsor->value;
    }

    public function isAdmin(): bool
    {
        return $this->role === Role::Admin->value;
    }

    public function isBanned(): bool
    {
        return $this->role === Role::Banned->value;
    }
}
