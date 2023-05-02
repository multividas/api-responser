<?php

namespace Soulaimaneyh\ApiResponser\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

interface ApiRepositoryInterface
{
    public function showAll(Collection $collection, $code = 200): JsonResponse;

    public function showOne(Model $instance, $code = 200): JsonResponse;
}
