<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HandlesTableFilters
{
    /**
     * 套用搜尋、排序與分頁邏輯到查詢中
     *
     * @param Request $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $config
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function applyFiltersAndPaginate(Request $request, $query, array $config)
    {
        $search = $request->input('search');
        $sortKey = $request->input('sort', $config['defaultSort'] ?? 'id');
        $sortDirection = $request->input('direction', $config['defaultDirection'] ?? 'asc');
        $perPage = $config['perPage'] ?? 10;

        // 搜尋邏輯
        if ($search && isset($config['search'])) {
            $query->where(function ($q) use ($search, $config) {
                foreach ($config['search'] as $field) {
                    $q->orWhere($field, 'like', "%{$search}%");
                }
            });
        }

        // 排序邏輯
        if (in_array($sortKey, $config['allowedSorts'] ?? []) &&
            in_array($sortDirection, ['asc', 'desc'])) {
            $query->orderBy($sortKey, $sortDirection);
        }

        // 分頁並保留參數
        return $query->paginate($perPage)->withQueryString();
    }
}
