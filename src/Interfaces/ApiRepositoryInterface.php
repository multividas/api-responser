<?php

namespace Soulaimaneyh\ApiResponser\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

interface ApiRepositoryInterface
{
    public function showAll(Collection|JsonResource $collection, $code = 200): JsonResponse;

    public function showOne(Model|JsonResource $instance, $code = 200): JsonResponse;
}
