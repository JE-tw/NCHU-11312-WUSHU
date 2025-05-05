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
        // Chapter::create([
        //     'name' => '第一堂課',
        //     'introduction' => '良好的風水可以使家庭收入增加，人丁健康，在選擇居家風水，實在不可不慎。',
        //     'video_url' => 'https://youtu.be/aHuItwXi4bw?si=vMMXTnslt9j9szTg',
        //     'sort' => 1,
        //     'course_id' => 1,
        // ]);
        $videoUrl = 'https://youtu.be/aHuItwXi4bw?si=vMMXTnslt9j9szTg';
        $chapterNames = ['第一堂課', '第二堂課', '第三堂課', '第四堂課', '第五堂課', '第六堂課', '第七堂課', '第八堂課', '第九堂課', '第十堂課', '第十一堂課'];
        $shortIntros = [
            '學習能量的基礎概念',
            '認識自我潛意識',
            '解讀命盤的關鍵技巧',
            '空間佈局的基本原則',
            '水晶的淨化與使用方法',
            '分析夢境中的象徵意義',
            '建立穩定的冥想習慣',
            '牌卡連結與解讀實作',
            '風水與財運之間的關聯',
            '探索靈魂藍圖的核心',
            '處理煞氣與氣場不穩',
            '基礎命理觀念導讀',
            '深入探討人際互動模式',
            '如何排除負能量影響',
        ];

        foreach (range(1, 11) as $courseId) {
            $chapterCount = rand(5, 11);
            for ($i = 1; $i <= $chapterCount; $i++) {
                Chapter::create([
                    'name' => $chapterNames[$i - 1],
                    'introduction' => $shortIntros[array_rand($shortIntros)],
                    'video_url' => $videoUrl,
                    'sort' => $i,
                    'course_id' => $courseId,
                ]);
            }
        }
    }
}
