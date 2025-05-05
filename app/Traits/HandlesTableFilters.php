<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HandlesTableFilters
{
     /**
     * 套用搜尋、排序與分頁邏輯到查詢中
     *
     * @param Request $request 使用者的 HTTP 請求物件，通常由控制器方法注入
     * @param Builder $query Eloquent 查詢建構器實體
     * @param array $config 設定搜尋欄位、排序欄位、預設排序方向與每頁筆數等
     *     - search: array 要套用模糊搜尋的欄位名稱，例如 ['name', 'phone']
     *     - allowedSorts: array 允許排序的欄位名稱，例如 ['id', 'created_at']
     *     - defaultSort: string 預設排序欄位名稱，例如 'id'
     *     - defaultDirection: string 預設排序方向 'asc' 或 'desc'
     *     - perPage: int 每頁幾筆，預設為 10
     *
     * @return LengthAwarePaginator 回傳已套用過搜尋、排序與分頁的結果
     */
    public function applyFiltersAndPaginate(Request $request, $query, array $config)
    {
        // 從請求中取得搜尋與排序參數，若無則使用預設值
        $search = $request->input('search');
        $sortKey = $request->input('sort', $config['defaultSort'] ?? 'id');
        $sortDirection = $request->input('direction', $config['defaultDirection'] ?? 'asc');
        $perPage = $config['perPage'] ?? 10;

        // 套用模糊搜尋條件（多欄位 OR 搜尋）
        if ($search && isset($config['search'])) {
            $query->where(function ($q) use ($search, $config) {
                foreach ($config['search'] as $field) {
                    $q->orWhere($field, 'like', "%{$search}%");
                }
            });
        }

        // 套用排序條件（僅允許白名單中的欄位與方向）
        if (in_array($sortKey, $config['allowedSorts'] ?? []) &&
            in_array($sortDirection, ['asc', 'desc'])) {
            $query->orderBy($sortKey, $sortDirection);
        }

        // 套用分頁，並保留查詢參數（例如搜尋條件與排序）
        return $query->paginate($perPage)->withQueryString();
    }
}
