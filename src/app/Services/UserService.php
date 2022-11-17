<?php

namespace App\Services;
use App\DTO\RegisterUserDTO;
use App\Models\User;
use App\Queries\Contracts\UserQueryContract;
use App\Queries\UserQuery;
use App\Repositories\Contracts\UserSaveContract;
use App\Services\Contracts\RegisterUserContract;
use App\Services\Contracts\UserSignInContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService implements RegisterUserContract, UserSignInContract
{
    private UserSaveContract $userRepository;
    private UserQueryContract $userQuery;

    public function __construct(UserSaveContract $userSaveContract, UserQueryContract $userQuery)
    {
        $this->userRepository = $userSaveContract;
        $this->userQuery = $userQuery;
    }

	public function registerUser(RegisterUserDTO $userDTO): User 
    {
        $user = new User();

        $user->first_name = $userDTO->first_name;
        $user->last_name = $userDTO->last_name;
        $user->email = $userDTO->email;
        $user->password = Hash::make($userDTO->password);
        $user->phone = $userDTO->phone;

        $this->userRepository->save($user);

        return $user;
	}

	public function signIn(string $email, string $password): ?User
    {
        $user = $this->userQuery->getByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            return null;
        }
        
        $user->api_token = Str::random(40);
        $this->userRepository->save($user);
        
        return $user;
	}
}
