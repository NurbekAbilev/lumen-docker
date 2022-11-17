<?php

namespace App\Http\Controllers;

use App\DTO\RegisterUserDTO;
use App\Services\Contracts\RegisterUserContract;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userRegister(Request $request, RegisterUserContract $service)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required:min:6',
            'phone' => 'required|numeric|unique:users,phone',
        ]);

        $user = $service->registerUser(RegisterUserDTO::fromRequest($request));

        return ['data' => $user];
    }
}
