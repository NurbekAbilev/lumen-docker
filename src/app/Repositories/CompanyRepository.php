<?php

namespace App\Repositories;
use App\Models\Company;

class CompanyRepository implements CreateCompanyRepository
{
	public function save(Company $company): void
    {
        $company->save();
	}
}
