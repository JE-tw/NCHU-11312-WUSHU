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
use App\Http\Controllers\Controller;

class WushuController extends Controller
{
    public function home()
    {
        $categories = Category::with('courses')->get();

        $featuredCourses = Course::with('category') 
            ->where('is_featured', true)
            ->take(2)
            ->get();

        $coursesByCategory = [];
        foreach ($categories as $category) {
            $coursesByCategory[$category->name] = $category->courses->map(function ($course) {
                $lessons = $course->chapters()->count();

                return [
                    'id' => $course->id,
                    'name' => $course->name,
                    'price' => $course->price,
                    'introduction' => $course->introduction,
                    'lessons' => $lessons,
                    'duration' => '2小時/堂',
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
        $userId = 2; // 固定會員

        // 建立訂單
        $order = Order::create([
            'user_id' => $userId,
            'total_amount' => $request->total_amount,
            'status' => '1', // 送出後，預設1-等待客服確認款項
            // 其他欄位（如匯款資訊）
            'remittance_date' => '',
            'remittance_amount' => '',
            'remittance_account_last5' => ''

        ]);

        // 建立每一筆訂單項目
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_type' => $item['product_type'],
                'product_id' => $item['product_id'],
                'price_at_order_time' => $item['price'],
                'is_accessible' => false,
            ]);
        }

        return response()->json(['message' => '訂單已送出成功']);
    }
}
