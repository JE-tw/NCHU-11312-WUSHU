<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Course;
use App\Models\Service;
use App\Models\OrderItem;
use Illuminate\Http\Request;

// 購物車
use Illuminate\Support\Facades\DB;
use App\Traits\HandlesTableFilters;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

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

    public function edit(Order $order)
    {
        // 使用 optional() 來避免 userInfo 不存在時報錯
        $order->load([
            'user.userInfo',       // 取得會員信箱 + 詳細資料，若不存在則為 null
            'orderItems.product',  // 取得購買項目（包含課程等）
        ]);

        // 在這裡手動處理 userInfo
        $userInfo = optional($order->user)->userInfo;  // 如果不存在，則為 null

        return Inertia::render('backend/OrderEdit', [
            'order' => $order,
            'userInfo' => $userInfo, // 傳遞給前端
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|integer',
            'course_permissions' => 'array',
            'course_permissions.*' => 'boolean',
        ]);

        $order->update([
            'status' => $data['status'],
        ]);

        // 更新每筆課程權限
        foreach ($data['course_permissions'] as $itemId => $isAccessible) {
            DB::table('order_items')
                ->where('id', $itemId)
                ->where('order_id', $order->id)
                ->update(['is_accessible' => $isAccessible]);
        }

        return redirect()->back()->with('success', '訂單已成功更新！');
    }



    /////////////////////////////////////////////
    // 購物車
    public function store(Request $request)
    {
        DB::beginTransaction(); // 	開始一個資料庫交易

        try {
            // 1. 取得使用者資料並建立使用者（或查詢現有的）
            $userData = $request->input('user');
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                ['name' => $userData['name'], 'phone' => $userData['phone']]
            );

            // 2. 取得匯款資訊與商品項目
            $remittance = $request->input('remittance');
            $items = $request->input('items');

            // 3. 計算總金額
            $totalAmount = collect($items)->sum('price_at_order_time');

            // 4. 建立訂單
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'status' => 1, // 初始狀態可改成你想要的
                'remittance_date' => $remittance['remittance_date'],
                'remittance_amount' => $remittance['remittance_amount'],
                'remittance_account_last5' => $remittance['remittance_account_last5'],
            ]);

            // 5. 處理訂單項目
            foreach ($items as $item) {

                $modelClass = $item['product_type'];

                if (!class_exists($modelClass)) {
                    Log::error("Unknown product_type class: " . $modelClass);
                    continue;
                }

                // 可選：確認產品是否存在
                $product = $modelClass::find($item['product_id']);
                if (!$product) {
                    Log::warning("找不到產品 ID: {$item['product_id']} for class: {$modelClass}");
                    continue;
                }

                // 根據模型名稱進行處理
                // try {
                // 這裡你不需要直接使用 `$model` 去創建 `OrderItem`
                // 只需要確保創建 `OrderItem` 的字段是正確的
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_type' => $item['product_type'],
                    'product_id' => $item['product_id'],
                    'price_at_order_time' => $item['price_at_order_time'],
                    'is_accessible' => false, // 預設未開通
                ]);
            }

            DB::commit(); // 提交交易，資料正式寫入

            // return response()->json([
            //     'status' => 'success',  // 成功
            //     'message' => '訂單已成功建立',
            //     'order_id' => $order->id,
            // ]);

        } catch (\Exception $e) {
            DB::rollBack(); // 有錯 → 回滾交易，資料不會寫入

            return response()->json([
                'status' => 'error', // 失敗
                'message' => '訂單建立失敗',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
