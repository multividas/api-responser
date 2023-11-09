<?php

/**
 * (c) 2023 Multividas inc. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Interfaces;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

interface ApiRepositoryInterface
{
    /**
     * @JsonResponse Collection
     */
    public function showAll(
        Collection|EloquentCollection|JsonResource $collection,
        int $code = 200,
        array $meta = []
    ): JsonResponse;

    /**
     * @JsonResponse instance
     */
    public function showOne(
        Model|JsonResource $instance,
        int $code = 200,
        array $meta = []
    ): JsonResponse;
}
