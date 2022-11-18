<?php

namespace App\Queries\Contracts;
use App\Models\User;

interface PasswordRecoveryQueryContract
{
    public function getByEmailAndCode(string $email, string $code): ?User;
}
