<?php

namespace App\Services\Contracts;
use App\DTO\RegisterUserDTO;
use App\Models\User;

interface RegisterUserContract
{
    public function registerUser(RegisterUserDTO $userDTO): User;
}
