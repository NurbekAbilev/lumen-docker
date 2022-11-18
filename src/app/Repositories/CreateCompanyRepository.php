<?php

namespace App\Repositories;

use App\Models\Company;

interface CreateCompanyRepository
{
    public function save(Company $company): void;
}
