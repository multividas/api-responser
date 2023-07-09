<?php

namespace Soulaimaneyh\ApiResponser\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser
{
    public int $options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;

    protected function successResponse(array|LengthAwarePaginator $data, int $code): JsonResponse
    {
        return new JsonResponse($data, $code, [
            'Content-Type' => 'application/json',
            'X-Application-Name' => config('api-responser.app-name')
        ], $this->options);
    }

    protected function infoResponse(string $message, int $code): JsonResponse
    {
        return new JsonResponse(['info' => $message, 'code' => $code], $code, [
            'Content-Type' => 'application/json',
            'X-Application-Name' => config('api-responser.app-name')
        ], $this->options);
    }
}
