<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Swal from 'sweetalert2';
import UserForm from '@/components/UserForm.vue';
import BaseInput from '@/components/BaseInput.vue';
import UserOrdersTable from '@/components/UserOrdersTable.vue';

import { computed } from 'vue';
import TableWithPagination from '@/components/TableWithPagination.vue';
import { useTableController } from '@/composables/useTableController';

// 接收 props
const props = defineProps({
  user: Object,
  orders: Object,
});

// 切換區塊：'profile' or 'orders'
const activeTab = ref('profile');

// 取得頁面資料
const page = usePage();
const user = computed(() => page.props.user);

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

// 回到上一頁
function goBack() {
  router.get(route('admin.user.list'));
}

// 購買紀錄欄位設定
const { items, currentPage, totalPages, searchQuery, currentSortKey, currentSortDirection, handlePageChange, handleSortChange } =
useTableController('orders', 'admin.user.edit');

const columns = [
  { label: '日期', key: 'created_at', sortable: true },
  { label: '購買項目', key: 'order_items' },
  { label: '價格', key: 'total_amount', sortable: true },
  { label: '付款方式', key: 'payment_method' },
  { label: '訂單狀態', key: 'status_text' },
];

</script>

<template>
  <AppLayout title="會員管理">
    <nav class="buserInfo-b mb-5 flex w-full items-center gap-3 border-b border-darkGray py-2">
      <button type="button" class="rounded-sm bg-darkGray px-4 py-2 text-white" @click="goBack">返回</button>
      <h1 class="text-2xl font-bold">會員管理 > {{ user.name }}</h1>
    </nav>
    <div class="space-y-5 p-5">
      <!-- 分頁按鈕 -->
      <div class="flex gap-2">
        <button
          type="button"
          @click="activeTab = 'profile'"
          :class="['border px-4 py-2', activeTab === 'profile' ? 'bg-darkGray text-white' : 'border-darkGray']"
        >
          個人資料
        </button>
        <button
          type="button"
          @click="activeTab = 'orders'"
          :class="['border px-4 py-2', activeTab === 'orders' ? 'bg-darkGray text-white' : 'border-darkGray']"
        >
          購買紀錄
        </button>
      </div>
      <!-- 會員資料表格 -->
      <div v-if="activeTab === 'profile'" class="w-[468px] rounded-sm border p-4">
        <UserForm :user="user" @close="goBack" />
      </div>
      <!-- 購買紀錄表格 -->
      <div v-if="activeTab === 'orders'" class="w-full rounded-sm border p-4">
        <TableWithPagination
        :columns="columns"
        :items="items"
        :current-page="currentPage"
        :total-pages="totalPages"
        :sort-key="currentSortKey"
        :sort-direction="currentSortDirection"
        @pageChange="handlePageChange"
        @sortChange="handleSortChange"
      >
        <!-- 購買項目插槽 -->
        <template #cell(order_items)="{ item }">
          <div v-for="i in item.order_items" :key="i.id" class="border-b py-1 last:border-0">
            {{ i.product?.name || '未找到商品' }}
          </div>
        </template>

        <!-- 日期格式化 -->
        <template #cell(created_at)="{ item }">
          {{ item.created_at?.slice(0, 10) }}
        </template>

        <!-- 付款方式固定為匯款 -->
        <template #cell(payment_method)> 匯款 </template>
      </TableWithPagination>
      </div>
    </div>
  </AppLayout>
</template>
