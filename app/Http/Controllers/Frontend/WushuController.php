<?php

namespace App\Http\Controllers\Frontend;

use id;
use auth;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Course;
use App\Models\Service;
use App\Models\Category;
use App\Models\UserInfo;
use App\Models\OrderItem;

// 購物車
use Illuminate\Http\Request;
use App\Models\ContactRecord;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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

    // // 查 購物車會員資料
    // public function cart()
    // {
    //     $userId = 1; // 固定使用者編號
    //     $userInfo = User::with('userInfo')->find($userId);

    //     return Inertia::render('frontend/Cart', [
    //         'userInfo' => $userInfo,
    //     ]);
    // }

    // 查 購物車會員資料
    public function cart()
    {
        $userId = auth()->id(); // 抓取登入的使用者 ID

        // 若未登入，$userId 為 null，可導向登入頁或給予其他處理
        if (!$userId) {
            return redirect()->route('login'); // 或 return redirect('/login');
        }

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
                'status' => 1, // 初始狀態，代表「等待客服確認款項」
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

            return response()->json([
                'message' => '訂單建立成功！',
                'order_id' => $order->id,
            ]);
            // return redirect()->route('order.success')->with('message', '訂單建立成功！');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => '訂單建立失敗！',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // 查 課程介紹頁 課程關聯章節
    public function intro($id)
    {
        $course = Course::with(['chapters'])->find($id);
        if ($course == null) return redirect('/wushu/ServiceCourse');

        $userId = auth()->id(); // 抓取登入使用者 ID

        $isAccessible = false;

        if($userId){
            $isAccessible = OrderItem::where('product_id', $id)
                ->where('product_type', 'App\\Models\\Course')
                ->where('is_accessible', true)
                ->whereHas('order', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->exists();
        }
        
        return Inertia::render('frontend/CourseIntro', [
            'course' => $course,
            'isAccessible' => $isAccessible,
        ]);
    }


    // // // 會員中心 會員資料
    // public function userInfo(Request $request)
    // {
    //     $userId = 1; // 寫死 user_id

    //     // 會員資料
    //     $user = User::with('userInfo')->find($userId);
    //     $userInfo = $user ? $user->toArray() : null;

    //     // 訂單與課程資料
    //     $query = Order::with(['user', 'orderItems.product'])
    //         ->where('user_id', $userId);

    //     $orders = $query->latest()->paginate(10);

    //     // 處理訂單資料格式
    //     $orders->getCollection()->transform(function ($order) {
    //         $order->formatted_date = $order->created_at->format('Y-m-d');
    //         $order->status_text = $order->status_text;
    //         return $order;
    //     });
    //     // 額外處理：我的課程
    //     // 找出所有訂單中的課程項目（Course）
    //     $courses = $query->get()
    //         ->flatMap(function ($order) {
    //             return $order->orderItems->filter(function ($item) {
    //                 return $item->product_type === 'App\\Models\\Course' && $item->is_accessible == 'true';
    //             });
    //         })
    //         ->map(function ($item) {
    //             return [
    //                 'name' => $item->product->name ?? '未找到課程',
    //                 'id' => $item->product->id ?? null,
    //                 'introduction' => $item->product->introduction ?? '',
    //                 'price' => $item->product->price ?? 0,
    //             ];
    //         })
    //         ->values();

    //     return Inertia::render('frontend/MemberCenter', [
    //         'userInfo' => $userInfo,
    //         'orders' => $orders,
    //         'courses' => $courses,
    //     ]);
    // }
    public function userInfo(Request $request)
    {
        $userId = auth()->id(); // 抓取登入會員 ID

        // 未登入時導向登入頁面
        if (!$userId) {
            return redirect()->route('login'); // 或其他你定義的登入路徑
        }

        // 會員資料
        $user = User::with('userInfo')->find($userId);
        $userInfo = $user ? $user->toArray() : null;

        // 訂單與課程資料
        $query = Order::with(['user', 'orderItems.product'])
            ->where('user_id', $userId);

        $orders = $query->latest()->paginate(10);

        // 處理訂單資料格式
        $orders->getCollection()->transform(function ($order) {
            $order->formatted_date = $order->created_at->format('Y-m-d');
            $order->status_text = $order->status_text;
            return $order;
        });

        // 我的課程
        $courses = $query->get()
            ->flatMap(function ($order) {
                return $order->orderItems->filter(function ($item) {
                    return $item->product_type === 'App\\Models\\Course' && $item->is_accessible == true;
                });
            })
            ->each(function ($item) {
                $item->loadMissing('product.category');
            })
            ->map(function ($item) {
                return [
                    'name' => $item->product->name ?? '未找到課程',
                    'id' => $item->product->id ?? null,
                    'introduction' => $item->product->introduction ?? '',
                    'price' => $item->product->price ?? 0,
                    'category_id' => $item->product->category_id ?? null,
                    'category_name' => $item->product->category->name ?? '未分類',
                ];
            })
            ->values();

        return Inertia::render('frontend/MemberCenter', [
            'userInfo' => $userInfo,
            'orders' => $orders,
            'courses' => $courses,
        ]);
    }

    public function userInfoUpdate(Request $request, $id)
    {
        $data = UserInfo::find($id);
        // dd($data);
        $validate = $request->validate([
            'name' => 'required|string|max:30',
            'phone' => 'nullable|string|max:20',
            'birth_city' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:100',
            'birth_date' => 'nullable|date',
            'birth_time' => 'nullable',
        ]);

        $data->update([
            'name' => $validate['name'],
            'phone' => $validate['phone'],
            'birth_date' => $validate['birth_date'],
            'birth_time' => $validate['birth_time'],
            'birth_city' => $validate['birth_city'],
            'address' => $validate['address'],
        ]);

        User::find($data['user_id'])->update([
            'name' => $validate['name'],
        ]);

        return back()->with('success', '資料已更新');
    }
    
    public function passwordUpdate(Request $request, $id)
    {
        // dd($request->all());
        $data = User::find($id);
        // dd($data);
        $validate = $request->validate([
            'password' => 'nullable|min:6|confirmed',
        ]);
        $data->update([
            'password' => Hash::make($validate['password']),
        ]);


        return back()->with('success', '密碼已更新');
    }
}
