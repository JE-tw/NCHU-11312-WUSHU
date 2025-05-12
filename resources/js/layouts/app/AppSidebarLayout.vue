<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { BreadcrumbItemType } from '@/types';

interface Props {
  breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
  breadcrumbs: () => [],
});
</script>

<template>
  <AppShell variant="sidebar">
    <AppContent variant="sidebar">
      <AppSidebarHeader :breadcrumbs="breadcrumbs" class=" h-20"/>
      <div class="flex h-[calc(100vh-5rem)]">
        <AppSidebar class="h-full"/>
        <div class="flex-1 overflow-y-auto">
          <slot />
        </div>
      </div>
    </AppContent>
  </AppShell>
</template>
