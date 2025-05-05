<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import TableWithPagination from '@/Components/TableWithPagination.vue';
import { useTableController } from '@/composables/useTableController';

// const courses = page.props.courses;
const { items, currentPage, totalPages, searchQuery, currentSortKey, currentSortDirection, handleSearch, handlePageChange, handleSortChange } =
  useTableController('courses', 'admin.course.list'); // 名稱依照 controller 傳的變數與 route 命名
const columns = [
  { label: '主打課程', key: 'is_featured', sortable: true },
  { label: '課程名稱', key: 'name' },
  { label: '金額', key: 'price', sortable: true },
  { label: '課程類別', key: 'category_name', sortable: true },
  { label: '簡介', key: 'introduction' },
  { label: '操作', key: 'actions' },
];
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div>
      <h1 class="mb-4 text-2xl font-bold">子課程列表</h1>
      <button type="button" class="mb-4 border p-2">新增課程</button>
      <TableWithPagination
        :columns="columns"
        :items="items"
        :current-page="currentPage"
        :total-pages="totalPages"
        :show-search="false"
        :sort-key="currentSortKey"
        :sort-direction="currentSortDirection"
        @search="handleSearch"
        @pageChange="handlePageChange"
        @sortChange="handleSortChange"
      >
        <!-- 操作欄插槽 -->
        <template #cell(actions)="{ item }">
          <div class="flex justify-center gap-2">
            <button type="button" class="cursor-pointer border px-2" @click="deleteBtn(item.id)">刪除</button>
            <button type="button" class="cursor-pointer border px-2" @click="openEditModal(item)">編輯</button>
          </div>
        </template>
      </TableWithPagination>
    </div>
  </AppLayout>
</template>
