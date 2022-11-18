<?php

namespace App\Providers;

use App\Queries\CompanyQuery;
use App\Queries\Contracts\CompanyQueryContract;
use App\Queries\Contracts\PasswordRecoveryQueryContract;
use App\Queries\Contracts\UserQueryContract;
use App\Queries\PasswordRecoverQuery;
use App\Queries\UserQuery;
use App\Repositories\CompanyRepository;
use App\Repositories\Contracts\PasswordRecoverySaveContract;
use App\Repositories\Contracts\UserSaveContract;
use App\Repositories\CreateCompanyRepository;
use App\Repositories\PasswordRecoveryRepository;
use App\Repositories\UserRepository;
use App\Services\CompanyService;
use App\Services\Contracts\CompanyCreateContract;
use App\Services\Contracts\PasswordRecoverContract;
use App\Services\Contracts\PasswordRecoveryCodeSendContract;
use App\Services\Contracts\RegisterUserContract;
use App\Services\Contracts\UserSignInContract;
use App\Services\PasswordRecoveryService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RegisterUserContract::class, UserService::class);
        $this->app->bind(UserSaveContract::class, UserRepository::class);

        $this->app->bind(UserSignInContract::class, UserService::class);
        $this->app->bind(UserQueryContract::class, UserQuery::class);

        $this->app->bind(PasswordRecoveryCodeSendContract::class, PasswordRecoveryService::class);
        $this->app->bind(PasswordRecoverySaveContract::class, PasswordRecoveryRepository::class);
        $this->app->bind(PasswordRecoverContract::class, PasswordRecoveryService::class);
        $this->app->bind(PasswordRecoveryQueryContract::class, PasswordRecoverQuery::class);

        $this->app->bind(CompanyCreateContract::class, CompanyService::class);
        $this->app->bind(CreateCompanyRepository::class, CompanyRepository::class);
        $this->app->bind(CompanyQueryContract::class, CompanyQuery::class);
    }
}
