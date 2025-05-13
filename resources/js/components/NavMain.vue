<script setup lang="ts">
import { SidebarGroup, SidebarGroupLabel, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem, type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';

defineProps<{
  items: NavItem[];
}>();

const page = usePage<SharedData>();
</script>

<template>
  <SidebarGroup>
    <!-- <SidebarGroupLabel>Platform</SidebarGroupLabel> -->
    <SidebarMenu class="mt-3 space-y-4">
      <SidebarMenuItem v-for="item in items" :key="item.title" class="hover:bg-stone-400 ">
        <SidebarMenuButton as-child :is-active="item.href === page.url" :tooltip="item.title" class="border border-darkGray justify-center text-2xl">
          <Link :href="item.href" class="py-6">
            <component :is="item.icon" />
            <span>{{ item.title }}</span>
          </Link>
        </SidebarMenuButton>
        <hr class="">
      </SidebarMenuItem>
    </SidebarMenu>
  </SidebarGroup>
</template>
