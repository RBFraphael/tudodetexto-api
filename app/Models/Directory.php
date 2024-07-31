<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Directory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'parent_directory_id',
        'name',
    ];

    protected $appends = [
        'path'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Directory::class, 'parent_directory_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Directory::class, 'parent_directory_id', 'id')->orderBy("name", "ASC");
    }

    public function files(): HasManyThrough
    {
        return $this->hasManyThrough(File::class, DirectoryFile::class, 'directory_id', 'id', 'id', 'file_id')->orderBy("name", "ASC");
    }

    public function vipArea(): HasOne
    {
        return $this->hasOne(VipArea::class, 'directory_id', 'id');
    }

    public function getPathAttribute(): string
    {
        if ($this->parent) {
            return $this->parent->getPathAttribute() . " / " . $this->name;
        }
        return $this->name;
    }
}
