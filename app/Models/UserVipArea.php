<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserVipArea extends Pivot
{
    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'vip_area_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function vipArea(): BelongsTo
    {
        return $this->belongsTo(VipArea::class, 'vip_area_id', 'id');
    }
}
