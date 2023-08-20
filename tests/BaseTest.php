<?php

/**
 * (c) 2023 Multividas inc. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Tests;

use Orchestra\Testbench\TestCase;
use Multividas\ApiResponser\Traits\ApiResponser;
use Multividas\ApiResponser\Providers\ApiResponserServiceProvider;
use Multividas\ApiResponser\Facades\ApiResponser as FacadesApiResponser;

class BaseTest extends TestCase
{
    use ApiResponser;
    
    /**
     * Get package providers.
     */
    protected function getPackageProviders($app): array
    {
        return [
            ApiResponserServiceProvider::class
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'ApiResponser' => FacadesApiResponser::class
        ];
    }
}
