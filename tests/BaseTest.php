<?php

namespace Soulaimaneyh\ApiResponser\Tests;

use Orchestra\Testbench\TestCase;
use Soulaimaneyh\ApiResponser\Providers\ApiServiceProvider;
use Soulaimaneyh\ApiResponser\Traits\ApiResponser;

class BaseTest extends TestCase
{
    use ApiResponser;
    
    protected function getPackageProviders($app)
    {
        return [
            ApiServiceProvider::class
        ];
    }
}
