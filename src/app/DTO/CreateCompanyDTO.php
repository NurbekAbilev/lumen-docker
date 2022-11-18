<?php

namespace App\DTO;

use Illuminate\Http\Request;

class CreateCompanyDTO
{
    public string $title;
    public string $phone;
    public string $description;
    public int $userID;

    public static function createFromRequest(Request $request): CreateCompanyDTO
    {
        $self = new self();

        $self->title = $request->input('title');
        $self->phone = $request->input('phone');
        $self->description = $request->input('description');
        $self->userID = $request->user()->id;

        return $self;
    }
}
