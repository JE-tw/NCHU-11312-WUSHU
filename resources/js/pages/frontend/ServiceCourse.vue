<!-- ServiceCourse.vue 複層頁面 -->
<!-- 服務與課程頁 -->

<script setup>
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';
import CourseSection from '@/components/CourseSection.vue';
import ServiceCard from '@/components/ServiceCard.vue';

import swiper1 from '@/images/swiper1.webp';
import swiper2 from '@/images/swiper2.webp';
import swiper3 from '@/images/swiper3.webp';
import swiper4 from '@/images/swiper4.webp';
import swiper5 from '@/images/swiper5.webp';

const Images = [swiper2, swiper3, swiper4, swiper5];

const props = defineProps({
  services: Array,
  categories: Array,
});
console.log(props.services);
console.log(props.categories);

// 類別英文名稱陣列
const enTitles = ['Vedic Astrology', 'Chinese Medicine', 'Classical Magic', 'Other'];

// swiper
// 引入 Swiper Vue components
import { Swiper, SwiperSlide } from 'swiper/vue';

// 引入 Swiper 樣式
import 'swiper/css';
import 'swiper/css/navigation';

// 引入 Swiper 模組
import { Navigation } from 'swiper/modules';

// 使用的模組
const modules = [Navigation];
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
        <div class="p-4">
          <swiper :slidesPerView="3" :spaceBetween="30" :navigation="true" :modules="modules" class="mySwiper h-[201px] w-[80vw]">
            <swiper-slide><img :src="swiper1" alt="" /></swiper-slide>
            <swiper-slide><img :src="swiper2" alt="" /></swiper-slide>
            <swiper-slide><img :src="swiper3" alt="" /></swiper-slide>
            <swiper-slide><img :src="swiper4" alt="" /></swiper-slide>
            <swiper-slide><img :src="swiper5" alt="" /></swiper-slide>
          </swiper>
        </div>
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
      <ServiceCard v-for="(item, index) in props.services" :key="index" :item="item" />
    </div>

    <!-- 課程區塊 -->
    <CourseSection
      v-for="(category, index) in props.categories"
      :key="category.id"
      :bgImage="Images[index]"
      :name="category.name"
      :enTitle="enTitles[index]"
      :courses="category.courses"
    >
      <!-- 類別英文名稱 enTitle 資料庫沒有建到，故用插槽+陣列 -->
      <p class="z-30 font-serif text-[32px]/[46px] text-white sm:text-[52px]/[75px] xl:text-[48px]/[69px]">{{ enTitles[index] }}</p>
    </CourseSection>
  </div>
  <Footer />
</template>

<style>
.swiper-slide {
  text-align: center;
  font-size: 18px;
  background: #fff;

  /* Center slide text vertically */
  display: flex;
  justify-content: center;
  align-items: center;
}

.swiper-slide img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
