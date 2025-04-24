<?php

namespace Database\Seeders;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserInfo;

class UserInfoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create('zh_TW');
        User::factory()
            ->count(10)
            ->create()
            ->each(function ($user) use ($faker) {
                UserInfo::create([
                    'name' => $user->name,
                    'phone' => '09' .$faker->numerify('########'),
                    'birth_date' => $faker->date,
                    'birth_time' => $faker->dateTime,
                    'birth_city' => $faker->city,
                    'address' => $faker->address,
                    'status' => $faker->randomElement([0, 1]),
                    'user_id' => $user->id,
                ]);
            });
    }
}
