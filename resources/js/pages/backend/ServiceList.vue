<script setup>
import { ref, computed, watchEffect } from 'vue';
import ServiceFormModal from '@/components/ServiceFormModal.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { useConfirmDialog } from '@/composables/useConfirmDialog';
import TableWithPagination from '@/components/TableWithPagination.vue';
import { useTableController } from '@/composables/useTableController';

// // Inertia 資料
const page = usePage();
const showModal = ref(false);
const currentService = ref(null);

const openCreateModal = () => {
  currentService.value = null;
  showModal.value = true;
};

const openEditModal = (service) => {
  currentService.value = { ...service };
  showModal.value = true;
};

const closeModal = () => {
  currentService.value = null;
  showModal.value = false;
};

const { items, currentPage, totalPages, searchQuery, currentSortKey, currentSortDirection, handleSearch, handlePageChange, handleSortChange } =
  useTableController('services', 'admin.service.list'); // 名稱依照你 controller 傳的變數與 route 命名來

const columns = [
  { label: '服務名稱', key: 'name' },
  { label: '金額', key: 'price' },
  { label: '服務介紹', key: 'introduction' },
  { label: '操作', key: 'actions' },
];

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

// 按鈕事件
const deleteBtn = async (id) => {
  const confirmed = await useConfirmDialog();
  if (confirmed) {
    router.get(route('admin.service.delete', id));
  }
};
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <h1 class="fixed mb-12 w-full bg-white px-12 py-4 text-2xl font-bold shadow">服務內容管理</h1>
    <div class="mt-20 px-12">
      <button type="button" class="mb-4  rounded border border-stone-400 bg-gray-100  px-4 py-2 hover:bg-darkGray hover:text-white" @click="openCreateModal">新增服務內容</button>
      <TableWithPagination
        :columns="columns"
        :items="items"
        :current-page="currentPage"
        :total-pages="totalPages"
        :sort-key="currentSortKey"
        :sort-direction="currentSortDirection"
        :showSearch="false"
        @search="handleSearch"
        @page-change="handlePageChange"
        @sort-change="handleSortChange"
      >
        <!-- Slot: actions 按鈕 -->
        <template #cell(actions)="{ item }">
          <div class="flex justify-center gap-2">
            <button type="button" class="rounded cursor-pointer border border-red-500 px-2 text-red-500 hover:bg-red-500 hover:text-white" @click="deleteBtn(item.id)">刪除</button>
            <button type="button" class="rounded cursor-pointer border bg-deepTeal px-2 text-white hover:bg-teal-700" @click="openEditModal(item)">編輯</button>
          </div>
        </template>
      </TableWithPagination>
      <!-- 新增/編輯 共用 Modal -->
      <ServiceFormModal v-if="showModal" :service="currentService" @close="closeModal" />
    </div>
  </AppLayout>
</template>
