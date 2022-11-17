<?php

namespace App\Services;
use App\DTO\RegisterUserDTO;
use App\Models\User;
use App\Repositories\Contracts\UserSaveContract;
use App\Services\Contracts\RegisterUserContract;

class UserService implements RegisterUserContract
{
    private UserSaveContract $userRepository;

    public function __construct(UserSaveContract $userSaveContract)
    {
        $this->userRepository = $userSaveContract;
    }

	public function registerUser(RegisterUserDTO $userDTO): User 
    {
        $user = new User();

        $user->first_name = $userDTO->first_name;
        $user->last_name = $userDTO->last_name;
        $user->email = $userDTO->email;
        $user->password = $userDTO->password;
        $user->phone = $userDTO->phone;

        $this->userRepository->save($user);

        return $user;
	}
}
