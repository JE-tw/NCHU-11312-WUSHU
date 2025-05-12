<!-- ServiceCourse.vue 複層頁面 -->
<!-- 服務與課程頁 -->
<script setup>
import Header from '@/components/Header.vue';
import Footer from '@/components/Footer.vue';
import CourseSection from '@/components/CourseSection.vue';
import ServiceCard from '@/components/ServiceCard.vue';
import BackToTop from '@/components/BackToTop.vue'

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

// swiper圖片張數
const breakpoints = {
  0: {
    slidesPerView: 2.5,
  },
  1270: {
    slidesPerView: 4,
  },
};

const sections = [
  { id: 'vedic', title: '吠陀占星', img: swiper2 },
  { id: 'chinese', title: '中醫', img: swiper3 },
  { id: 'magic', title: '魔法', img: swiper4 },
  { id: 'other', title: '其他', img: swiper5 },
];

function scrollTo(targetId) {
  const el = document.getElementById(targetId);
  if (el) {
    el.scrollIntoView({ behavior: 'smooth' });
  }
}
</script>

<template>
  <Header />
  <div>
    <!-- header -->
    <header class="flex justify-center bg-black">
      <div class="flex flex-col pb-[60px] pt-[120px] sm:pb-[120px] sm:pt-[224px]">
        <div class="flex flex-col items-center">
          <p class="pb-2 font-serif text-[32px]/[46px] font-bold text-white sm:text-[64px]/[92px]">服務與課程</p>
          <span class="mb-20 w-[120px] border-b-2 border-white sm:w-[300px]"></span>
        </div>
        <!-- swiper -->
        <div class="flex items-start">
          <swiper
            :slidesPerView="4"
            :spaceBetween="30"
            :navigation="true"
            :modules="modules"
            :breakpoints="breakpoints"
            class="mySwiper h-auto w-[324px] sm:w-[584px] xl:w-[70vw]"
          >
            <!-- 服務 swiper -->
            <swiper-slide @click="scrollTo('service-section')">
              <div class="cursor-pointer text-center">
                <img :src="swiper1" alt="" class="mb-2 aspect-[4/3] h-[90px] sm:mb-4 sm:h-[150px]" />
                <p class="text-[20px] font-bold text-white sm:text-[28px]/[37px] xl:text-[32px]/[43px]">服務</p>
              </div>
            </swiper-slide>
            <!-- 課程 swiper -->
            <swiper-slide v-for="(item, index) in sections" :key="index">
              <div @click="scrollTo(`section-${index}`)" class="cursor-pointer text-center">
                <img :src="item.img" class="mb-2 aspect-[4/3] h-[90px] sm:mb-4 sm:h-[150px]" />
                <p class="text-[20px] font-bold text-white sm:text-[28px]/[37px] xl:text-[32px]/[43px]">{{ item.title }}</p>
              </div>
            </swiper-slide>
          </swiper>
        </div>
      </div>
    </header>

    <!-- 服務 -->
    <div id="service-section" class="relative bg-cover bg-center py-[54px] sm:h-[320px] sm:py-[80px]" :style="{ backgroundImage: `url(${swiper1})` }">
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
      :id="`section-${index}`"
    >
      <!-- 類別英文名稱 enTitle 資料庫沒有建到，故用插槽+陣列 -->
      <p class="z-30 font-serif text-[32px]/[46px] text-white sm:text-[52px]/[75px] xl:text-[48px]/[69px]">{{ enTitles[index] }}</p>
    </CourseSection>
  </div>
  <BackToTop />
  <Footer />
</template>

<style>
.swiper-slide {
  text-align: center;
  font-size: 18px;
  /* Center slide text vertically */
  display: flex;
  justify-content: center;
  align-items: center;
}

.swiper-slide img {
  display: block;
  object-fit: cover;
}

.swiper-button-next {
  display: none;
}
.swiper-button-prev {
  display: none;
}

@screen xl {
  /* 1280px 以上適用 */
  .swiper-button-next {
    position: absolute;
    display: block;
    top: 30%;
    right: 15px;
    color: #b5b5b5;
    width: auto;
  }
  .swiper-button-next:after {
    display: flex;
    background-color: #363636;
    border-radius: 100px 0 0 100px;
    width: 40px;
    height: 80px;
    justify-content: flex-end;
    align-items: center;
  }
  .swiper-button-prev {
    display: block;
    color: #b5b5b5;
    width: auto;
    top: 30%;
    left: 15px;
    position: absolute;
  }
  .swiper-button-prev:after {
    display: flex;
    background-color: #363636;
    border-radius: 0 100px 100px 0;
    width: 40px;
    height: 80px;
    align-items: center;
  }
}
</style>
