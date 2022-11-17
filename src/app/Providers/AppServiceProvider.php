<?php

namespace App\Providers;

use App\Queries\Contracts\UserQueryContract;
use App\Queries\UserQuery;
use App\Repositories\Contracts\UserSaveContract;
use App\Repositories\UserRepository;
use App\Services\Contracts\RegisterUserContract;
use App\Services\Contracts\UserSignInContract;
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
    }
}
