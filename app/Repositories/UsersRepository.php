<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository extends Repository
{
    protected $searchable = [
        'first_name',
        'last_name',
        'document_number',
        'email',
        'phone',
        'cellphone',
    ];

    protected $filterable = [
        'birthdate',
        'role',
    ];

    protected $related = [
        'vipAreas'
    ];

    public function __construct()
    {
        parent::__construct(User::class);
    }
}
