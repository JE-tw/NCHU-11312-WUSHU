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
  <button type="button"     :class="[
      'bg-blueGreen flex items-center justify-center rounded-full',
      cartShorter
        ? 'h-[32px] w-[32px] sm:h-[40px] sm:w-[178px]'
        : 'h-[40px] w-[178px]'
    ]">
    <img :src="smallcart" alt="small cart" class="h-[16px] w-[16px] sm:mr-4 sm:h-[24px] sm:w-[24px]" />
    <span :class="hideText ? 'hidden text-white sm:block' : 'text-white'">加入購物車</span>
  </button>
</template>
