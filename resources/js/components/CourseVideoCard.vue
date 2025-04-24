<!-- 單一影片卡片 -->
<script setup>
import { defineProps } from 'vue'
import { Lock as IconLock, Unlock as IconUnlock } from 'lucide-vue-next'

defineProps({
  video: Object,
  purchased: Boolean,
})
</script>

<template>
  <div class="border p-4 rounded-xl shadow hover:shadow-lg transition">
    <div class="flex items-center justify-between mb-2">
      <h3 class="font-semibold">{{ video.title }}</h3>
      <IconLock v-if="video.locked && !purchased" />
      <IconUnlock v-else />
    </div>
    <p class="text-sm text-gray-500">預覽內容或簡介可放這</p>
  </div>
  </template>

  