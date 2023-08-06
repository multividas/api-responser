<?php

namespace Soulaimaneyh\ApiResponser\Repositories;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\JsonResource;
use Soulaimaneyh\ApiResponser\Traits\ApiResponser;
use Soulaimaneyh\ApiResponser\Interfaces\ApiRepositoryInterface;

class ApiRepository implements ApiRepositoryInterface
{
    use ApiResponser;

    public function showAll(Collection|JsonResource $collection, $code = 200): JsonResponse
    {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }

        if ($collection instanceof Collection) {
            $transformer = $collection->first()?->transformer ?? null;
        } elseif ($collection instanceof JsonResource) {
            $transformer = $collection->collects ?? null;
        }

        $collection = $this->filterData($collection, $transformer);
        $collection = $this->sortData($collection, $transformer);
        $collection = $this->paginate($collection);

        return $this->successResponse($collection, $code);
    }

    public function showOne(Model|JsonResource $instance, $code = 200): JsonResponse
    {
        return $this->successResponse([
            'data' => $instance
        ], $code);
    }

    protected function filterData(Collection|JsonResource $collection, ?string $transformer): Collection|JsonResource
    {
        if (isset(request()->query()['filters'])) {
            foreach (request()->query()['filters'] as $query) {
                if (!is_null($transformer) && is_callable([$transformer, 'originalAttribute'])) {
                    $queryField = $transformer::originalAttribute($query['field']);
                } else {
                    $queryField = $query['field'];
                }

                $collection = $collection->where($queryField, $query['value']);
            }
        }

        return $collection;
    }

    protected function sortData(Collection|JsonResource $collection, ?string $transformer): Collection|JsonResource
    {
        if (request()->has('_sort')) {
            if (!is_null($transformer) && is_callable([$transformer, 'originalAttribute'])) {
                $sortField = $transformer::originalAttribute(request()->_sort);
            } else {
                $sortField = request()->_sort;
            }

            $sortOrder = request()->has('_order') && request()->_order == 'desc' ? true : false;

            $collection = $collection->sortBy($sortField, SORT_REGULAR, $sortOrder);
        }

        return $collection;
    }

    /**
     * @return array|LengthAwarePaginator
     */
    protected function paginate(Collection|JsonResource $collection)
    {
        $rules = [
            'per_page' => 'integer|min:2|max:50',
        ];

        Validator::validate(request()->all(), $rules);

        $perPage = 10;

        if (request()->has('per_page')) {
            $perPage = (int) request()->per_page;
        }

        $page = LengthAwarePaginator::resolveCurrentPage();
        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator(
            $results,
            $collection->count(),
            $perPage,
            $page,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'query' => request()->query()
            ]
        );

        $paginated->appends(request()->all());

        return $paginated;
    }

    protected function cacheResponse(array|LengthAwarePaginator $data): array
    {
        $url = request()->url();
        $queryParams = request()->query();

        ksort($queryParams);

        $queryString = http_build_query($queryParams);

        $fullUrl = "{$url}?{$queryString}";

        return Cache::remember($fullUrl, 60, function () use ($data) {
            return $data->toArray();
        });
    }
}
