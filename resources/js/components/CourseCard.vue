<!-- components/CourseCard.vue 課程卡片 -->
<script setup>
import CartButton from './CartButton.vue';
import { router } from '@inertiajs/vue3';

defineProps({
  id: Number,
  name: String,
  price: Number,
  introduction: String,
  categoryTitle: String, // tag
});

// 點擊跳轉 詳細資訊頁
function goToIntro(id) {
  router.visit(route('wushu.intro', id));
}
</script>

<template>
  <!-- 課程卡片 -->
  <div @click="goToIntro(id)" class="flex cursor-pointer gap-[10px] bg-white sm:justify-center xl:justify-start">
    <!-- 內容 -->
    <div class="flex w-[100%] flex-col justify-between p-4 shadow-custom xl:w-[412px]">
      <div>
        <!-- 課程名稱 -->
        <p class="mb-2 text-[20px] font-semibold text-black sm:text-[32px]">{{ name }}</p>
        <!-- 課程描述 -->
        <p class="text-[16px] font-normal text-gray-500 sm:text-[24px] sm:font-bold">{{ introduction }}</p>
      </div>
      <div>
        <!-- 價錢 -->
        <p class="flex justify-end py-[24px] text-[16px] font-bold text-blueGreen sm:text-[24px]">NT${{ price.toLocaleString() }}</p>
        <div class="flex justify-between">
          <!-- 類別標籤 -->
          <div class="flex items-center rounded-full bg-blue-900 px-[16px] py-[8px] text-[12px] text-white sm:text-[18px]">{{ categoryTitle }}</div>
          <!-- 購物車按鈕（變版不會隱藏文字） -->
          <!-- <div><CartButton :hideText="false" :cartShorter="false" /></div> -->
          <div>
            <CartButton 
                :productId="id.toString()" 
                :productName="name" 
                :price="price" 
                :productType=2
                :cartShorter="false" 
                :hideText="false" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
