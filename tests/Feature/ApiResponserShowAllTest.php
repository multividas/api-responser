<?php

/**
 * (c) 2023 Multividas inc. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Tests\Feature;

use Illuminate\Http\JsonResponse;
use Multividas\ApiResponser\Tests\BaseTest;
use Illuminate\Database\Eloquent\Collection;
use Multividas\ApiResponser\Facades\ApiResponser;
use Multividas\ApiResponser\Tests\Traits\ApiResponserTestTrait;

class ApiResponserShowAllTest extends BaseTest
{
    use ApiResponserTestTrait;

    public function arrangeData(): array
    {
        return [
            ['id' => 1, 'name' => 'John Doe'],
            ['id' => 2, 'name' => 'Jane Smith'],
        ];
    }

    public function getApiResponse(): JsonResponse
    {
        $data = $this->arrangeData();
        return ApiResponser::showAll(new Collection($data), 200);
    }
}
