<?php

namespace App\Services\Contracts;
use App\Models\User;

interface UserSignInContract
{
    public function signIn(string $email, string $password): ?User;
}
