<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Chapter::create([
            'name' => '第一堂課',
            'introduction' => '良好的風水可以使家庭收入增加，人丁健康，在選擇居家風水，實在不可不慎。',
            'video_url' => 'https://youtu.be/aHuItwXi4bw?si=vMMXTnslt9j9szTg',
            'sort' => 1,
            'course_id' => 1,
        ]);
        Chapter::create([
            'name' => '第二堂課',
            'introduction' => '良好的風水可以使家庭收入增加，人丁健康，在選擇居家風水，實在不可不慎。',
            'video_url' => 'https://youtu.be/aHuItwXi4bw?si=vMMXTnslt9j9szTg',
            'sort' => 2,
            'course_id' => 1,
        ]);
        Chapter::create([
            'name' => '第三堂課',
            'introduction' => '良好的風水可以使家庭收入增加，人丁健康，在選擇居家風水，實在不可不慎。',
            'video_url' => 'https://youtu.be/aHuItwXi4bw?si=vMMXTnslt9j9szTg',
            'sort' => 3,
            'course_id' => 1,
        ]);
        Chapter::create([
            'name' => '第四堂課',
            'introduction' => '良好的風水可以使家庭收入增加，人丁健康，在選擇居家風水，實在不可不慎。',
            'video_url' => 'https://youtu.be/aHuItwXi4bw?si=vMMXTnslt9j9szTg',
            'sort' => 4,
            'course_id' => 1,
        ]);
        Chapter::create([
            'name' => '第五堂課',
            'introduction' => '良好的風水可以使家庭收入增加，人丁健康，在選擇居家風水，實在不可不慎。',
            'video_url' => 'https://youtu.be/aHuItwXi4bw?si=vMMXTnslt9j9szTg',
            'sort' => 5,
            'course_id' => 1,
        ]);
    }
}
