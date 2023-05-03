<?php

namespace Soulaimaneyh\ApiResponser\Facades;

use Illuminate\Support\Facades\Facade;

class ApiResponserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'response';
    }
}
