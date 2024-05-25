<?php

declare(strict_types=1);

/**
 * (c) 2024 Multividas. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Providers;

use Illuminate\Support\ServiceProvider;
use Multividas\ApiResponser\Repositories\ApiRepository;
use Multividas\ApiResponser\Interfaces\ApiRepositoryInterface;

class ApiResponserServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            $this->basePath('config/api-responser.php') => base_path('config/api-responser.php')
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
