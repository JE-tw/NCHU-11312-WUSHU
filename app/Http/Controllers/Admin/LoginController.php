<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function loginPage()
    {
        return Inertia::render('backend/LoginPage');
    }
}
