<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Traits\HandlesTableFilters;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserInfoController extends Controller
{
    use HandlesTableFilters;
    //
    public function index(Request $request)
    {
        $query = UserInfo::with('user');

        $userInfos = $this->applyFiltersAndPaginate($request, $query, [
            'search' => ['name', 'phone'], // 支援搜尋的欄位
            'allowedSorts' => ['id', 'birth_date'],
            'defaultSort' => 'id',
            'defaultDirection' => 'asc',
            'perPage' => 10,
        ]);

        return Inertia::render('backend/UserList', [
            'userInfos' => $userInfos,
        ]);
    }

    public function create(Request $request)
    {
        try {
            // 資料驗證（會自動擲出 ValidationException）
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'birth_date' => 'nullable|date',
                'birth_time' => 'nullable|string',
                'birth_city' => 'nullable|string|max:100',
                'address' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ]);

            // 將空字串轉為 null，避免寫入 MySQL 時出錯
            $validated['birth_date'] = $validated['birth_date'] ?: null;
            $validated['birth_time'] = $validated['birth_time'] ?: null;

            // 建立 user 資料
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // 建立 user_info 並與 user 關聯
            UserInfo::create([
                'user_id' => $user->id,
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'birth_date' => $validated['birth_date'],
                'birth_time' => $validated['birth_time'],
                'birth_city' => $validated['birth_city'],
                'address' => $validated['address'],
            ]);

            return redirect()->back()->with('success', '會員新增成功');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // 回傳表單錯誤（Inertia 專用）
            return back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            // 其他非驗證例外
            Log::error($e);
            return back()->with('error', '會員新增失敗，請稍後再試');
        }
    }

    public function update(Request $request, User $user)
    {
        // 檢查收到的所有資料
        // dd($request->all());
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'birth_date' => 'nullable|date',
                'birth_time' => 'nullable|string',
                'birth_city' => 'nullable|string|max:100',
                'address' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|min:6|confirmed',
                'status' => 'nullable|in:0,1',
            ]);

            // 將空字串轉為 null，避免寫入資料庫錯誤
            $validated['birth_date'] = $validated['birth_date'] ?: null;
            $validated['birth_time'] = $validated['birth_time'] ?: null;
            // 格式化 birth_time，將時間轉換為 HH:mm:ss 格式
            if ($validated['birth_time']) {
                $validated['birth_time'] = date('H:i:s', strtotime($validated['birth_time']));
            }
            // 如果有傳遞 status，則轉為數字；若沒有，則預設為 1 (啟用)
            $validated['status'] = $validated['status'] !== null ? (int) $validated['status'] : 1;
            // dd($validated); // 在這裡查看經過驗證後的資料是否正確

            // 更新 users 資料表
            $user->update([
                'name' => $validated['name'],
            ]);

            // 更新 user_info 資料
            $user->userInfo()->updateOrCreate(
                [], // 可以用來找到存在的 user_info (例如可以依 id 或關聯條件)
                [
                    'phone' => $validated['phone'],
                    'birth_date' => $validated['birth_date'],
                    'birth_time' => $validated['birth_time'],
                    'birth_city' => $validated['birth_city'],
                    'address' => $validated['address'],
                    'status' => $validated['status'],
                ]
            );

            return redirect()->back()->with('success', '會員資料更新成功');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            Log::error($e);
            return back()->with('error', '會員資料更新失敗，請稍後再試');
        }
    }


    public function edit(User $user)
    {
        $user->loadMissing('userInfo');

        // 處理 birth_time 顯示格式為 HH:mm
        if ($user->userInfo && $user->userInfo->birth_time) {
            $user->userInfo->birth_time = \Carbon\Carbon::parse($user->userInfo->birth_time)->format('H:i');
        }
        // 取得該會員的訂單（含關聯項目）
        $orders = Order::with(['orderItems.product'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // 格式化資料（加上 formatted_date、status_text）
        $orders->getCollection()->transform(function ($order) {
            $order->formatted_date = $order->created_at->format('Y-m-d');
            $order->status_text = $order->status_text;
            return $order;
        });
        return Inertia::render('backend/UserEdit', [
            'user' => $user,
            'userInfo' => $user->userInfo,
            'orders' => $orders,
        ]);
    }

    public function delete($id)
    {
        //
        $item = UserInfo::findOrFail($id);
        $user = $item->user;
        if ($user) {
            $user->delete();
        }
        return back()->with('success', '刪除成功');
    }
}
