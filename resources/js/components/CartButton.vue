<!-- 購物車按鈕 -->
<!-- 變版不隱藏文字 <CartButton :hideText="false" :cartShorter="false" /> -->
 
<script setup>
import smallcart from '@/images/f-smallCart.png';

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
  <button
    type="button"
    :class="[
      'flex items-center justify-center rounded-full bg-blueGreen',
      cartShorter ? 'h-[32px] w-[32px] sm:h-[40px] sm:w-[178px]' :'h-[32px] w-[120px] sm:h-[40px] sm:w-[178px]',
    ]"
  >
    <!-- 購物車圖片 -->
    <img :src="smallcart" alt="small cart" class="h-[16px] w-[16px] mr-3 sm:mr-4 sm:h-[24px] sm:w-[24px]" />
    <!-- 文字：加入購物車 -->
    <span :class="hideText ? 'hidden text-white text-[18px] sm:block' :  'text-[12px] sm:text-[18px] text-white'">加入購物車</span>
  </button>
</template>
