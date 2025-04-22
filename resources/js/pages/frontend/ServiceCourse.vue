<script setup>
import ServiceCard from '@/components/ServiceCard.vue';
import { serviceItems } from '@/data/serviceItems.js'; // service card資料
import CourseCard from "@/components/CourseCard.vue";
import { courseItems } from "@/data/courseItems.js"; // course card資料

import service from '@/images/service.png';
</script>

<template>
  <div>
    <!-- header -->
    <header class="flex justify-center bg-black">
      <div class="flex flex-col pb-[120px] pt-[224px]">
        <div class="flex flex-col items-center">
          <p class="pb-2 font-serif text-[64px]/[92px] font-bold text-white">服務與課程</p>
          <span class="mb-20 w-[300px] border-b-2 border-white"></span>
        </div>
        <!-- swiper -->
      </div>
    </header>

    <!-- 服務 -->
    <div class="h-[320px] bg-cover bg-center py-20" :style="{ backgroundImage: `url(${service})` }">
      <div class="flex flex-col items-center">
        <p class="pb-2 font-serif text-[64px] font-bold text-white">服務</p>
        <p class="pb-2 font-serif text-[48px] text-white">Service</p>
      </div>
    </div>
    <!-- 服務卡片 -->
    <div class="bg-gray-100 xl:px-[19%] xl:pb-[96px] xl:pt-[60px]">
      <ServiceCard v-for="(item, index) in serviceItems" :key="index" :item="item" />
    </div>

    <!-- 課程區塊 -->
    <div class="">
      <CourseCard v-for="category in courseItems" :key="category.categoryId" :category="category" />
    </div>
  </div>
</template>
