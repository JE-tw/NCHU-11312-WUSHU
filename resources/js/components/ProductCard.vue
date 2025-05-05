<!-- 引入到Cart.vue -->
<script setup>
// 定義 props
const props = defineProps({
  id: Number,
  title: String,
  price: String,
});
</script>

<template>
  <div>
    <div class="py-4 sm:flex sm:justify-between sm:px-[20px] sm:py-[16px]">
      <div class="mb-2 flex text-[20px]/[27px] sm:mb-0 sm:text-[28px]/[37px] xl:text-[32px]/[43px]">
        <span class="mx-6 shrink-0 font-bold tracking-tight text-darkGray sm:mx-0 sm:mr-[60px]">{{ props.id }}</span>
        <span class="font-bold tracking-tight text-black">{{ props.title }}</span>
      </div>
      <div class="pr-24px flex shrink-0 items-center justify-between pl-[60px] sm:pl-4">
        <span v-if="props.price" class="text-[16px]/[21px] font-bold text-blueGreen sm:mr-[60px] sm:text-[24px]/[32px]"> NT${{ props.price }} </span>
        <slot></slot>
      </div>
    </div>
    <hr class="border-0.5 border-mediumGray" />
  </div>
</template>
