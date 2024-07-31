<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class VipArea extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
    ];

    protected static function booted()
    {
        static::creating(function (VipArea $vipArea) {
            $directory = Directory::create(['name' => $vipArea->name]);
            $vipArea->directory_id = $directory->id;
        });
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, UserVipArea::class, 'user_id', 'id', 'id', 'vip_area_id');
    }

    public function directory(): BelongsTo
    {
        return $this->belongsTo(Directory::class, 'directory_id', 'id');
    }
}
