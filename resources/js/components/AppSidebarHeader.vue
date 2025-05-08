<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItemType } from '@/types';

defineProps<{
  breadcrumbs?: BreadcrumbItemType[];
}>();
</script>

<template>
  <header
    class="md:px-4 z-10 flex h-16 shrink-0 items-center justify-between border-b border-darkGray bg-lightGray px-6 shadow-sm transition-[width,height] ease-linear"
  >
    <div class="flex items-center gap-2">
      <!-- <SidebarTrigger class="-ml-1" /> -->
      <template v-if="breadcrumbs.length > 0">
        <img src="@/images/logo.svg" alt="Logo" class="w-11">
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </template>
    </div>
    <!-- 登出 -->
    <Link href="/logout" method="post" as="button" class="text-2xl font-bold">
    登出
  </Link>
  </header>
</template>
