<script setup>
import { ref, defineProps, defineEmits, watch } from 'vue';

const props = defineProps({
  columns: {
    type: Array,
    required: true,
  },
  items: Array,
  totalPages: Number,
  currentPage: Number,
});

const emit = defineEmits(['pageChange']);

const changePage = (page) => {
  emit('pageChange', page);
};
</script>

<template>
  <div class="mx-auto max-w-3xl bg-white rounded  border border-gray-200 p-6">
    <div class="flex justify-between">
      <h2 class="mb-6 text-2xl font-bold">購買紀錄</h2>
      <h1 class="text-md mb-0 font-bold text-gray-500">僅保留6個月內資料</h1>
    </div>
    <!-- 表格 -->
    <table class="min-w-full border border-gray-200">
      <thead class="bg-gray-100">
        <tr>
          <th v-for="col in columns" :key="col.key" class="border bg-[#518C95] px-4 py-3 text-white">
            {{ col.label }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="!items || items.length === 0">
          <td :colspan="columns.length" class="border border-gray-400  p-4 text-center text-gray-500">查無資料</td>
        </tr>
        <tr v-for="item in items" :key="item.id">
          <td v-for="col in columns" :key="col.key" class="border border-gray-400 p-2 ">
            <slot v-if="$slots[`cell(${col.key})`]" :name="`cell(${col.key})`" :item="item" />
            <template v-else>
              {{ item[col.key] }}
            </template>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- 分頁 -->
    <div class="mt-4 flex justify-center space-x-2">
      <button
        v-for="page in totalPages"
        :key="page"
        @click="changePage(page)"
        :class="['rounded border px-3 py-1', currentPage === page ? 'bg-blue-500 text-white' : '']"
      >
        {{ page }}
      </button>
    </div>
  </div>
</template>
