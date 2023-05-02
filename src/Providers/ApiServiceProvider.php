<?php

namespace Soulaimaneyh\ApiResponser\Providers;

use Illuminate\Support\ServiceProvider;
use Soulaimaneyh\ApiResponser\Repositories\ApiRepository;
use Soulaimaneyh\ApiResponser\Interfaces\ApiRepositoryInterface;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ApiRepositoryInterface::class, function () {
            return new ApiRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
