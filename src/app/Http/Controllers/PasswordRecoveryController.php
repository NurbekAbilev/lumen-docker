<?php

namespace App\Http\Controllers;
use App\Services\Contracts\PasswordRecoverContract;
use App\Services\Contracts\PasswordRecoveryCodeSendContract;
use Illuminate\Http\Request;

class PasswordRecoveryController extends Controller
{
    public function passwordRecoverySendEmail(Request $request, PasswordRecoveryCodeSendContract $passwordRecoveryCodeSendContract)
    {
        $this->validate($request, [
            'email' => 'required|exists:users,email',
        ]);

        $passwordRecoveryCodeSendContract->sendCode($request->input('email'));

        return ['message' => 'Code sent to email'];
    }

    public function recoverPassword(Request $request, PasswordRecoverContract $passwordRecoverContract)
    {
        $this->validate($request, [
            'email' => 'required|exists:users,email',
            'code' => 'required',
            'new_password' => 'required|min:6'
        ]);

        $passwordRecoverContract->passwordRecover($request->input('email'), $request->input('code'), $request->input('new_password'));

        return ['message' => 'Password Updated'];
    }
}
