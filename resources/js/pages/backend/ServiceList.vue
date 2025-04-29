<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';
import type { PageProps } from '@/types'; // 如果有 type 設定，依照情況調整

const page = usePage<{ services: any[] }>();

const services = page.props.services;
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
      <h1 class="mb-4 text-2xl font-bold">服務內容管理</h1>
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="border px-4 py-2">服務名稱</th>
            <th class="border px-4 py-2">金額</th>
            <th class="border px-4 py-2">服務介紹</th>
            <th class="border px-4 py-2">操作</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="service in services" :key="service.id">
            <td class="border px-4 py-2">{{ service.name }}</td>
            <td class="border px-4 py-2">{{ service.price }}</td>
            <td class="border px-4 py-2">{{ service.introduction }}</td>
            <td class="border px-4 py-2">
              <button type="button">刪除</button>
              <button type="button">編輯</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>
