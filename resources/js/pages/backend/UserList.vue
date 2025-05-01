<script setup lang="ts">
import { ref } from 'vue';
import UserCreateModal from '@/Components/UserCreateModal.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import type { PageProps } from '@/types'; // 如果有 type 設定，依照情況調整
import Swal from 'sweetalert2';
import { useConfirmDialog } from '@/composables/useConfirmDialog';


const page = usePage<{ userInfos: any[] }>();

console.log('Flash:', page.props.flash);

const userInfos = page.props.userInfos;
const breadcrumbs: BreadcrumbItem[] = [
  {
    title: '五術研究社 後臺管理',
    href: '/dashboard',
  },
];

const showModal = ref(false);
const openModal = () => {
  showModal.value = true;
};
const closeModal = () => {
  showModal.value = false;
};

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
    router.get(route('admin.user.delete', id));
  }
};
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div>
      <h1 class="mb-4 text-2xl font-bold">會員管理</h1>
      <button type="button" class="mb-4 border p-2" @click="openModal">新增會員</button>
      <UserCreateModal v-if="showModal" @close="closeModal" />
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="border px-4 py-2">會員編號</th>
            <th class="border px-4 py-2">姓名</th>
            <th class="border px-4 py-2">出生日期</th>
            <th class="border px-4 py-2">出生城市</th>
            <th class="border px-4 py-2">電話號碼</th>
            <th class="border px-4 py-2">操作</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="userInfo in userInfos" :key="userInfo.id">
            <td class="border px-4 py-2">{{ userInfo.id }}</td>
            <td class="border px-4 py-2">{{ userInfo.name }}</td>
            <td class="border px-4 py-2">{{ userInfo.birth_date }}</td>
            <td class="border px-4 py-2">{{ userInfo.birth_city }}</td>
            <td class="border px-4 py-2">{{ userInfo.phone }}</td>
            <td class="border px-4 py-2">
              <div class="flex justify-center gap-2">
                <button type="button" class="cursor-pointer border border-red-500 px-2 text-red-500" @click="deleteBtn(userInfo.id)">刪除</button>
                <button type="button" class="cursor-pointer border bg-deepTeal px-2 text-white">查看/編輯</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>
