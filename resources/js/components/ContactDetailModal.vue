<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  contact: Object,
});

const emit = defineEmits(['close']);

function formatDate(datetime) {
  return new Date(datetime).toLocaleDateString('zh-TW');
}
</script>

<template>
  <div v-if="contact" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="relative w-full max-w-md bg-white shadow-lg">
      <!-- 標題列 -->
      <div class="flex items-center justify-between bg-darkGray p-2 text-white shadow-sm">
        <h2 class="text-xl">詳細內容</h2>
        <button class="cursor-pointer border bg-lightGray px-1 text-gray-500 hover:text-gray-700" @click="$emit('close')">✕</button>
      </div>

      <!-- 資料內容 -->
      <table class="w-full border border-gray-300 text-left">
        <tbody>
          <tr>
            <th class="w-20 border bg-gray-100 px-4 py-2">日期</th>
            <td class="border px-4 py-2">{{ formatDate(contact.created_at) }}</td>
          </tr>
          <tr>
            <th class="w-20 border bg-gray-100 px-4 py-2">姓名</th>
            <td class="border px-4 py-2">{{ contact.name }}</td>
          </tr>
          <tr>
            <th class="w-20 border bg-gray-100 px-4 py-2">電話</th>
            <td class="border px-4 py-2">{{ contact.phone }}</td>
          </tr>
          <tr>
            <th class="w-20 border bg-gray-100 px-4 py-2">Email</th>
            <td class="border px-4 py-2">{{ contact.email }}</td>
          </tr>
          <tr>
            <th class="w-20 border bg-gray-100 px-4 py-2">主旨</th>
            <td class="border px-4 py-2">{{ contact.title }}</td>
          </tr>
          <tr>
            <td colspan="2" class="border px-4 py-2 col-span-2">
              <div class="max-h-40 overflow-y-auto whitespace-pre-wrap">
                {{ contact.content }}
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
