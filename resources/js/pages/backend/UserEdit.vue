<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Swal from 'sweetalert2';
import UserForm from '@/components/UserForm.vue';

import { computed } from 'vue';

const user = usePage().props.user;

// 顯示 flash 訊息
// watchEffect(() => {
//   const success = page.props.flash?.success;
//   const error = page.props.flash?.error;
//   if (success) {
//     Swal.fire({
//       title: success,
//       icon: 'success',
//       confirmButtonText: '確定',
//     }).then(() => {
//       window.location.reload();
//     });
//   }

//   if (error) {
//     Swal.fire({
//       title: '錯誤',
//       text: error,
//       icon: 'error',
//       confirmButtonText: '確定',
//     });
//   }
// });

// function submit() {
  // router.put(route('admin.userInfo.update', props.userInfo.id), {
  //   status: form.status,
  //   course_permissions: form.course_permissions,
  // });
// }

function goBack() {
  router.get(route('admin.user.list'));
}
</script>

<template>
  <AppLayout title="會員管理">
    <nav class="mb-4 flex w-full items-center gap-3 buserInfo-b p-2">
      <button type="button" class="rounded-sm bg-darkGray px-4 py-2 text-white" @click="goBack">返回</button>
      <h1 class="text-2xl font-bold">會員管理 > {{ user.name }}</h1>
    </nav>
    <div>
      <button type="button">個人資料</button>
      <!-- 會員資料表格 -->
      <UserForm :user="user" @submitted="goBack" @close="goBack" />
      <button type="button">購買紀錄</button>
      <!-- 購買紀錄表格 -->
    </div>
  </AppLayout>
</template>


