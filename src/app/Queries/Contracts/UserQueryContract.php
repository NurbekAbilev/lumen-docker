<?php

namespace App\Queries\Contracts;
use App\Models\User;

interface UserQueryContract
{
    public function getById(int $id): ?User;
    public function getByEmail(string $email): ?User;
}
