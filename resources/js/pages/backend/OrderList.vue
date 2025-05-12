<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import TableWithPagination from '@/components/TableWithPagination.vue';
import { useTableController } from '@/composables/useTableController';

const { items, currentPage, totalPages, searchQuery, currentSortKey, currentSortDirection, handleSearch, handlePageChange, handleSortChange } =
  useTableController('orders', 'admin.order.list'); // 名稱依照 controller 傳的變數與 route 命名
const columns = [
  { label: '日期', key: 'created_at', sortable: true },
  { label: '購買項目', key: 'order_items' },
  { label: '會員名稱', key: 'user_name' },
  { label: '信箱', key: 'user_email' },
  { label: '價格', key: 'total_amount', sortable: true },
  { label: '付款方式', key: 'payment_method' },
  { label: '訂單狀態', key: 'status_text' },
  { label: '操作', key: 'actions' },
];
const editOrder = (orderId) => {
  router.visit(route('admin.order.edit', orderId));
};
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <h1 class="mb-12 text-2xl font-bold py-4 px-12 shadow fixed bg-white w-full">付款記錄管理</h1>
    <div class=" px-12 mt-20">
      <TableWithPagination
        :columns="columns"
        :items="items"
        :current-page="currentPage"
        :total-pages="totalPages"
        :show-search="true"
        search-placeholder="搜尋會員名稱/信箱"
        :sort-key="currentSortKey"
        :sort-direction="currentSortDirection"
        @search="handleSearch"
        @pageChange="handlePageChange"
        @sortChange="handleSortChange"
      >
        <!-- 購買項目插槽 -->
        <template #cell(order_items)="{ item }">
          <div v-for="i in item.order_items" :key="i.id" class="border-b py-1 last:border-0">
            {{ i.product?.name || '未找到商品' }}
          </div>
        </template>

        <!-- 會員名稱插槽 -->
        <template #cell(user_name)="{ item }">
          {{ item.user?.name }}
        </template>

        <!-- 信箱插槽 -->
        <template #cell(user_email)="{ item }">
          {{ item.user?.email }}
        </template>

        <!-- 日期格式化 -->
        <template #cell(created_at)="{ item }">
          {{ item.created_at?.slice(0, 10) }}
        </template>

        <!-- 付款方式固定為匯款 -->
        <template #cell(payment_method)> 匯款 </template>

        <!-- 操作欄插槽 -->
        <template #cell(actions)="{ item }">
          <div class="flex justify-center gap-2">
            <button type="button" class="border px-2 py-1 text-sm bg-blueGreen text-white rounded-sm"  @click="editOrder(item.id)">編輯</button>
          </div>
        </template>
      </TableWithPagination>
    </div>
  </AppLayout>
</template>
