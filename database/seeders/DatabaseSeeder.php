<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Course;
use App\Models\Service;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // 開發用帳號
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => '五術大師',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]
        );
        // 為該帳號建立對應的 user_info，如果尚未存在
        if (!$user->userInfo) {
            UserInfo::create([
                'user_id' => $user->id,
                'name' => '五術大師',
                'phone' => '0912345678',
                'birth_date' => '1990-01-01',
                'birth_time' => '08:00',
                'birth_city' => '台北市',
                'address' => '中正區仁愛路一段1號',
            ]);
        }

        $this->call([
            UserInfoSeeder::class,
            ContactRecordSeeder::class,
            ServiceSeeder::class,
            CategorySeeder::class,
            CourseSeeder::class,
            ChapterSeeder::class,
            OrderSeeder::class,


        ]);
    }
}
