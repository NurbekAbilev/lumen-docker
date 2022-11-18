<?php

namespace App\Queries\Contracts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface CompanyQueryContract
{
    public function getAll(Request $request): Collection;
}
