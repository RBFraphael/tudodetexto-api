<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Files\StoreFileRequest;
use App\Models\DirectoryFile;
use App\Models\File;
use App\Repositories\FilesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function __construct(
        private FilesRepository $filesRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $files = $this->filesRepository->all();
        return response()->json($files);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        $input = $request->validated();

        $uploadedFile = $request->file("file");
        $path = Storage::disk("public")->putFile(date("Y/m/d"), $uploadedFile);

        $data = [
            'path' => $path,
            'client_name' => $uploadedFile->getClientOriginalName(),
            'name' => $uploadedFile->getClientOriginalName(),
            'size' => $uploadedFile->getSize(),
            'mimetype' => $uploadedFile->getClientMimeType()
        ];

        $file = $this->filesRepository->create($data);

        if ($input['directory_id']) {
            DirectoryFile::create([
                'directory_id' => $input['directory_id'],
                'file_id' => $file->id
            ]);
        }

        return response()->json($file, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        $file = $this->filesRepository->find($file->id);
        return response()->json($file);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        $this->filesRepository->delete($file->id);
        return response()->noContent();
    }

    public function view(File $file)
    {
        $path = Storage::path($file->path);
        return response()->file($path);
    }
}
