<!-- 可展開的卡片的 卡片按鈕 -->
<!-- 用於 課程與服務頁 以及 課程介紹頁 的可展開的卡片組件 ExpandCard.vue -->
<!-- 文字及icon 為插槽 -->

<!-- 變版不隱藏文字 <CardButton :hideText="false" :cartShorter="false" /> -->
<script setup>
defineProps({
  hideText: {
    type: Boolean,
    default: true,
  },
  cartShorter: {
    type: Boolean,
    default: true,
  },
});
</script>
<template>
  <a
    href="https://youtu.be/aHuItwXi4bw?si=vMMXTnslt9j9szTg"
    target="_blank"
    :class="[
      'flex items-center justify-center',
      cartShorter ? 'h-[32px] w-[32px] sm:h-[40px] sm:w-[178px]' : 'h-[32px] w-[120px] sm:h-[40px] sm:w-[178px]',
    ]"
  >
    <!-- 按鈕icon圖片插槽 -->
    <slot name="icon"></slot>
    <!-- 按鈕文字插槽 -->
    <!-- <slot name="text"></slot> -->
    <!-- 文字：課程影片 -->
    <span :class="hideText ? 'hidden text-[18px] text-white sm:block' : 'text-[12px] text-white sm:text-[18px]'">課程影片</span>
  </a>
</template>
