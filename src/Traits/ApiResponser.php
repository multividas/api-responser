<?php

declare(strict_types=1);

/**
 * (c) 2024 Multividas. All rights reserved.
 * Unauthorized use prohibited.
 * Website: https://www.multividas.com
 */

namespace Multividas\ApiResponser\Traits;

use stdClass;
use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

trait ApiResponser
{
    public int $options = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE;

    /**
     * Generate a success response.
     *
     * @param array $data
     * @param int   $code
     * @return JsonResponse
     */
    protected function successResponse(array $data, int $code): JsonResponse
    {
        $headers = [
            'Content-Type' => 'application/json',
            'X-Application-Name' => App::make('config')->get('api-responser')['app-name'],
        ];

        return new JsonResponse($data, $code, $headers, $this->options);
    }

    /**
     * Generate an information response.
     *
     * @param string $message
     * @param int    $code
     * @param array|Collection|EloquentCollection|stdClass $meta
     * @return JsonResponse
     */
    protected function infoResponse(string $message, int $code, $meta): JsonResponse
    {
        $data = [
            'info' => $message,
            'code' => $code,
            'meta' => (object) $meta,
        ];

        $headers = [
            'Content-Type' => 'application/json',
            'X-Application-Name' => App::make('config')->get('api-responser')['app-name'],
        ];

        return new JsonResponse($data, $code, $headers, $this->options);
    }

    /**
     * Handle a validation exception.
     *
     * @param ValidationException $e
     * @return JsonResponse
     */
    protected function handleValidationException(ValidationException $e): JsonResponse
    {
        $errors = $e->validator->errors()->toArray();

        return $this->infoResponse('The given data was invalid.', 422, ['fields' => $errors]);
    }

    /**
     * Handle an internal error.
     *
     * @param Throwable|string $e
     * @return JsonResponse
     */
    protected function handleInternalError(Throwable|string $e): JsonResponse
    {
        $message = $e instanceof Throwable ? $e->getMessage() : $e;

        return $this->infoResponse($message, 500, []);
    }
}
