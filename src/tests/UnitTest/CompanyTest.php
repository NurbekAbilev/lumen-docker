<?php

namespace Tests\UnitTest;

use App\DTO\CreateCompanyDTO;
use App\Repositories\CreateCompanyRepository;
use App\Services\Contracts\CompanyCreateContract;
use Egulias\EmailValidator\Result\Reason\DotAtEnd;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    public function testCreateCompany()
    {
        $this->app->bind(CreateCompanyRepository::class, function(){
            $mock = $this->getMockBuilder(CreateCompanyRepository::class)->getMock();
            $mock->expects($this->once())
                ->method('save');

            return $mock;
        });

        $service = $this->app->get(CompanyCreateContract::class);

        $companyDTO = new CreateCompanyDTO();
        $companyDTO->title = 'test';
        $companyDTO->phone = 'test';
        $companyDTO->description = 'test';
        $companyDTO->userID = 1;
    
        $service->createCompany($companyDTO);
    }
}
