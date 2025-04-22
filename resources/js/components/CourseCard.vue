<script setup>
import VedicAstrology from "@/images/Vedic-Astrology.png";
import CartButton from "./CartButton.vue";

defineProps({
  category: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <!-- 服務標題＋背景圖 -->
  <div class="bg-gray-500 bg-cover bg-center py-20 " :style="{ backgroundImage: `url(${VedicAstrology})` }">
    <div class="flex flex-col items-center">
      <p class="text-[64px] pb-2 text-white font-bold font-serif ">{{ category.category }}</p>
      <p class="text-[48px] pb-2 text-white font-serif">{{ category.en_category }}</p>
    </div>
  </div>

  <div class="flex flex-wrap justify-start gap-[20px] pt-[40px] px-[81px] pb-[60px] bg-white">
    <div
      v-for="course in category.course"
      :key="course.title"
      class="shadow-[0_0_5px_rgba(19,59,91,0.3)] w-[412px] p-4 flex flex-col justify-between"
    >
      <div>
        <p class="text-[32px] font-semibold mb-2 text-black">{{ course.title }}</p>
        <p class="text-[24px] text-gray-500 ">{{ course.description }}</p>
      </div>
      <div>
        <p class="text-[24px] text-blue-500 my-2 flex justify-end">
          NT$ {{ course.price.toLocaleString() }}
        </p>
        <div class="flex justify-between">
          <div class="px-[16px] py-[8px] bg-blue-900 text-white rounded-full">{{ category.category }}</div>
          <div><CartButton /></div>
        </div>
      </div>
    </div>
  </div>
</template>
