<script setup>
import CourseCard from '@/components/CourseCard.vue';
import ServiceCard from '@/components/ServiceCard.vue';
import { courseItems } from '@/data/courseItems.js'; // course card資料
import { serviceItems } from '@/data/serviceItems.js'; // service card資料

import service from '@/images/service-bg.png';
</script>

<template>
  <div>
    <!-- header -->
    <header class="flex justify-center bg-black">
      <div class="pb-[60px]sm:pb-[120px] flex flex-col pt-[120px] sm:pt-[224px]">
        <div class="flex flex-col items-center">
          <p class="pb-2 font-serif text-[32px]/[46px] font-bold text-white sm:text-[64px]/[92px]">服務與課程</p>
          <span class="mb-20 w-[120px] border-b-2 border-white sm:w-[300px]"></span>
        </div>
        <!-- swiper -->
      </div>
    </header>

    <!-- 服務 -->
    <div class="bg-cover bg-center py-[54px] sm:h-[320px] sm:py-[80px]" :style="{ backgroundImage: `url(${service})` }">
      <div class="flex flex-col items-center">
        <p class="font-serif text-[32px] font-bold text-white sm:text-[64px]">服務</p>
        <p class="font-serif text-[32px] text-white sm:text-[48px]">Service</p>
      </div>
    </div>
    <!-- 服務卡片 -->
    <div class="pt-[30px] px-[4.5%] pb-[44px] xl:px-[19%] xl:pb-[96px] xl:pt-[60px] bg-gray-100">
      <ServiceCard v-for="(item, index) in serviceItems" :key="index" :item="item" />
    </div>

    <!-- 課程區塊 -->
    <div class="">
      <CourseCard v-for="category in courseItems" :key="category.categoryId" :category="category" />
    </div>
  </div>
</template>
