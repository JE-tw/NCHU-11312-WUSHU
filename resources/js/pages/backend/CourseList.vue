<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage } from '@inertiajs/vue3';
import type { PageProps } from '@/types'; // 如果有 type 設定，依照情況調整

const page = usePage<{ courses: any[] }>();

const courses = page.props.courses;
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
      <h1 class="mb-4 text-2xl font-bold">子課程列表</h1>
      <button type="button" class="mb-4 border p-2">新增課程</button>
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="border px-4 py-2">主打課程</th>
            <th class="border px-4 py-2">課程名稱</th>
            <th class="border px-4 py-2">金額</th>
            <th class="border px-4 py-2">課程類別</th>
            <th class="border px-4 py-2">簡介</th>
            <th class="border px-4 py-2">操作</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="course in courses" :key="course.id">
            <td class="border px-4 py-2">{{ course.is_featured }}</td>
            <td class="border px-4 py-2">{{ course.name }}</td>
            <td class="border px-4 py-2">{{ course.price }}</td>
            <td class="border px-4 py-2">{{ course.category?.name || '未分類' }}</td>
            <td class="border px-4 py-2">{{ course.introduction }}</td>
            <td class="border px-4 py-2">
              <div class="flex gap-2 justify-center">
                <button type="button" class="border px-2 cursor-pointer">刪除</button>
                <button type="button" class="border px-2 cursor-pointer">編輯</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    </AppLayout>
</template>
