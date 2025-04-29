<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';
import type { PageProps } from '@/types'; // 如果有 type 設定，依照情況調整

const page = usePage<{ userInfos: any[] }>();

const userInfos = page.props.userInfos;
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
      <h1 class="mb-4 text-2xl font-bold">會員管理</h1>
      <button type="button" class="mb-4 border p-2">新增會員</button>
      <table class="min-w-full bg-white">
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
              <button type="button">刪除</button>
              <button type="button">編輯</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>
