<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Directories\StoreDirectoryRequest;
use App\Http\Requests\Admin\Directories\UpdateDirectoryRequest;
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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $directories = $this->directoriesRepository->all();
        return response()->json($directories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDirectoryRequest $request)
    {
        $data = $request->validated();
        $directory = $this->directoriesRepository->create($data);
        return response()->json($directory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Directory $directory)
    {
        $dir = $this->directoriesRepository->find($directory->id);
        return response()->json($dir);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDirectoryRequest $request, Directory $directory)
    {
        $data = $request->validated();
        $dir = $this->directoriesRepository->update($directory->id, $data);
        return response()->json($dir);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Directory $directory)
    {
        $this->directoriesRepository->delete($directory->id);
        return response()->noContent();
    }
}
