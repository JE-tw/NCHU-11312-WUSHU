<!-- 可展開的卡片 -->
<!-- 用於 課程與服務頁 以及 課程介紹頁 -->
<!-- 卡片按鈕使用插槽傳入 -->

<script setup>
import { ref } from 'vue';
import dashIcon from '@/images/f-dash.png';
import plusIcon from '@/images/f-plus.png';
import LockButton from '@/components/CardButton.vue';

// 傳入 item 物件
const props = defineProps({
  name: String,
  introduction: String,
});

// 控制展開狀態
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
        <!-- 標題內容 -->
        <div class="ml-6">
          <p class="text-[16px]/[21px] sm:text-[24px]/[32px] font-bold  text-gray-800 ">
            {{ name }}
          </p>
        </div>
      </div>
      <!-- 課程影片按鈕 插槽要插入CardButton.vue -->
      <slot ></slot>
    </div>

    <!-- 描述文字 -->
    <div v-if="showDescription" class="whitespace-pre-line px-[16px]">
      <hr />
      <p class="text-[16px]/[21px] sm:text-[24px]/[32px] py-[16px] font-['Microsoft_JhengHei']  text-black sm:text-[24px]">
        {{ introduction }}
      </p>
    </div>
  </div>
</template>
