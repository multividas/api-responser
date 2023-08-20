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
    public function showAll(Collection|EloquentCollection|JsonResource $collection, $code = 200): JsonResponse;

    public function showOne(Model|JsonResource $instance, $code = 200): JsonResponse;
}
