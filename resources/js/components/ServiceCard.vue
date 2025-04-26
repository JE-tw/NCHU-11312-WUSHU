<!-- 服務與課程頁 服務卡片 -->
<script setup>
import dashIcon from '@/images/f-dash.png';
import plusIcon from '@/images/f-plus.png';
import { ref } from 'vue';

import CartButton from './CartButton.vue';

defineProps({
  item: {
    type: Object,
    required: true,
  },
});

// 展開/卡片
const showDescription = ref(false);
const toggleDescription = () => {
  showDescription.value = !showDescription.value;
};
</script>

<template>
  <div
    @click="toggleDescription"
    class="duration-800 mb-4 cursor-pointer shadow-[0_0_5px_rgba(0,0,0,0.2)] transition-colors"
    :class="showDescription ? 'bg-lightGray' : 'bg-white'"
  >
    <div class="flex items-center justify-between p-4">
      <div class="flex items-center">
        <!-- 展開/收合圖示 -->
        <button @click.stop="toggleDescription" class="h-8 w-8">
          <img :src="showDescription ? dashIcon : plusIcon" alt="toggle" class="cursor-pointer object-contain" />
        </button>
        <!-- 卡片內容 -->
        <div class="ml-6">
          <!-- 標題 -->
          <p class="text-[20px] font-bold text-gray-800 sm:text-[32px]/[42px]">{{ item.title }}</p>
          <!-- 價格 -->
          <p v-if="item.price" class="text-[16px] font-bold text-blueGreen sm:text-[24px]/[32px]">NT$ {{ item.price.toLocaleString() }}</p>
        </div>
      </div>
      <!-- 購物車按鈕 -->
      <CartButton />
    </div>

    <!-- 描述文字 -->
    <div v-if="showDescription" class="whitespace-pre-line px-[16px]">
      <hr />
      <p class="py-[16px] font-['Microsoft_JhengHei'] text-[16px] text-black sm:text-[24px]">
        {{ item.description }}
      </p>
    </div>
  </div>
</template>
