<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: '五術研究社 後臺管理',
    href: '/dashboard',
  },
];
</script>

<template>
  <Head title="五術研究社-後臺管理" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col flex-1 min-h-full bg-lightGray items-center space-y-4">
      <div class="mt-6 w-1/2 h-auto rounded-xl bg-white p-8 text-center shadow-lg">
        <p class="text-2xl font-bold">管理員登入成功!</p>
      </div>
      <p>建議使用電腦版瀏覽後台管理系統</p>
    </div>
  </AppLayout>
</template>
