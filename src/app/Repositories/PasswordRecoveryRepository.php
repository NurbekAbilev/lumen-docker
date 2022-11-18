<?php

namespace App\Repositories;
use App\Models\PasswordRecovery;
use App\Repositories\Contracts\PasswordRecoverySaveContract;

class PasswordRecoveryRepository implements PasswordRecoverySaveContract
{
	public function save(PasswordRecovery $passwordRecovery): void 
    {
        $passwordRecovery->save();
	}
}
