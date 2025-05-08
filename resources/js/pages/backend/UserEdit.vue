<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Swal from 'sweetalert2';
import UserForm from '@/components/UserForm.vue';
import BaseInput from '@/components/BaseInput.vue';

import { computed } from 'vue';

// // Inertia 資料
const page = usePage();
const user = usePage().props.user;

function goBack() {
  router.get(route('admin.user.list'));
}

// 顯示 flash 訊息
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
</script>

<template>
  <AppLayout title="會員管理">
    <nav class="buserInfo-b mb-4 flex w-full items-center gap-3 p-2">
      <button type="button" class="rounded-sm bg-darkGray px-4 py-2 text-white" @click="goBack">返回</button>
      <h1 class="text-2xl font-bold">會員管理 > {{ user.name }}</h1>
    </nav>
    <div class="space-y-5">
      <div class="flex gap-2">
        <button type="button" class="border border-darkGray px-4 py-2">個人資料</button>
        <button type="button" class="border border-darkGray px-4 py-2">購買紀錄</button>
      </div>
      <!-- 會員資料表格 -->
      <div class="w-[468px] rounded-sm border p-4">
        <UserForm :user="user" @close="goBack" />
      </div>
      <!-- 購買紀錄表格 -->
    </div>
  </AppLayout>
</template>
