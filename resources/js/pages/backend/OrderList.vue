<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';
import type { PageProps } from '@/types'; // 如果有 type 設定，依照情況調整

const page = usePage<{ orders: any[] }>();

const orders = page.props.orders;
const breadcrumbs: BreadcrumbItem[] = [
  {
    title: '五術研究社 後臺管理',
    href: '/dashboard',
  },
];
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div>
      <h1 class="mb-4 text-2xl font-bold">付款記錄管理</h1>
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="border px-4 py-2">日期</th>
            <th class="border px-4 py-2">購買項目</th>
            <th class="border px-4 py-2">會員名稱</th>
            <th class="border px-4 py-2">信箱</th>
            <th class="border px-4 py-2">價格</th>
            <th class="border px-4 py-2">付款方式</th>
            <th class="border px-4 py-2">訂單狀態</th>
            <th class="border px-4 py-2">操作</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in orders" :key="order.id">
            <td class="border px-4 py-2">{{ order.created_at.slice(0, 10) }}</td>
            <td class="border px-4 py-2">
              <div v-for="item in order.order_items" :key="item.id" class="border-b py-1 last:border-0">
                {{ item.product?.name || '未找到商品' }}
              </div>
            </td>
            <td class="border px-4 py-2">{{ order.user.name }}</td>
            <td class="border px-4 py-2">{{ order.user.email }}</td>
            <td class="border px-4 py-2">{{ order.total_amount }}</td>
            <td class="border px-4 py-2">匯款</td>
            <td class="border px-4 py-2">{{ order.status_text }}</td>
            <td class="border px-4 py-2">
              <button type="button">編輯</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>
