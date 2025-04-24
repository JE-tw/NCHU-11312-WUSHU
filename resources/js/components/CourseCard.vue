<!-- 服務與課程頁 課程卡片 -->
<script setup>
import VedicAstrology from '@/images/Vedic-Astrology.png';
import CartButton from './CartButton.vue';

defineProps({
  category: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <!-- 服務標題＋背景圖 -->
  <div class="bg-gray-500 bg-cover bg-center py-20" :style="{ backgroundImage: `url(${VedicAstrology})` }">
    <div class="flex flex-col items-center">
      <p class="pb-2 font-serif text-[32px] font-bold text-white sm:text-[64px]">{{ category.category }}</p>
      <p class="pb-2 font-serif text-[32px] text-white sm:text-[48px]">{{ category.en_category }}</p>
    </div>
  </div>
  <!-- 課程卡片 -->
  <div class="flex flex-wrap gap-[20px] bg-white px-[28px] pb-[60px] pt-[30px] sm:justify-center sm:px-[81px] sm:pt-[40px] xl:justify-start">
    <!-- 內容 -->
    <div
      v-for="course in category.course"
      :key="course.title"
      class="flex w-[100%] flex-col justify-between p-4 shadow-[0_0_5px_rgba(19,59,91,0.3)] xl:w-[412px]"
    >
      <div>
        <!-- 課程名稱 -->
        <p class="mb-2 text-[20px] font-semibold text-black sm:text-[32px]">{{ course.title }}</p>
        <!-- 課程描述 -->
        <p class="text-[16px] font-bold text-gray-500 sm:text-[24px]">{{ course.description }}</p>
      </div>
      <div>
        <!-- 價錢 -->
        <p class="flex justify-end py-[24px] text-[16px] font-bold text-blueGreen sm:text-[24px]">NT$ {{ course.price.toLocaleString() }}</p>
        <div class="flex justify-between">
          <!-- 類別標籤 -->
          <div class="flex items-center rounded-full bg-blue-900 px-[16px] py-[8px] text-[12px] text-white sm:text-[18px]">
            {{ category.category }}
          </div>
          <!-- 購物車按鈕（變版不會隱藏文字） -->
          <div><CartButton :hideText="false" :cartShorter="false" /></div>
        </div>
      </div>
    </div>
  </div>
</template>
