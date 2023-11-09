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
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

use Multividas\QueryFilters\Facades\QueryFilters;

use Multividas\ApiResponser\Traits\ApiResponser;
use Multividas\ApiResponser\Interfaces\ApiRepositoryInterface;

class ApiRepository implements ApiRepositoryInterface
{
    use ApiResponser;

    /**
     * @JsonResponse Collection
     */
    public function showAll(
        Collection|EloquentCollection|JsonResource $collection,
        int $code = 200,
        array $meta = []
    ): JsonResponse {
        if ($collection->isEmpty()) {
            return $this->successResponse([
                'data' => $collection,
                'code' => $code,
                'meta' => (object)$meta ?? []
            ], $code);
        }

        $filteredData = QueryFilters::applyFilters($collection);

        return $this->successResponse([
            'data' => $filteredData['data'],
            'code' => $code,
            'meta' => count($meta) > 0 ? (object)$meta : (object)$filteredData['meta']
        ], $code);
    }

    /**
     * @JsonResponse instance
     */
    public function showOne(
        Model|JsonResource $instance,
        int $code = 200,
        array $meta = []
    ): JsonResponse {
        return $this->successResponse([
            'data' => $instance,
            'code' => $code,
            'meta' => count($meta) > 0 ? (object)$meta : (object)[]
        ], $code);
    }
}
