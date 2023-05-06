<?php

namespace Soulaimaneyh\ApiResponser\Repositories;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

use Illuminate\Pagination\LengthAwarePaginator;
use Soulaimaneyh\ApiResponser\Traits\ApiResponser;
use Soulaimaneyh\ApiResponser\Interfaces\ApiRepositoryInterface;

class ApiRepository implements ApiRepositoryInterface
{
    use ApiResponser;

    public function showAll(Collection $collection, $code = 200): JsonResponse
    {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }

        $collection = $this->filterData($collection);
        $collection = $this->sortData($collection);
        $collection = $this->paginate($collection);
        $collection = $this->cacheResponse($collection);

        return $this->successResponse($collection, $code);
    }

    public function showOne(Model $instance, $code = 200): JsonResponse
    {
        return $this->successResponse([
            'data' => $instance
        ], $code);
    }

    protected function filterData(Collection $collection): Collection
    {
        if (isset(request()->query()['filters'])) {
            foreach (request()->query()['filters'] as $query) {
                $collection = $collection->where($query['field'], $query['value']);
            }
        }

        return $collection;
    }

    protected function sortData(Collection $collection): Collection
    {
        if (request()->has('_sort')) {
            $sortField = request()->_sort;
            $sortOrder = request()->has('_order') && request()->_order == 'desc' ? true : false;

            $collection = $collection->sortBy($sortField, SORT_REGULAR, $sortOrder);
        }

        return $collection;
    }

    /**
     * @return array|LengthAwarePaginator
     */
    protected function paginate(Collection $collection)
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
