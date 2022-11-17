<?php

namespace Tests\Functional;
use App\DTO\RegisterUserDTO;
use App\Models\User;
use App\Queries\Contracts\UserQueryContract;
use App\Queries\UserQuery;
use App\Repositories\Contracts\UserSaveContract;
use App\Repositories\UserRepository;
use App\Services\Contracts\RegisterUserContract;
use App\Services\Contracts\UserSignInContract;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Tests\TestCase;

class UserTest extends TestCase
{   
    private RegisterUserContract $registerUserContract;

    public function testRegisterUser()
    {
        $this->app->bind(UserSaveContract::class, function() {
            $mockService = $this->createMock(UserRepository::class);
            $mockService->expects($this->once())
                ->method('save');
            return $mockService;
        });

        $userDTO = new RegisterUserDTO();
        $userDTO->first_name = '';
        $userDTO->last_name = '';
        $userDTO->email = '';
        $userDTO->password = '';
        $userDTO->phone = '';

        $this->app->get(RegisterUserContract::class)->registerUser($userDTO);
    }

    public function testSignInUserSuccess()
    {
        $this->app->bind(UserQueryContract::class, function() {
            $mockService = $this->getMockBuilder(UserQueryContract::class)->getMock();
            $mockService->expects($this->once())
                ->method('getByEmail')
                ->willReturn(new User());

            return $mockService;
        });

        Hash::shouldReceive('check')->once()->andReturn(true);

        /* @var $signInServcie UserSignInContract  */
        $signInService = $this->app->get(UserSignInContract::class);

        $user = $signInService->signIn('test@mail.com', 'pass');

        $this->assertNotEmpty($user);
    }

    public function testSignInUserFailUserDoesntExist()
    {
        $this->app->bind(UserQueryContract::class, function() {
            $mockService = $this->getMockBuilder(UserQueryContract::class)->getMock();
            $mockService->expects($this->once())
                ->method('getByEmail')
                ->willReturn(null);

            return $mockService;
        });

        /* @var $signInServcie UserSignInContract  */
        $signInService = $this->app->get(UserSignInContract::class);

        $user = $signInService->signIn('test@mail.com', 'pass');

        $this->assertEmpty($user);
    }

    public function testSignInUserFailPasswordDoesntMatch()
    {
        $this->app->bind(UserQueryContract::class, function() {
            $mockService = $this->getMockBuilder(UserQueryContract::class)->getMock();
            $mockService->expects($this->once())
                ->method('getByEmail')
                ->willReturn(new User());

            return $mockService;
        });

        Hash::shouldReceive('check')->once()->andReturn(false);

        /* @var $signInServcie UserSignInContract  */
        $signInService = $this->app->get(UserSignInContract::class);

        $user = $signInService->signIn('test@mail.com', 'pass');

        $this->assertEmpty($user);
    }
}
