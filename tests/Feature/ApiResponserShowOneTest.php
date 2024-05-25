<?php

/**
 * (c) 2024 Multividas. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Tests\Feature;

use Illuminate\Http\JsonResponse;
use Multividas\ApiResponser\Tests\BaseTest;
use Multividas\ApiResponser\Tests\Models\Post;
use Multividas\ApiResponser\Facades\ApiResponser;
use Multividas\ApiResponser\Tests\Feature\Traits\ApiResponserTestTrait;

class ApiResponserShowOneTest extends BaseTest
{
    use ApiResponserTestTrait;

    public function arrangeData(): array
    {
        return [ 'id' => 1, 'name' => 'John Doe'];
    }

    public function getApiResponse(): JsonResponse
    {
        $data = $this->arrangeData();
        $postModel = Post::hydrate([$data])->first();
        return ApiResponser::showOne($postModel, 200);
    }
}
