<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Course;
use App\Models\Service;
use App\Models\Category;
use App\Models\UserInfo;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ContactRecord;

// 購物車
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class WushuController extends Controller
{
    // 首頁 - 獲取課程資料
    public function home()
    {
        // 取得所有課程類別與其關聯課程
        $categories = Category::with('courses')->get();
        $featuredCourses = Course::where('is_featured', true)->take(2)->get(); // 主打課程

        // 將課程按類別分組
        $coursesByCategory = [];
        foreach ($categories as $category) {
            $coursesByCategory[$category->name] = $category->courses->map(function ($course) {
                $lessons = $course->chapters()->count(); // 取得章節數量

                return [
                    'id' => $course->id,
                    'name' => $course->name,
                    'price' => $course->price,
                    'introduction' => $course->introduction,
                    'lessons' => $lessons,
                    'duration' => '2小時/堂', // 假設固定時長
                ];
            });
        }

        return Inertia::render('frontend/Home', [
            'categories' => $categories,
            'coursesByCategory' => $coursesByCategory,
            'featuredCourses' => $featuredCourses,
        ]);
    }

    // 查 服務與課程頁 課程、服務
    public function list()
    {
        $categories = Category::with('courses')->get();
        $services = Service::all();

        return Inertia::render('frontend/ServiceCourse', [
            'categories' => $categories,
            'services' => $services,
        ]);
    }

    // 查 課程介紹頁 課程關聯章節
    public function intro($id)
    {
        $course = Course::with(['chapters'])->find($id);
        if ($course == null) return redirect('/wushu/ServiceCourse');

        return Inertia::render('frontend/CourseIntro', [
            'course' => $course,
        ]);
    }

    // 聯絡我們頁 ContactUs
    function contact()
    {
        return Inertia::render('frontend/ContactUs');
    }

    // 新增 聯絡我們資料 -> ContactRecord
    function store(Request $request)
    {
        $item = $request->all();
        // 資料
        ContactRecord::create([
            "name" => $item['name'],
            "phone" => $item['phone'],
            "email" => $item['email'],
            "title" => $item['title'],
            "content" => $item['content'],
        ]);
        return redirect(route('wushu.contact'));
    }

    // 查 購物車會員資料
    public function cart()
    {
        $userId = 2; // 固定使用者編號
        $userInfo = User::with('userInfo')->find($userId);

        return Inertia::render('frontend/Cart', [
            'userInfo' => $userInfo,
        ]);
    }

    // 購物車送出訂單
    public function storeOrder(Request $request)
    {
        DB::beginTransaction();

        try {
            // 1. 建立/查詢使用者
            $userData = $request->input('user');
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                ['name' => $userData['name'], 'phone' => $userData['phone']]
            );

            // 2. 建立訂單
            $remittance = $request->input('remittance');
            $items = $request->input('items');

            $totalAmount = collect($items)->sum('price_at_order_time');

            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $totalAmount,
                'status' => 0, // 初始狀態，代表「尚未付款」
                'remittance_date' => $remittance['remittance_date'],
                'remittance_amount' => $remittance['remittance_amount'],
                'remittance_account_last5' => $remittance['remittance_account_last5'],
            ]);

            // 3. 建立 order_items
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

            // return response()->json([
            //     'message' => '訂單建立成功！',
            //     'order_id' => $order->id,
            // ]);
            return redirect()->route('order.success')->with('message', '訂單建立成功！');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => '訂單建立失敗！',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
