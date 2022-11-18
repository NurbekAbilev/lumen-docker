<?php

namespace Tests\UnitTest;
use App\Models\User;
use App\Queries\Contracts\PasswordRecoveryQueryContract;
use App\Queries\Contracts\UserQueryContract;
use App\Repositories\Contracts\PasswordRecoverySaveContract;
use App\Repositories\Contracts\UserSaveContract;
use App\Services\Contracts\PasswordRecoverContract;
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

    public function testRecoverPasswordInvalidEmailOrCode()
    {
        $this->app->bind(PasswordRecoveryQueryContract::class, function() {
            $mockService = $this->getMockBuilder(PasswordRecoveryQueryContract::class)->getMock();
            $mockService->expects($this->once())
                ->method('getByEmailAndCode')
                ->willReturn(null);
            return $mockService;
        });

        $this->app->bind(UserSaveContract::class, function() {
            $mockService = $this->getMockBuilder(UserSaveContract::class)->getMock();
            $mockService->expects($this->never())
                ->method('save');
            return $mockService;
        });

        $passwordRecovery = $this->app->get(PasswordRecoverContract::class);
        $passChanged = $passwordRecovery->passwordRecover('john_doe@mail.com', 'code', 'password');

        $this->assertFalse($passChanged);
    }

    public function testRecoverPasswordSuccess()
    {
        $this->app->bind(PasswordRecoveryQueryContract::class, function() {
            $mockService = $this->getMockBuilder(PasswordRecoveryQueryContract::class)->getMock();
            $mockService->expects($this->once())
                ->method('getByEmailAndCode')
                ->willReturn(new User());
            return $mockService;
        });

        $this->app->bind(UserSaveContract::class, function() {
            $mockService = $this->getMockBuilder(UserSaveContract::class)->getMock();
            $mockService->expects($this->once())
                ->method('save');
            return $mockService;
        });

        $passwordRecovery = $this->app->get(PasswordRecoverContract::class);
        $passChanged = $passwordRecovery->passwordRecover('john_doe@mail.com', 'code', 'password');

        $this->assertTrue($passChanged);
    }
}
