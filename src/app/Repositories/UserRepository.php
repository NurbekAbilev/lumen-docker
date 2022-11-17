<?php

namespace App\Repositories;
use App\Models\User;
use App\Repositories\Contracts\UserSaveContract;

class UserRepository implements UserSaveContract
{
	public function save(User $user): void 
    {
        $user->save();
	}
}
