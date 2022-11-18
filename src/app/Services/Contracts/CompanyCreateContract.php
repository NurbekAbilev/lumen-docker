<?php

namespace App\Services\Contracts;
use App\DTO\CreateCompanyDTO;
use App\Models\Company;

interface CompanyCreateContract
{
    public function createCompany(CreateCompanyDTO $createCompanyDTO): Company;
}
