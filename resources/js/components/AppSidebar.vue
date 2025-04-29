<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
  // {
  //   title: '付款記錄管理',
  //   href: route('admin.contact.list'),
  // },
  {
    title: '會員管理',
    href: route('admin.user.list'),
  },
  {
    title: '聯絡我們列表',
    href: route('admin.contact.list'),
  },
  {
    title: '服務內容管理',
    href: route('admin.service.list'),
  },
  {
    title: '子課程管理',
    href: route('admin.course.list'),
  },
];
</script>

<template>
  <Sidebar collapsible="none" variant="inset" class="bg-lightGray">
    <SidebarContent>
      <NavMain :items="mainNavItems" />
    </SidebarContent>
  </Sidebar>
  <slot />
</template>
