<!-- 課程介紹頁 -->
<script setup>
import CartButton from '@/components/CartButton.vue';
import lock from '@/images/f-lock.png';

// TEST
import ExpandCard from '@/components/ExpandCard.vue';
// 課程卡假資料
const courses = [
  { title: '1-1(29:00)', description: '1-1' },
  { title: '1-2(20:31)', description: '1-2' },
  { title: '1-3(29:00)', description: '1-3' },
  { title: '1-4(23:18)', description: '1-4' },
];

//
import LockButton from '@/components/CardButton.vue';
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
      <!-- 傳入插槽 ExpandCard.vue 並傳入插槽中的插槽CardBtn-->
      <ExpandCard v-for="(item, index) in courses" :key="index" :item="item">
        <!-- 傳入插槽 CardButton 插槽放 -->
        <LockButton :hideText="false" :cartShorter="false">
          <!-- 按鈕icon -->
          <template #icon>
            <img :src="lock" alt="lock" class="mr-3 h-[16px] w-[16px] sm:mr-4 sm:h-[24px] sm:w-[24px]" />
          </template>
          <!-- 按鈕文字 -->
          <template #text>
            <span :class="hideText ? 'hidden text-[18px] text-white sm:block' : 'text-[12px] text-white sm:text-[18px]'">課程影片</span>
          </template>
        </LockButton>
      </ExpandCard>
    </main>
  </div>
</template>
