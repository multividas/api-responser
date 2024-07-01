<?php

declare(strict_types=1);

/**
 * (c) 2024 Multividas. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Repositories;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Multividas\ApiResponser\Traits\ApiResponser;
use Multividas\QueryFilters\Facades\QueryFilters;
use Multividas\ApiResponser\Interfaces\ApiRepositoryInterface;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class ApiRepository implements ApiRepositoryInterface
{
    use ApiResponser;

    /**
     * Show All Filtered, Paginated Data
     *
     * @param Collection|EloquentCollection|JsonResource $collection
     * @param int $code
     * @param array $meta
     *
     * @return JsonResponse
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
     * Method listAll
     *
     * @param Collection|EloquentCollection|JsonResource $collection
     * @param int $code
     * @param array $meta
     *
     * @return JsonResponse
     */
    public function listAll(
        Collection|EloquentCollection|JsonResource $collection,
        int $code = 200,
        array $meta = []
    ): JsonResponse {
        $cachingData = QueryFilters::listAll($collection);

        return $this->successResponse([
            'data' => $cachingData,
            'code' => $code,
            'meta' => (object)$meta ?? []
        ], $code);
    }

    /**
     * Method showOne
     *
     * @param Model|JsonResource $instance
     * @param int $code
     * @param array $meta
     *
     * @return JsonResponse
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
