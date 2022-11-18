<?php

namespace App\Services;

use App\Models\PasswordRecovery;
use App\Queries\Contracts\PasswordRecoveryQueryContract;
use App\Queries\Contracts\UserQueryContract;
use App\Queries\PasswordRecoverQuery;
use App\Repositories\Contracts\PasswordRecoverySaveContract;
use App\Repositories\Contracts\UserSaveContract;
use App\Services\Contracts\PasswordRecoverContract;
use App\Services\Contracts\PasswordRecoveryCodeSendContract;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordRecoveryService implements PasswordRecoveryCodeSendContract, PasswordRecoverContract
{
    public function __construct(
        private UserQueryContract $userQuery,
        private EmailService $emailService,
        private PasswordRecoverySaveContract $passwordRepository,
        private PasswordRecoveryQueryContract $passwordRecoverQuery,
        private UserSaveContract $userRepository
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

	public function passwordRecover(string $email, string $recoveryCode, string $newPassword): bool
    {
        $user = $this->passwordRecoverQuery->getByEmailAndCode($email, $recoveryCode);

        if (!$user) {
            return false;
        }

        $user->password = Hash::make($newPassword);
        $this->userRepository->save($user);

        return true;
	}
}
