<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItemType } from '@/types';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

defineProps<{
  breadcrumbs?: BreadcrumbItemType[];
}>();

// 登出彈窗 sweet alert
const logOut = () => {
  Swal.fire({
    title: '確定要登出嗎?',
    text: ' 您將登出後台系統！',
    icon: 'warning',
    showCancelButton: true,
    reverseButtons: false,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#B5B5B5',
    confirmButtonText: '確定登出!',
    cancelButtonText: '取消',
    customClass: {
      confirmButton: 'bg-teal-600 text-white font-bold rounded',
       cancelButton:'bg-gray-100 text-teal-600 border border-black rounded'
    },
  }).then((result) => {
    if (result.isConfirmed) {
      router.post('/logout');
      // Swal.fire({
      //   position: 'top-end',
      //   // icon: 'success',
      //   title: '登出成功',
      //   showConfirmButton: false,
      //   timer: 1500,
      // });
    }
  });
};
</script>

<template>
  <header
    class="md:px-4 z-10 flex h-16 shrink-0 items-center justify-between border-b border-darkGray bg-lightGray px-6 shadow-sm transition-[width,height] ease-linear"
  >
    <div class="flex items-center gap-2">
      <!-- <SidebarTrigger class="-ml-1" /> -->
      <template v-if="breadcrumbs.length > 0">
        <img src="@/images/logo.svg" alt="Logo" class="w-11" />
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </template>
    </div>
    <!-- 登出 -->
    <Link @click="logOut" class="rounded-xl px-4 py-2 text-2xl font-bold hover:text-teal-700 hover:scale-110"> 登出 </Link>
  </header>
</template>
