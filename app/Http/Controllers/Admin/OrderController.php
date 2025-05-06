<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HandlesTableFilters;
use App\Models\User;

// 購物車
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

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
            'remittance_date' => 'nullable|date',
            'remittance_amount' => 'nullable|numeric',
            'remittance_last5' => 'nullable|string|max:5',
            'status' => 'required|in:paid,unpaid,cancelled',
            'course_permissions' => 'array',
        ]);

        $order->update([
            'remittance_date' => $data['remittance_date'],
            'remittance_amount' => $data['remittance_amount'],
            'remittance_last5' => $data['remittance_last5'],
            'status' => $data['status'],
        ]);

        // 更新課程權限邏輯 (視你的資料表設計可能會用 pivot table 或其他方式)
        // 例如: OrderItem::where('order_id', $order->id)->each(...)

        return redirect()->route('admin.order.list')->with('success', '訂單已更新');
    }


    // 購物車
    public function store(Request $request)
    {
        DB::beginTransaction();

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
                'status' => 0, // 初始狀態可改成你想要的
                'remittance_date' => $remittance['remittance_date'],
                'remittance_amount' => $remittance['remittance_amount'],
                'remittance_account_last5' => $remittance['remittance_account_last5'],
            ]);

            // 5. 建立每筆訂單項目
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_type' => $item['product_type'],
                    'product_id' => $item['product_id'],
                    'price_at_order_time' => $item['price_at_order_time'],
                    'is_accessible' => false, // 預設未開通
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => '訂單已成功建立',
                'order_id' => $order->id,
            ]);
            // return redirect()->route('order.success')->with('message', '訂單建立成功！');

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => '訂單建立失敗',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
