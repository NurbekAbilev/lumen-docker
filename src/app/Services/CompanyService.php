<?php

namespace App\Services;

use App\DTO\CreateCompanyDTO;
use App\Models\Company;
use App\Repositories\CreateCompanyRepository;
use App\Services\Contracts\CompanyCreateContract;

class CompanyService implements CompanyCreateContract
{
    public function __construct(private CreateCompanyRepository $createCompanyRepository) {}

	public function createCompany(CreateCompanyDTO $createCompanyDTO): Company
    {
        $company = new Company();

        $company->title = $createCompanyDTO->title;
        $company->phone = $createCompanyDTO->phone;
        $company->description = $createCompanyDTO->description;
        $company->user_id = $createCompanyDTO->userID;

        $this->createCompanyRepository->save($company);

        return $company;
	}
}
