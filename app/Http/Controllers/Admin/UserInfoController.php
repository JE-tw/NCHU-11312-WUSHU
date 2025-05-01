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

class UserInfoController extends Controller
{
    //
    public function index()
    {
        //
        $userInfos = UserInfo::with('user')->get();
        return Inertia::render('backend/UserList', [
            'userInfos' => $userInfos
        ]);
    }

    public function store(Request $request)
    {
        try {
            // 驗證資料
            $validated = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'birth_date' => 'nullable|date',
                'birth_time' => 'nullable|string',
                'birth_city' => 'nullable|string|max:100',
                'address' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
            ])->validate();

            // 建立 user
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
        } catch (\Throwable $th) {
            Log::error($th);

            return redirect()->back()->with('error', '會員新增失敗，請稍後再試');
        }
    }

    public function delete($id)
    {
        //
        $item = UserInfo::findOrFail($id);
        $user = $item ->user;
        if($user){
            $user->delete();
        }
        return back()->with('success', '刪除成功');
    }
}
