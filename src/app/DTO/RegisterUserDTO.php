<?php

namespace App\DTO;
use Illuminate\Http\Request;

class RegisterUserDTO
{
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $password;
    public string $phone;

    public static function fromRequest(Request $request): self
    {
        $dto = new self();

        $dto->first_name = $request->input('first_name');
        $dto->last_name = $request->input('last_name');
        $dto->email = $request->input('email');
        $dto->password = $request->input('password');
        $dto->phone = $request->input('phone');

        return $dto;
    }    
}
