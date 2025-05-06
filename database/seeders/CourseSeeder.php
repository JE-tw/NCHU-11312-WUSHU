<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Course::create([
            'name' => '占星初階班',
            'category_id' => 1,
            'price' => 28000,
            'introduction' => '良好的風水可以使家庭收入增加，人丁健康，在選擇居家風水，實在不可不慎。',
            'detail' => '當我們談到風水時，不只是擺設問題，更是關乎居家能量的流動與平衡。一個良好的居家風水設計，能夠提升家庭整體的運勢，包括財運、人際關係、甚至健康狀況。舉例來說，玄關乾淨明亮可引財進門，客廳佈局開闊則象徵家庭和諧；臥室床位擺放得宜，能幫助睡眠品質、提升精神與氣場。此外，風水講求五行平衡，適當加入木、水、火、土、金的元素，也可強化空間的能量流通。無論信與不信，風水在室內設計中都扮演著一種提升舒適感與心理安全感的角色。畢竟，住得安心、看得順眼，運氣自然就來了。',
            'is_featured' => 1,
            'featured_image' => '主打課程1a2axq-d0uqq.webp',
        ]);
        Course::create([
            'name' => '塔羅牌解讀入門',
            'category_id' => 1,
            'price' => 25000,
            'introduction' => '塔羅牌是連接潛意識與宇宙訊息的重要工具。',
            'detail' => '塔羅的圖像象徵與直覺密切相關，透過本課程的基礎訓練，學員將能解讀牌義、掌握牌陣，進一步協助自我探索與他人諮詢。課程中不僅涵蓋大阿爾克那與小阿爾克那的結構，亦融入實務演練與心靈對話，幫助你建立個人風格的牌卡解讀能力。',
            'is_featured' => 1,
            'featured_image' => '主打課程1a2axq-d0uqq.webp',
        ]);
        
        Course::create([
            'name' => '靈氣療癒初階班',
            'category_id' => 2,
            'price' => 32000,
            'introduction' => '學習啟動靈氣，開啟自我療癒與能量平衡之路。',
            'detail' => '靈氣是一種源自宇宙的能量療癒技術，無需特定信仰即可學會。本課程透過傳授第一級靈氣點化與手部療癒技巧，引導學員感受能量流動，並能應用於日常生活中處理壓力、疼痛與情緒不穩。包含能量場的認識與自我淨化技巧。',
            'is_featured' => 0,
        ]);
        
        Course::create([
            'name' => '家居風水實戰班',
            'category_id' => 3,
            'price' => 30000,
            'introduction' => '運用風水調整空間磁場，提升家庭運勢與居家能量。',
            'detail' => '風水影響著財運、健康與人際和諧。本課程聚焦於實務應用，學員將學會如何觀察格局、定位五行方位、選擇吉位擺設，以及避開常見煞氣布局。課程包含居家平面圖解析與實地演練。',
            'is_featured' => 0,
        ]);
        
        Course::create([
            'name' => '紫微斗數入門班',
            'category_id' => 4,
            'price' => 28000,
            'introduction' => '透過命盤掌握人生趨勢與潛力方向。',
            'detail' => '紫微斗數為東方命理瑰寶，其命盤能揭示一個人的性格、運勢與人際關係。本課程教授命宮、身宮、十四主星的意義與相互作用，學員將能解析自己的命盤並初步解讀他人命盤走勢。課程採用大量範例，從實戰中學習。',
            'is_featured' => 0,
        ]);
        
        Course::create([
            'name' => '水晶能量與脈輪療癒',
            'category_id' => 4,
            'price' => 27000,
            'introduction' => '認識七大脈輪與對應水晶能量，進行內在平衡與淨化。',
            'detail' => '課程中將介紹七大脈輪的功能與失衡狀態，並教導如何使用不同水晶進行脈輪療癒與個人能量調整。學員將學會擺放、清理與充電水晶的方法，並能依照自身狀況搭配適合的療癒石。',
            'is_featured' => 0,
        ]);
        
        Course::create([
            'name' => '夢境解析與潛意識探索',
            'category_id' => 3,
            'price' => 24000,
            'introduction' => '夢境是潛意識與宇宙溝通的橋樑。',
            'detail' => '本課程帶你了解夢境的類型、常見符號與意義。透過心理分析與靈性視角，學員能記錄、解析並運用夢境訊息進行內在成長與療癒。課程亦教導如何透過冥想與儀式增強夢境清晰度與訊息接收力。',
            'is_featured' => 0,
        ]);
        
        Course::create([
            'name' => '靈魂藍圖人生使命探索',
            'category_id' => 1,
            'price' => 35000,
            'introduction' => '你為什麼出生？你真正的使命是什麼？',
            'detail' => '透過出生資料與靈性工具，學員將深入探索靈魂藍圖中所蘊藏的天賦與課題。課程包含業力理解、人生階段規劃與指導靈溝通基礎，協助學員釐清人生方向並活出靈魂契約。',
            'is_featured' => 0,
        ]);
        
        Course::create([
            'name' => '前世回溯工作坊',
            'category_id' => 2,
            'price' => 30000,
            'introduction' => '透過催眠技術探索前世記憶，釐清當代困境來源。',
            'detail' => '前世經驗常對今生造成潛在影響，從恐懼、關係到職涯都有可能源自過往的創傷或誓言。本課程透過安全且結構化的前世回溯引導，協助學員回顧前世經驗、進行釋放與療癒，重拾今生力量。',
            'is_featured' => 0,
        ]);
        
        Course::create([
            'name' => '占星中階：行星與相位解析',
            'category_id' => 1,
            'price' => 32000,
            'introduction' => '學習深入解析占星命盤中的行星關係與能量互動。',
            'detail' => '本課程延伸基礎占星知識，專注於行星在宮位中的作用與行星相位的力量與挑戰。學員將學會如何綜合解讀命盤、洞悉潛能與障礙，並應用於個人關係、職涯與心靈成長上。適合有占星基礎者進修。',
            'is_featured' => 0,
        ]);
        
        Course::create([
            'name' => '生命靈數與人際解析',
            'category_id' => 3,
            'price' => 26000,
            'introduction' => '透過出生數字了解自我性格與他人互動方式。',
            'detail' => '生命靈數揭示個人的核心特質與生命課題。本課程介紹數字與能量的連結，學員將學會如何透過生日計算出命運數、靈魂數與挑戰數，並學會應用於人際溝通與自我成長上，是職場與親密關係的實用工具。',
            'is_featured' => 0,
        ]);
        

 
    }
}
