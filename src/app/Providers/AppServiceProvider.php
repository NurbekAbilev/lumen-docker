<?php

namespace App\Providers;

use App\Repositories\Contracts\UserSaveContract;
use App\Repositories\UserRepository;
use App\Services\Contracts\RegisterUserContract;
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
    }
}
