<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import type { PageProps } from '@/types'; // 如果有 type 設定，依照情況調整
import Swal from 'sweetalert2';
import { useConfirmDialog } from '@/composables/useConfirmDialog';

const page = usePage<{ services: any[] }>();

const services = page.props.services;
const breadcrumbs: BreadcrumbItem[] = [
  {
    title: '五術研究社 後臺管理',
    href: '/dashboard',
  },
];

watchEffect(() => {
  const success = page.props.flash?.success;
  const error = page.props.flash?.error;
  if (success) {
    Swal.fire({
      title: success,
      icon: 'success',
      confirmButtonText: '確定',
    }).then(() => {
      window.location.reload();
    });
  }

  if (error) {
    Swal.fire({
      title: '錯誤',
      text: error,
      icon: 'error',
      confirmButtonText: '確定',
    });
  }
});

// 按鈕事件
const deleteBtn = async (id) => {
  const confirmed = await useConfirmDialog();
  if (confirmed) {
    router.get(route('admin.service.delete', id));
  }
};
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div>
      <h1 class="mb-4 text-2xl font-bold">服務內容管理</h1>
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="border px-4 py-2">服務名稱</th>
            <th class="border px-4 py-2">金額</th>
            <th class="border px-4 py-2">服務介紹</th>
            <th class="border px-4 py-2">操作</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="service in services" :key="service.id">
            <td class="border px-4 py-2">{{ service.name }}</td>
            <td class="border px-4 py-2">{{ service.price }}</td>
            <td class="border px-4 py-2">{{ service.introduction }}</td>
            <td class="border px-4 py-2">
              <div class="flex gap-2 justify-center">
                <button type="button" class="border px-2 cursor-pointer" @click="deleteBtn(service.id)">刪除</button>
                <button type="button" class="border px-2 cursor-pointer">編輯</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>
