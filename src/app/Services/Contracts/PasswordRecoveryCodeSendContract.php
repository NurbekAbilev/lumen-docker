<?php

namespace App\Services\Contracts;

interface PasswordRecoveryCodeSendContract
{
    public function sendCode(string $email): void;
}
