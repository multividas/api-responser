<?php

declare(strict_types=1);

/**
 * (c) 2024 Multividas. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

interface ApiRepositoryInterface
{
    public function showAll(
        Collection|EloquentCollection|JsonResource $collection,
        int $code = 200,
        array $meta = []
    ): JsonResponse;

    public function listAll(
        Collection|EloquentCollection|JsonResource $collection,
        int $code = 200,
        array $meta = []
    ): JsonResponse;

    public function showOne(
        Model|JsonResource $instance,
        int $code = 200,
        array $meta = []
    ): JsonResponse;
}
