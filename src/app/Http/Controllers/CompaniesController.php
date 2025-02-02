<?php

namespace App\Http\Controllers;

use App\DTO\CreateCompanyDTO;
use App\Queries\Contracts\CompanyQueryContract;
use App\Services\Contracts\CompanyCreateContract;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function createCompany(Request $request, CompanyCreateContract $companyCreateContract)
    {  
        $this->validate($request, [
            'title' => 'required',
            'phone' => 'required|numeric',
            'description' => 'required',
        ]);

        $company = $companyCreateContract->createCompany(CreateCompanyDTO::createFromRequest($request));

        return [
            'message' => 'Company created',
            'data' => $company
        ];
    }

    public function companyIndex(Request $request, CompanyQueryContract $companyQueryContract)
    {  
        $companies = $companyQueryContract->getAll($request);

        return [
            'data' => $companies
        ];
    }
}
