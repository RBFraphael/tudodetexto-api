<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DirectoryFile extends Pivot
{
    public $timestamps = false;

    protected $fillable = [
        'directory_id',
        'file_id'
    ];
}
