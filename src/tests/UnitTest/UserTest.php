<?php

namespace Tests\Functional;
use App\DTO\RegisterUserDTO;
use App\Repositories\Contracts\UserSaveContract;
use App\Repositories\UserRepository;
use App\Services\Contracts\RegisterUserContract;
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
}
