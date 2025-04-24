<!-- 影片卡片清單 -->
<!-- 嵌入影片卡片CourseVideoCard.vue -->
<script setup>
import CourseVideoCard from '@/components/CourseVideoCard.vue';
defineProps({
  videos: Array,
  purchased: Boolean,
});

</script>
<template>
  <div class="md:grid-cols-2 grid grid-cols-1 gap-4">
    <CourseVideoCard v-for="video in videos" :key="video.id" :video="video" :purchased="purchased" />
  </div>
</template>
