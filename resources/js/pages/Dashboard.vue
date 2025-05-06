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

  </AppLayout>
</template>
