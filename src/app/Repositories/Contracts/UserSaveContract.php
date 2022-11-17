<?php

namespace App\Repositories\Contracts;
use App\Models\User;

interface UserSaveContract
{
    public function save(User $user): void;
}
