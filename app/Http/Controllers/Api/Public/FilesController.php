<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Repositories\FilesRepository;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function __construct(
        private FilesRepository $filesRepository
    ) {
    }

    public function view(File $file)
    {
        $path = Storage::disk("public")->path($file->path);
        return response()->file($path, [
            'Content-Disposition' => 'inline; filename="' . $file->name . '"'
        ]);
    }
}
