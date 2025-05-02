<!-- section -->
<!-- components/CourseSection.vue 課程區塊 -->
<script setup>
import CourseCard from '@/components/CourseCard.vue';

const props = defineProps({
  bgImage: String,
  name: String,
  enTitle: String,
  courses: Array,
  id: String,
});
</script>
<template>
  <section :id="id">
    <!-- 課程標題＋背景圖 -->
    <div class="relative bg-cover bg-center py-[54px] sm:h-[320px] sm:py-[80px]" :style="{ backgroundImage: `url(${bgImage})` }">
      <div class="absolute inset-0 bg-black/70"></div>
      <div class="flex flex-col items-center font-bold">
        <p class="z-30 font-serif text-[32px]/[46px] font-bold text-white sm:text-[52px]/[75px] xl:text-[64px]/[92px]">{{ name }}</p>
        <!-- <p class="z-30 font-serif text-[32px]/[46px] text-white sm:text-[52px]/[75px] xl:text-[48px]/[69px]">{{ enTitle }}</p> -->
        <!-- 類別英文名稱 enTitle 資料庫沒有建到，故用插槽+陣列 -->
        <slot></slot>
      </div>
    </div>
    <!-- 課程卡片容器 -->
    <div class="px-[24px] py-[60px] sm:px-[120px]">
      <div class="grid grid-cols-1 gap-[24px] xl:grid-cols-3">
        <!-- 課程卡片 -->
        <CourseCard
          v-for="item in courses"
          :key="item.id"
          :id="item.id"
          :name="item.name"
          :price="item.price"
          :introduction="item.introduction"
          :categoryTitle="name"
        />
      </div>
    </div>
  </section>
</template>
