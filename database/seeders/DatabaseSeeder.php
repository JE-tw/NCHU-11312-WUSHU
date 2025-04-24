<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserInfo;
use Illuminate\Database\Seeder;

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
