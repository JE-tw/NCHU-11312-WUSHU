<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserInfoController extends Controller
{
    //
    public function index()
    {
        //
        $userInfos = UserInfo::with('user')->get();
        return Inertia::render('backend/UserList',[
            'userInfos'=> $userInfos
        ]);
    }
}
