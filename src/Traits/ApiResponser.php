<?php

namespace Soulaimaneyh\ApiResponser\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponser
{
    public array $headers = [
        'Content-Type' => 'application/json',
        'X-Application-Name' => 'Api-Responser'
    ];

    public int $options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;

    protected function successResponse(array $data, int $code): JsonResponse
    {
        return new JsonResponse($data, $code, $this->headers, $this->options);
    }

    protected function infoResponse(string $message, int $code): JsonResponse
    {
        return new JsonResponse(['info' => $message, 'code' => $code], $code, $this->headers, $this->options);
    }
}
