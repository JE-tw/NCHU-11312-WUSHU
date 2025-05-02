<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserInfoController extends Controller
{
    //
    public function index(Request $request)
    {
        // 搜尋與排序
        $search = $request->input('search');
        $sortKey = $request->input('sort', 'id'); // 預設 id 排序
        $sortDirection = $request->input('direction', 'asc'); //小到大

        $allowedSortKeys = ['id', 'birth_date'];  // 允許排序欄位
        $allowedDirections = ['asc', 'desc'];

        $query = UserInfo::with('user')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%");
                });
            });

        if (in_array($sortKey, $allowedSortKeys) && in_array($sortDirection, $allowedDirections)) {
            $query->orderBy($sortKey, $sortDirection);
        }

        $userInfos = $query->paginate(10)->withQueryString();

        return Inertia::render('backend/UserList', [
            'userInfos' => $userInfos,
        ]);
    }

    public function store(Request $request)
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
