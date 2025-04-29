<!-- 服務與課程頁 課程卡片 -->
<script setup>
import CartButton from './CartButton.vue';

defineProps({
  category: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <!-- 課程卡片 -->
  <div class="flex flex-wrap gap-[10px] bg-white sm:justify-center xl:justify-start">
    <!-- 內容 -->
    <div class="flex w-[100%] flex-col justify-between p-4 shadow-[0_0_5px_rgba(19,59,91,0.3)] xl:w-[412px]">
      <div>
        <!-- 課程名稱 -->
        <p class="mb-2 text-[20px] font-semibold text-black sm:text-[32px]">1234</p>
        <!-- 課程描述 -->
        <p class="text-[16px] font-bold text-gray-500 sm:text-[24px]">bbbbbb</p>
      </div>
      <div>
        <!-- 價錢 -->
        <p class="flex justify-end py-[24px] text-[16px] font-bold text-blueGreen sm:text-[24px]">NT$ ccccc</p>
        <div class="flex justify-between">
          <!-- 類別標籤 -->
          <div class="flex items-center rounded-full bg-blue-900 px-[16px] py-[8px] text-[12px] text-white sm:text-[18px]">ddddd</div>
          <!-- 購物車按鈕（變版不會隱藏文字） -->
          <div><CartButton :hideText="false" :cartShorter="false" /></div>
        </div>
      </div>
    </div>
  </div>
  
</template>
