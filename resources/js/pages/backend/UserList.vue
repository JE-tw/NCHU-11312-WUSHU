<script setup>
import { ref, computed, watchEffect } from 'vue';
import UserCreateModal from '@/components/UserCreateModal.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { useConfirmDialog } from '@/composables/useConfirmDialog';
import TableWithPagination from '@/components/TableWithPagination.vue';
import { useTableController } from '@/composables/useTableController';

// // Inertia 資料
const page = usePage();


// Modal 開關
const showModal = ref(false);
const openModal = () => (showModal.value = true);
const closeModal = () => (showModal.value = false);

const { items, currentPage, totalPages, searchQuery, currentSortKey, currentSortDirection, handleSearch, handlePageChange, handleSortChange } =
  useTableController('userInfos', 'admin.user.list'); // 名稱依照 controller 傳的變數與 route 命名

const columns = [
  { label: '會員編號', key: 'id', sortable: true },
  { label: '姓名', key: 'name' },
  { label: '出生日期', key: 'birth_date', sortable: true },
  { label: '出生城市', key: 'birth_city' },
  { label: '電話號碼', key: 'phone' },
  { label: '操作', key: 'actions' },
];

// 刪除按鈕
const deleteBtn = async (id) => {
  const confirmed = await useConfirmDialog();
  if (confirmed) {
    router.get(route('admin.user.delete', id));
  }
};
// 編輯/查看按鈕
const editUser = (userId) => {
  router.visit(route('admin.user.edit', userId));
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
    <div>
      <h1 class="mb-4 text-2xl font-bold">會員管理</h1>
      <button type="button" class="mb-4 border p-2" @click="openModal">新增會員</button>
      <UserCreateModal v-if="showModal" @close="closeModal" />
      <!-- 表格 -->
      <TableWithPagination
        :columns="columns"
        :items="items"
        :current-page="currentPage"
        :total-pages="totalPages"
        :sort-key="currentSortKey"
        :sort-direction="currentSortDirection"
        :showSearch="true"
        @search="handleSearch"
        @page-change="handlePageChange"
        @sort-change="handleSortChange"
      >
        <!-- Slot: actions 按鈕 -->
        <template #cell(actions)="{ item }">
          <div class="flex justify-center gap-2">
            <button type="button" class="cursor-pointer border border-red-500 px-2 text-red-500" @click="deleteBtn(item.id)">刪除</button>
            <button type="button" class="cursor-pointer border bg-deepTeal px-2 text-white" @click="editUser(item.id)">查看/編輯</button>
          </div>
        </template>
      </TableWithPagination>
      <!-- <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="border px-4 py-2">會員編號</th>
            <th class="border px-4 py-2">姓名</th>
            <th class="border px-4 py-2">出生日期</th>
            <th class="border px-4 py-2">出生城市</th>
            <th class="border px-4 py-2">電話號碼</th>
            <th class="border px-4 py-2">操作</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="userInfo in userInfos" :key="userInfo.id">
            <td class="border px-4 py-2">{{ userInfo.id }}</td>
            <td class="border px-4 py-2">{{ userInfo.name }}</td>
            <td class="border px-4 py-2">{{ userInfo.birth_date }}</td>
            <td class="border px-4 py-2">{{ userInfo.birth_city }}</td>
            <td class="border px-4 py-2">{{ userInfo.phone }}</td>
            <td class="border px-4 py-2">
              <div class="flex justify-center gap-2">
                <button type="button" class="cursor-pointer border border-red-500 px-2 text-red-500" @click="deleteBtn(userInfo.id)">刪除</button>
                <button type="button" class="cursor-pointer border bg-deepTeal px-2 text-white">查看/編輯</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table> -->
    </div>
  </AppLayout>
</template>
