<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Directory;
use App\Repositories\DirectoriesRepository;
use Illuminate\Http\Request;

class DirectoriesController extends Controller
{
    public function __construct(
        private DirectoriesRepository $directoriesRepository
    ) {
    }

    /**
     * Display the specified resource.
     */
    public function show(Directory $directory)
    {
        $dir = $this->directoriesRepository->find($directory->id);
        return response()->json($dir);
    }
}
