<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::with('user', 'orderItems.product')->get();

        return Inertia::render('backend/OrderList', [
            'orders' => $orders,
        ]);
    }
}
