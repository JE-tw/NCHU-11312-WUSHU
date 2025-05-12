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
  showSearch: Boolean,
  searchPlaceholder: String,
  sortKey: String,
  sortDirection: String,
});

const emit = defineEmits(['search', 'pageChange', 'sortChange']);

const search = ref('');
const onSearch = () => {
  emit('search', search.value);
};

const changePage = (page) => {
  emit('pageChange', page);
};

// 排序邏輯
const currentSortKey = ref(props.sortKey || '');
const currentSortDirection = ref(props.sortDirection === 'desc' ? 'desc' : 'asc');

watch(
  () => [props.sortKey, props.sortDirection],
  ([newKey, newDir]) => {
    currentSortKey.value = newKey || '';
    currentSortDirection.value = newDir === 'desc' ? 'desc' : 'asc';
  },
);

const toggleSort = (key) => {
  if (currentSortKey.value === key) {
    currentSortDirection.value = currentSortDirection.value === 'asc' ? 'desc' : 'asc';
  } else {
    currentSortKey.value = key;
    currentSortDirection.value = 'asc';
  }

  emit('sortChange', {
    sortKey: currentSortKey.value,
    sortDirection: currentSortDirection.value,
  });
};
</script>

<template>
  <div>
    <!-- 搜尋框 -->
    <div v-if="showSearch" class="mb-4">
      <input v-model="search" :placeholder="searchPlaceholder || '搜尋...'" class="rounded-md border px-3 py-1" />
      <button @click="onSearch" class="ml-2 rounded bg-gray-700 px-2 py-1 text-white">搜尋</button>
    </div>

    <!-- 表格 -->
    <table class="w-full table-auto border ">
      <thead class="bg-gray-100">
        <tr>
          <th v-for="col in columns" :key="col.key" class="bg-darkGray text-white cursor-pointer border p-2" @click="col.sortable && toggleSort(col.key)">
            {{ col.label }}
            <span v-if="col.sortable">
              <span v-if="currentSortKey === col.key">
                {{ currentSortDirection === 'asc' ? '▲' : '▼' }}
              </span>
              <span v-else class="text-gray-400">⇅</span>
            </span>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="!items || items.length === 0">
          <td :colspan="columns.length" class="border p-4 text-center text-gray-500">查無資料</td>
        </tr>
        <tr v-for="item in items" :key="item.id">
          <td v-for="col in columns" :key="col.key" class="border p-2">
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
