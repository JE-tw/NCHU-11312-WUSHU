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
use App\Traits\HandlesTableFilters;

class UserInfoController extends Controller
{
    use HandlesTableFilters;
    //
    public function index(Request $request)
    {
        $query = UserInfo::with('user');

        $userInfos = $this->applyFiltersAndPaginate($request, $query, [
            'search' => ['name', 'phone'],// 支援搜尋的欄位
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
