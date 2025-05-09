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
    <div class="flex flex-1 min-h-full bg-mediumGray items-center justify-center">
      <div class="rounded-xl bg-white p-8 text-center shadow-lg">
        <p class="mb-2 text-2xl font-bold">五術研究社</p>
        <p class="text-lg text-gray-600">後臺管理</p>
      </div>
    </div>
  </AppLayout>
</template>
