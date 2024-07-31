<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'path',
        'client_name',
        'name',
        'size',
        'mimetype',
    ];

    protected $appends = [
        'url'
    ];

    public function directories(): HasManyThrough
    {
        return $this->hasManyThrough(Directory::class, DirectoryFile::class, 'directory_id', 'id', 'id', 'file_id');
    }

    protected static function booted()
    {
        static::deleted(function (File $file) {
            Storage::disk("public")->delete($file->path);
        });
    }

    public function getUrlAttribute()
    {
        $user = auth()->user();
        if ($user) {
            return route("files.view", [
                'file' => $this->id
            ]);
        }
        return null;
    }
}
