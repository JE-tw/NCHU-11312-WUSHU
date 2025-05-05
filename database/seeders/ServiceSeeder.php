<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $services = [
            [
                'name' => '印度占星論命：本命、大運',
                'price' => 36000,
                'introduction' => '此服務透過印度古老星象系統，提供深入的人生解析與流年趨勢。'
            ],
            [
                'name' => '紫微斗數：命盤解析',
                'price' => 32000,
                'introduction' => '結合命宮與身宮的詳細分析，協助理解個人天命與運勢變化。'
            ],
            [
                'name' => '塔羅占卜：感情方向',
                'price' => 1800,
                'introduction' => '快速釐清感情疑惑，指引情感上的行動與抉擇方向。'
            ],
            [
                'name' => '塔羅占卜：事業選擇',
                'price' => 1800,
                'introduction' => '解答工作與創業的迷思，幫助做出清晰的生涯規劃。'
            ],
            [
                'name' => '個人能量清理儀式',
                'price' => 5200,
                'introduction' => '透過靈氣與祝福儀式，清除身上負面能量場。'
            ],
            [
                'name' => '五行開運布置諮詢',
                'price' => 7800,
                'introduction' => '透過空間風水調整五行平衡，增強生活整體順利度。'
            ],
            [
                'name' => '陽宅風水勘察服務',
                'price' => 12800,
                'introduction' => '針對住宅環境進行風水勘察與方位調整建議。'
            ],
            [
                'name' => '商業空間開運布局',
                'price' => 22800,
                'introduction' => '針對辦公與店面設計最有利的氣場與財位配置。'
            ],
            [
                'name' => '開光招財符製作',
                'price' => 3600,
                'introduction' => '專為財運提升開光製作，置於財位或隨身攜帶皆宜。'
            ],
            [
                'name' => '姻緣桃花符製作',
                'price' => 3600,
                'introduction' => '增強個人魅力、改善人際與吸引正緣。'
            ],
            [
                'name' => '文昌智慧符製作',
                'price' => 3600,
                'introduction' => '協助學習、考試與表現順利，開智慧提文運。'
            ],
            [
                'name' => '合八字擇日服務',
                'price' => 8600,
                'introduction' => '針對結婚、搬遷、開業選擇良辰吉時。'
            ],
            [
                'name' => '流年運勢詳細分析',
                'price' => 4800,
                'introduction' => '提供年度趨勢與每月重點，預做規劃與調整。'
            ],
            [
                'name' => '感情合盤分析',
                'price' => 6800,
                'introduction' => '透過雙方命盤深入了解關係的課題與潛力。'
            ],
            [
                'name' => '招財風水物品推薦',
                'price' => 4200,
                'introduction' => '依據個人命盤與居住空間推薦合適風水物。'
            ],
            [
                'name' => '小兒命理成長分析',
                'price' => 5800,
                'introduction' => '分析兒童命盤助父母掌握性格與教育方向。'
            ],
            [
                'name' => '靈擺潛意識訊息解讀',
                'price' => 2800,
                'introduction' => '利用靈擺與圖板，解讀潛意識訊息與建議。'
            ],
            [
                'name' => '前世今生能量回溯',
                'price' => 8600,
                'introduction' => '探索前世經驗與對今生的影響與功課。'
            ],
            [
                'name' => '水晶配戴建議',
                'price' => 2200,
                'introduction' => '依個人能量選擇適合水晶來強化運勢。'
            ],
            [
                'name' => '財運開運開光儀式',
                'price' => 12800,
                'introduction' => '透過道法儀式為財運開門並去除阻礙能量。'
            ],
        ];

        foreach ($services as $service) {
            \App\Models\Service::create($service);
        }
    }
}
