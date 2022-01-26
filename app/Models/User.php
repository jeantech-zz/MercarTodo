<?php

namespace App\Models;

use App\Filters\Concerns\HasFilters;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Concerns\HasEnabledStatus;

/**
 * @property string $email
 */

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasEnabledStatus;
    use HasFilters;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'rol_id',
        'disabled_at'
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
        return $this->attributes['email'];
        // strtolower( $this->email);
    }

    public function emailLogin(): string
    {
        return strtolower( $this->email);
    }

    public function password(): string
    {
        return $this->attributes['password'];
    }

    public function isEnabled(): bool
    {
        return ! (bool) $this->isDisabled();
    }

    public function isDisabled(): bool
    {
        return  (bool) $this->disabled_at;
    }

    public function role(){
        return $this->belongsTo(Role::class,'rol_id');
    }

    public function isClient(){
        if($this->role->name == 'Client'){
            return true;
        }
        return false;
    }
}
