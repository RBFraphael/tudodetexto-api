<?php

namespace App\Repositories;

use App\Models\Directory;

class DirectoriesRepository extends Repository
{
    protected $searchable = [
        'name'
    ];

    protected $filterable = [
        'parent_directory_id'
    ];

    protected $related = [
        'children',
        'files',
        'parent',
        'vipArea',
    ];

    public function __construct()
    {
        parent::__construct(Directory::class);
    }
}
