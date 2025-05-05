<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HandlesTableFilters;


class OrderController extends Controller
{
    use HandlesTableFilters;
    //
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems.product']);

        /** @var LengthAwarePaginator $orders */
        $orders = $this->applyFiltersAndPaginate($request, $query, [
            'search' => ['user.name', 'user.email'], // 支援搜尋會員名稱與信箱
            'allowedSorts' => ['created_at', 'total_amount'],
            'defaultSort' => 'created_at',
            'defaultDirection' => 'desc',
            'perPage' => 10,
        ]);

        // 格式化資料：例如轉換日期格式
        $orders->getCollection()->transform(function ($order) {
            $order->formatted_date = $order->created_at->format('Y-m-d');
            $order->status_text = $order->status_text; // 可自訂欄位顯示
            return $order;
        });

        return Inertia::render('backend/OrderList', [
            'orders' => $orders,
        ]);
    }
}
