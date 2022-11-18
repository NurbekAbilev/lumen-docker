<?php

namespace App\Http\Controllers;

use App\DTO\RegisterUserDTO;
use App\Services\Contracts\PasswordRecoveryCodeSendContract;
use App\Services\Contracts\RegisterUserContract;
use App\Services\Contracts\UserSignInContract;
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

    public function userSignIn(Request $request, UserSignInContract $service)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = $service->signIn($request->input('email'), $request->input('password'));

        if (!$user) {
            return ['message' => 'Invalid email or password'];
        }

        return ['data' => $user];
    }

    public function passwordRecoverySendEmail(Request $request, PasswordRecoveryCodeSendContract $passwordRecoveryCodeSendContract)
    {
        $this->validate($request, [
            'email' => 'required|exists:users,email',
        ]);

        $passwordRecoveryCodeSendContract->sendCode($request->input('email'));

        return ['message' => 'Code sent to email'];
    }
}
