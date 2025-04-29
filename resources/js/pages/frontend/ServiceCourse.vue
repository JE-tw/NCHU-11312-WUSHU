<!-- ServiceCourse.vue 複層頁面 -->
<!-- 服務與課程頁 -->

<script setup>
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';
import CourseSection from '@/components/CourseSection.vue';
import CourseCard from '@/components/CourseCard.vue';
import ServiceCard from '@/components/ServiceCard.vue';
import { courseItems } from '@/data/courseItems.js'; // course card資料
import { serviceItems } from '@/data/serviceItems.js'; // service card資料

import swiper1 from '@/images/swiper1.webp';
import swiper2 from '@/images/swiper2.webp';
import swiper3 from '@/images/swiper3.webp';
import swiper4 from '@/images/swiper4.webp';

const swiperImages = [swiper1, swiper2, swiper3, swiper4];
</script>

<template>
  <Header />
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
    <div class="relative bg-cover bg-center py-[54px] sm:h-[320px] sm:py-[80px]" :style="{ backgroundImage: `url(${swiper1})` }">
      <div class="absolute inset-0 bg-black/80"></div>
      <div class="flex flex-col items-center">
        <p class="z-30 font-serif text-[32px] font-bold text-white sm:text-[64px]">服務</p>
        <p class="z-30 font-serif text-[32px] text-white sm:text-[48px]">Service</p>
      </div>
    </div>
    <!-- 服務卡片 -->
    <div class="bg-gray-100 px-[4.5%] pb-[44px] pt-[30px] xl:px-[19%] xl:pb-[96px] xl:pt-[60px]">
      <ServiceCard v-for="(item, index) in serviceItems" :key="index" :item="item" />
    </div>

    <!-- 課程區塊 -->
    <CourseSection
      v-for="(category, index) in courseItems"
      :key="category.categoryId"
      :bgImage="swiperImages[index]"
      :title="category.title"
      :enTitle="category.enTitle"
      :courses="category.course"
    />
  </div>
  <Footer />
</template>
