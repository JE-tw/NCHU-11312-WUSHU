<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import TableWithPagination from '@/components/TableWithPagination.vue';
import { useTableController } from '@/composables/useTableController';
import { useConfirmDialog } from '@/composables/useConfirmDialog';
import Swal from 'sweetalert2';


const page = usePage();

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
const editCourse = (courseId) => {
  router.visit(route('admin.course.edit', courseId));
};
const createCourse = () => {
  router.visit(route('admin.course.create'));
};
// 按鈕事件
const deleteBtn = async (id) => {
  const confirmed = await useConfirmDialog();
  if (confirmed) {
    router.get(route('admin.course.delete', id));
  }
};
// 顯示 flash 訊息
watchEffect(() => {
  const success = page.props.flash?.success;
  const error = page.props.flash?.error;

  if (success) {
    Swal.fire({
      title: success,
      icon: 'success',
      confirmButtonText: '確定',
    }).then(() => {
      window.location.reload();
    });
  }

  if (error) {
    Swal.fire({
      title: '錯誤',
      text: error,
      icon: 'error',
      confirmButtonText: '確定',
    });
  }
});
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <h1 class="fixed mb-12 w-full bg-white px-12 py-4 text-2xl font-bold shadow">子課程列表</h1>
    <div class="mt-20 px-12">
      <button type="button" class="mb-4 border p-2" @click="createCourse">新增課程</button>
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
        <!-- 主打課程欄位插槽 -->
        <template #cell(is_featured)="{ item }">
          <span>{{ item.is_featured ? '是' : '否' }}</span>
        </template>
        <!-- 操作欄插槽 -->
        <template #cell(actions)="{ item }">
          <div class="flex justify-center gap-2">
            <button type="button" class="cursor-pointer border px-2" @click="deleteBtn(item.id)">刪除</button>
            <button type="button" class="cursor-pointer border px-2" @click="editCourse(item.id)">編輯</button>
          </div>
        </template>
      </TableWithPagination>
    </div>
  </AppLayout>
</template>
