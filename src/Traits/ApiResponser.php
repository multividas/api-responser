<?php

/**
 * (c) 2023 Multividas inc. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Traits;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Http\JsonResponse;
use stdClass;

trait ApiResponser
{
    public int $options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;

    protected function successResponse(array $data, int $code): JsonResponse
    {
        return new JsonResponse($data, $code, [
            'Content-Type' => 'application/json',
            'X-Application-Name' => config('api-responser.app-name')
        ], $this->options);
    }

    protected function infoResponse(
        string $message,
        int $code,
        Collection|EloquentCollection|stdClass|array $meta
    ): JsonResponse {
        return new JsonResponse(['info' => $message, 'code' => $code, 'meta' => (object) $meta], $code, [
            'Content-Type' => 'application/json',
            'X-Application-Name' => config('api-responser.app-name')
        ], $this->options);
    }
}
