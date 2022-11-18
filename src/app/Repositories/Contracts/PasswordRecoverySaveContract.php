<?php

namespace App\Repositories\Contracts;
use App\Models\PasswordRecovery;

interface PasswordRecoverySaveContract
{
    public function save(PasswordRecovery $passwordRecovery): void;
}
