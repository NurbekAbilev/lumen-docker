<?php

namespace App\Services;
use App\DTO\RegisterUserDTO;
use App\Models\User;
use App\Services\Contracts\RegisterUserContract;

class UserService implements RegisterUserContract
{
	public function registerUser(RegisterUserDTO $userDTO): User 
    {
        $user = new User();

        $user->first_name = $userDTO->first_name;
        $user->last_name = $userDTO->last_name;
        $user->email = $userDTO->email;
        $user->password = $userDTO->password;
        $user->phone = $userDTO->phone;

        $user->save();

        return $user;
	}
}
