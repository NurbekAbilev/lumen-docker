<?php

namespace Tests\UnitTest;
use App\Models\User;
use App\Queries\Contracts\UserQueryContract;
use App\Repositories\Contracts\PasswordRecoverySaveContract;
use App\Services\Contracts\PasswordRecoveryCodeSendContract;
use Illuminate\Support\Carbon;
use PhpParser\Builder\Use_;
use Tests\TestCase;

class PasswrodRecoveryTest extends TestCase
{
    public function testSendRecoveryCodeWhenUserDoesntExist()
    {
        $this->app->bind(UserQueryContract::class, function() {
            $mockService = $this->getMockBuilder(UserQueryContract::class)->getMock();
            $mockService->expects($this->once())
                ->method('getByEmail')
                ->willReturn(null);
            return $mockService;
        });

        $this->app->bind(PasswordRecoverySaveContract::class, function() {
            $mockService = $this->getMockBuilder(PasswordRecoverySaveContract::class)->getMock();
            $mockService->expects($this->never())
                ->method('save');
            return $mockService;
        });

        $passwordRecovery = $this->app->get(PasswordRecoveryCodeSendContract::class);
        $passwordRecovery->sendCode('john_doe@mail.com');
    }

    public function testSendRecoveryCodeWhenUserExists()
    {
        $this->app->bind(UserQueryContract::class, function() {
            $mockService = $this->getMockBuilder(UserQueryContract::class)->getMock();
            $mockService->expects($this->once())
                ->method('getByEmail')
                ->willReturn(new User());
            return $mockService;
        });

        $this->app->bind(PasswordRecoverySaveContract::class, function() {
            $mockService = $this->getMockBuilder(PasswordRecoverySaveContract::class)->getMock();
            $mockService->expects($this->once())
                ->method('save');
            return $mockService;
        });

        $passwordRecovery = $this->app->get(PasswordRecoveryCodeSendContract::class);
        $passwordRecovery->sendCode('john_doe@mail.com');
    }
}
