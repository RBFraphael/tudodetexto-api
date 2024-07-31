<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\VipArea;

class VipAreasRepository extends Repository
{
    protected $searchable = [
        'name'
    ];

    protected $filterable = [];

    protected $related = [
        'users',
        'directory'
    ];

    public function __construct()
    {
        parent::__construct(VipArea::class);
    }

    public function currentUser()
    {
        return $this->forUser(auth()->user());
    }

    public function forUser(User $user)
    {
        $this->query->whereHas("users", function ($query) use ($user) {
            $query->where("user_id", $user->id);
        });
        return $this;
    }
}
