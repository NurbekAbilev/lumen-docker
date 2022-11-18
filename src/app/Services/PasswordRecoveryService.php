<?php

namespace App\Services;

use App\Models\PasswordRecovery;
use App\Queries\Contracts\UserQueryContract;
use App\Repositories\Contracts\PasswordRecoverySaveContract;
use App\Services\Contracts\PasswordRecoveryCodeSendContract;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PasswordRecoveryService implements PasswordRecoveryCodeSendContract
{
    public function __construct(
        private UserQueryContract $userQuery,
        private EmailService $emailService,
        private PasswordRecoverySaveContract $passwordRepository
    ) {}

	public function sendCode(string $email): void
    {
        $user = $this->userQuery->getByEmail($email);

        if (!$user) {
            return;
        }

        $passwordRecovery = new PasswordRecovery();
        $passwordRecovery->code = Str::random(40);
        $passwordRecovery->valid_till = Carbon::now()->addMinutes(10);
        $passwordRecovery->user_id = $user->id;

        $this->passwordRepository->save($passwordRecovery);
	}
}
