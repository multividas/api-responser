<?php

/**
 * (c) 2023 Multividas inc. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Facades;

use Illuminate\Support\Facades\Facade;
use Multividas\ApiResponser\Interfaces\ApiRepositoryInterface;

class ApiResponser extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ApiRepositoryInterface::class;
    }
}
