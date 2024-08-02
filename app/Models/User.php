<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, HasUuids, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'document_number',
        'birthdate',
        'email',
        'email_verified_at',
        'phone',
        'cellphone',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'email_verified_at',
        'created_at',
        'updated_at'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function vipAreas(): HasManyThrough
    {
        return $this->hasManyThrough(VipArea::class, UserVipArea::class, 'user_id', 'id', 'id', 'vip_area_id');
    }
}
