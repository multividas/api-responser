<?php

namespace Soulaimaneyh\ApiResponser\Providers;

use Illuminate\Support\ServiceProvider;
use Soulaimaneyh\ApiResponser\Traits\ApiResponser;
use Soulaimaneyh\ApiResponser\Repositories\ApiRepository;
use Soulaimaneyh\ApiResponser\Interfaces\ApiRepositoryInterface;

class ApiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            $this->basePath('config/api-responser.php') => base_path('/config/api-responser.php')
        ], 'api-responser-config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom($this->basePath('config/api-responser.php'), 'api-responser');

        $this->app->bind(ApiRepositoryInterface::class, function () {
            return new ApiRepository();
        });
    }

    protected function basePath($path = ""): string
    {
        return __DIR__ . '/../../' . $path;
    }
}
