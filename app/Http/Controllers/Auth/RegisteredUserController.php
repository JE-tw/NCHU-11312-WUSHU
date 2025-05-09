<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\UserInfo;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        return Inertia::render('auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return to_route('dashboard');
    // }



    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => 'required|string|max:20',
            'birth_date' => 'nullable|date',
            'birth_time' => 'nullable|string',
            'birth_city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        // 建立對應的 UserInfo 資料
        UserInfo::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'birth_time' => $request->birth_time,
            'birth_city' => $request->birth_city,
            'address' => $request->address,
            'status' => 1, // 預設啟用狀態
        ]);

        event(new Registered($user));
        Auth::login($user);

        // return to_route('dashboard');
        return redirect('/wushu/MemberCenter');
    }
}
