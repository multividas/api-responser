<?php

declare(strict_types=1);

/**
 * (c) 2024 Multividas. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Facades;

use Illuminate\Support\Facades\Facade;
use Multividas\ApiResponser\Interfaces\ApiRepositoryInterface;

class ApiResponser extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ApiRepositoryInterface::class;
    }
}
