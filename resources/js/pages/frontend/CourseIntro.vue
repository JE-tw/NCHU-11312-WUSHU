<!-- 課程介紹頁 -->
<script setup>
import CartButton from '@/components/CartButton.vue';

// test
import CourseVideoList from '@/components/CourseVideoList.vue';
import { ref } from 'vue';

// 假資料：你實際上可能是從 API 拿來
const course = ref({
  title: '金融占星進階班',
  description: '這門課會帶你探索星象與市場週期的神秘關聯。',
  videos: [
    { id: 1, title: '第1堂：市場與行星週期', locked: true },
    { id: 2, title: '第2堂：金融事件案例解析', locked: true },
    // ...
  ],
});

const isPurchased = ref(false);

function addToCart() {
  console.log('加入購物車！');
  // 實際上應該呼叫購物車邏輯
}
</script>

<template>
  <div class="bg-softGray">
    <!-- header -->
    <header class="flex h-[234px] flex-col items-center bg-black sm:h-[323px] xl:h-[444px]">
      <!-- 課程名稱 -->
      <p
        class="pt-[120px] font-serif text-[32px]/[46px] font-bold text-grayWhite sm:pt-[160px] sm:text-[52px]/[75px] xl:pt-[224px] xl:text-[64px]/[92px]"
      >
        吠陀占星基礎
      </p>
      <span class="mb-[60px] w-[120px] border-b-2 border-grayWhite sm:mb-[80px] sm:w-[300px] xl:mb-[120px]"></span>
    </header>
    <main class="h-auto px-[24px]">
      <div class="flex flex-col items-end">
        <!-- 價錢 -->
        <p
          class="mb-[12px] mt-[30px] text-[20px]/[26.6px] font-bold text-blueGreen sm:mb-[16px] sm:mt-[60px] sm:text-[28px]/[37px] xl:mb-[12px] xl:text-[32px]/[43px]"
        >
          NT$ 40000
        </p>
        <!-- 加入購物車案紐 -->
        <div></div>
        <CartButton :hideText="false" :cartShorter="false" class="h-[32px] w-[120px]" />
      </div>
      <p class="mb-[24px] mt-[32px] text-[20px]/[26.6px] font-bold text-blueGreen sm:my-[24px] sm:text-[36px]/[44px]">課程介紹:</p>
      <!-- 課程介紹 -->
      <p class="text-[16px] text-black sm:text-[24px]">
        （購買課程後，助教會聯繫您提供課程講義檔案。如課程有任何問題都可以和助教提問！）傳授吠陀占星的必備知識和文化源流。包含吠陀九星詳述；各星namah
        mantra的傳授以及格局（瑜珈）以及各宮位的解釋和預測方法，也是全台第一個教Panchang（吠陀曆）的吠陀占星課。有任何問題可以聯繫助教 Line id:
        joe9718
      </p>
      <p class="mb-[20px] mt-[30px] text-[16px]/[28px] font-bold text-blueGreen sm:mb-[24px] sm:mt-[40px] sm:text-[24px]/[32px]">
        付費課程，將於購買後解鎖。
      </p>
      <!-- 課程列表 -->
    </main>

    <!-- 課程列表test -->
    <div class="mx-auto max-w-4xl px-4 py-8">

      <!-- 課程影片列表 -->
      <section>
        <h2 class="mb-4 text-2xl font-semibold">課程影片</h2>
        <CourseVideoList :videos="course.videos" :purchased="isPurchased" />
      </section>
    </div>
  </div>
</template>
