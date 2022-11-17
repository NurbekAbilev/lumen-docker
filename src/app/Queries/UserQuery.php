<?php

namespace App\Queries;

use App\Models\User;
use App\Queries\Contracts\UserQueryContract;

final class UserQuery implements UserQueryContract
{
	public function getById(int $id): ?User
    {
		return User::query()->find($id);
	}

	public function getByEmail(string $email): ?User 
	{
		return User::query()->where('email', $email)->first();
	}
}
