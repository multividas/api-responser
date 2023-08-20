<?php

/**
 * (c) 2023 Multividas inc. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Repositories;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

use Illuminate\Http\Resources\Json\JsonResource;
use Multividas\ApiResponser\Traits\ApiResponser;
use Multividas\ApiResponser\Interfaces\ApiRepositoryInterface;

class ApiRepository implements ApiRepositoryInterface
{
    use ApiResponser;

    public function showAll(Collection|EloquentCollection|JsonResource $collection, $code = 200): JsonResponse
    {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection, 'code' => $code, 'meta' => (object)[]], $code);
        }

        return $this->successResponse(['data' => $collection, 'code' => $code, 'meta' => (object)[]], $code);
    }

    public function showOne(Model|JsonResource $instance, $code = 200): JsonResponse
    {
        return $this->successResponse(['data' => $instance, 'code' => $code, 'meta' => (object)[]], $code);
    }
}
