<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Course;
use App\Models\Service;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::all();
        $services = Service::all();
        $courses = Course::all();

        foreach ($users->random(10) as $user) {
            $remitAmount = fake()->optional()->numberBetween(1000, 10000);
            $remitAccount = $remitAmount ? fake()->numerify('#########') : null;
            $remitLast5 = $remitAccount ? substr($remitAccount,-5):null;
            $encryptedAccount = $remitAccount ? Crypt::encryptString($remitAccount) : null;

            $order = Order::create([
                'user_id'=>$user->id,
                'total_amount'=>0, // 預設為0稍後計算
                'status'=>fake()->numberBetween(0,3),
                'remittance_date'=>$remitAccount ? fake()->date():null,
                'remittance_amount'=>$remitAmount,
                'remittance_account'=>$encryptedAccount,
                'remittance_account_last5'=>$remitLast5
            ]);

            $total = 0;
            foreach(range(1,rand(1,5)) as $i){
                $isCourse = fake()->boolean(); // true = Course, false = Service
                if ($isCourse && $courses->isNotEmpty()) {
                    $product = $courses->random();
                    $productType = Course::class;
                } elseif (!$isCourse && $services->isNotEmpty()) {
                    $product = $services->random();
                    $productType = Service::class;
                } else {
                    continue;
                }

                OrderItem::create([
                    'order_id'=>$order->id,
                    'product_type'=>$productType,
                    'product_id'=>$product->id,
                    'price_at_order_time'=>$product->price,
                ]);

                $total += $product->price;
            }

            $order->update(['total_amount' => $total]);
        }
    }
}
