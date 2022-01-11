<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Concerns\HasEnabledStatus;

/**
 * @property string $email
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasEnabledStatus;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function email(): string
    {
        return strtolower( $this->email);
    }

    /*public function isEnabled(): bool
    {
        return ! (bool) $this->isDisabled();
    }

    public function isDisabled(): bool
    {
        return  (bool) $this->disabled_at;
    }*/
}
