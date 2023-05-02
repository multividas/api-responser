<?php

namespace Soulaimaneyh\ApiResponser\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Soulaimaneyh\ApiResponser\Traits\ApiResponser;
use Soulaimaneyh\ApiResponser\Interfaces\ApiRepositoryInterface;

class ApiRepository implements ApiRepositoryInterface
{
    use ApiResponser;

    public function showAll(Collection $collection, $code = 200): JsonResponse
    {
        return $this->successResponse([
            'data' => $collection
        ], $code);
    }

    public function showOne(Model $instance, $code = 200): JsonResponse
    {
        return $this->successResponse([
            'data' => $instance
        ], $code);
    }
}
