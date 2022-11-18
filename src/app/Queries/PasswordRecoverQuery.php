<?php

namespace App\Queries;
use App\Models\PasswordRecovery;
use App\Models\User;
use App\Queries\Contracts\PasswordRecoveryQueryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class PasswordRecoverQuery implements PasswordRecoveryQueryContract
{
	public function getByEmailAndCode(string $email, string $code): ?User 
    {
        return User::query()->where('email', $email)
            ->whereHas('passwordRecoveries', function(Builder $builder) use ($code) {

                $builder
                    ->where('code', $code)
                    ->where('valid_till', '>', Carbon::now()->toDateTimeString());
                    
            })->first();
	}
}
