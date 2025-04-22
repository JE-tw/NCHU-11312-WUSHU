<script setup>
import smallcart from "@/images/f-smallCart.png";
</script>
<template>
  <button type="button" class="w-[32px] h-[32px] sm:w-[178px] sm:h-[40px] bg-blue-500 flex justify-center items-center rounded-full">
    <img :src="smallcart" alt="small cart" class="w-[16px] h-[16px] sm:w-[24px] sm:h-[24px] sm:mr-4  ">
    <span class="hidden sm:block text-white">加入購物車</span>
    </button>
</template>
