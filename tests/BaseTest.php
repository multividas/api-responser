<?php

/**
 * (c) 2024 Multividas. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Tests;

use Orchestra\Testbench\TestCase;

use Multividas\ApiResponser\Traits\ApiResponser;
use Multividas\ApiResponser\Providers\ApiResponserServiceProvider;
use Multividas\ApiResponser\Facades\ApiResponser as FacadesApiResponser;

use Multividas\QueryFilters\Facades\QueryFilters as FacadesQueryFilters;
use Multividas\QueryFilters\Providers\QueryFiltersServiceProvider;

class BaseTest extends TestCase
{
    use ApiResponser;
    
    /**
     * Get package providers.
     */
    protected function getPackageProviders($app): array
    {
        return [
            ApiResponserServiceProvider::class,
            QueryFiltersServiceProvider::class
        ];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'ApiResponser' => FacadesApiResponser::class,
            'QueryFilters' => FacadesQueryFilters::class
        ];
    }
}
