<!-- UserOrdersTable.vue -->
<script setup>
defineProps({
  items: Array,
  currentPage: Number,
  totalPages: Number,
  sortKey: String,
  sortDirection: String,
  onSearch: Function,
  onPageChange: Function,
  onSortChange: Function,
});

import TableWithPagination from '@/components/TableWithPagination.vue';

const columns = [
  { label: '日期', key: 'created_at', sortable: true },
  { label: '購買項目', key: 'order_items' },
  { label: '價格', key: 'total_amount', sortable: true },
  { label: '訂單狀態', key: 'status_text' },
];
</script>

<template>
  <TableWithPagination
    :columns="columns"
    :rows="items"
    :current-page="currentPage"
    :total-pages="totalPages"
    :sort-key="sortKey"
    :sort-direction="sortDirection"
    @search="onSearch"
    @page-change="onPageChange"
    @sort-change="onSortChange"
  />
</template>
