<?php

namespace Tests\Functional;
use Tests\TestCase;

class UserTest extends TestCase
{   
    public function testRegisterUser()
    {
        $response = $this->json('POST', '/api/user/register', [
            'first_name' => 'john',
            'last_name' => 'doe',
            'email' => 'john_doe@mail.com',
            'password' => 'test',
            'phone' => '7777',
        ]);

        dd($response->response->content());
    }
}
