<?php

namespace App\Repositories;

use App\Models\File;

class FilesRepository extends Repository
{
    protected $searchable = [
        'client_name',
        'name'
    ];

    protected $filterable = [
        'mimetype'
    ];

    protected $related = [
        'directories'
    ];

    public function __construct()
    {
        parent::__construct(File::class);
    }
}
