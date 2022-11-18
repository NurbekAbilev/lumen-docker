<?php

namespace App\Services\Contracts;

interface PasswordRecoverContract
{
    public function passwordRecover(string $email, string $recoveryCode, string $newPassword): bool;
}
