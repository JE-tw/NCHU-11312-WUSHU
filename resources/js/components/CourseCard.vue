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
      <p class="pb-2 font-serif text-[64px] font-bold text-white">{{ category.category }}</p>
      <p class="pb-2 font-serif text-[48px] text-white">{{ category.en_category }}</p>
    </div>
  </div>

  <div class="flex flex-wrap justify-start gap-[20px] bg-white px-[81px] pb-[60px] pt-[40px]">
    <div
      v-for="course in category.course"
      :key="course.title"
      class="flex w-[412px] flex-col justify-between p-4 shadow-[0_0_5px_rgba(19,59,91,0.3)]"
    >
      <div>
        <p class="mb-2 text-[32px] font-semibold text-black">{{ course.title }}</p>
        <p class="text-[24px] text-gray-500">{{ course.description }}</p>
      </div>
      <div>
        <p class="text-blueGreen my-2 flex justify-end text-[24px]">NT$ {{ course.price.toLocaleString() }}</p>
        <div class="flex justify-between">
          <div class="rounded-full bg-blue-900 px-[16px] py-[8px] text-white">{{ category.category }}</div>
          <div><CartButton /></div>
        </div>
      </div>
    </div>
  </div>
</template>
