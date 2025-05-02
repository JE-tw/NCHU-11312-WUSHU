<script setup >
import { ref, computed, watchEffect } from 'vue';
import UserCreateModal from '@/Components/UserCreateModal.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { useConfirmDialog } from '@/composables/useConfirmDialog';
import TableWithPagination from '@/Components/TableWithPagination.vue';

// Inertia 資料
const page = usePage();
const userInfos = computed(() => page.props.userInfos);
const items = computed(() => userInfos.value.data); // 分頁資料陣列
const currentPage = computed(() => userInfos.value.current_page);
const totalPages = computed(() => userInfos.value.last_page);

// 排序狀態
const currentSortKey = ref('id');
const currentSortDirection = ref('asc');

// Modal 開關
const showModal = ref(false);
const openModal = () => (showModal.value = true);
const closeModal = () => (showModal.value = false);

// 麵包屑
const breadcrumbs = [
  { title: '五術研究社 後臺管理', href: '/dashboard' },
];

// 表格欄位設定
const columns = [
  { key: 'id', label: '會員編號', sortable: true },
  { key: 'name', label: '姓名' },
  { key: 'birth_date', label: '出生日期', sortable: true },
  { key: 'birth_city', label: '出生城市' },
  { key: 'phone', label: '電話號碼' },
  { key: 'actions', label: '操作' },
];

// 搜尋
const searchQuery = ref('');
const handleSearch = (keyword) => {
  searchQuery.value = keyword;
  router.get(
    route('admin.user.list'),
    {
      search: keyword,
      sort: currentSortKey.value,
      direction: currentSortDirection.value,
      page: 1,
    },
    {
      preserveState: true,
      preserveScroll: true,
    }
  );
};
// 換頁
const handlePageChange = (pageNum) => {
  router.get(
    route('admin.user.list'),
    {
      page: pageNum,
      search: searchQuery.value,
      sort: currentSortKey.value,
      direction: currentSortDirection.value,
    },
    {
      preserveState: true,
      preserveScroll: true,
    }
  );
};

// 排序
const handleSortChange = ({ sortKey, sortDirection }) => {
  currentSortKey.value = sortKey;
  currentSortDirection.value = sortDirection;
  router.get(
    route('admin.user.list'),
    {
      search: searchQuery.value,
      page: 1,
      sort: sortKey,
      direction: sortDirection,
    },
    {
      preserveState: true,
      preserveScroll: true,
    }
  );
};
// 刪除按鈕
const deleteBtn = async (id) => {
  const confirmed = await useConfirmDialog();
  if (confirmed) {
    router.get(route('admin.user.delete', id));
  }
};
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
  <AppLayout :breadcrumbs="breadcrumbs">
    <div>
      <h1 class="mb-4 text-2xl font-bold">會員管理</h1>
      <button type="button" class="mb-4 border p-2" @click="openModal">新增會員</button>
      <UserCreateModal v-if="showModal" @close="closeModal" />
      <!-- 表格 -->
      <TableWithPagination
        :columns="[
          { label: '會員編號', key: 'id', sortable: true },
          { label: '姓名', key: 'name' },
          { label: '出生日期', key: 'birth_date', sortable: true },
          { label: '出生城市', key: 'birth_city' },
          { label: '電話號碼', key: 'phone' },
          { label: '操作', key: 'actions' },
        ]"
        :items="userInfos.data"
        :totalPages="userInfos.last_page"
        :currentPage="userInfos.current_page"
        :showSearch="true"
        @search="handleSearch"
        @pageChange="handlePageChange"
        @sortChange="handleSortChange"
        :sortKey="currentSortKey"
        :sortDirection="currentSortDirection"
      >
        <!-- Slot: actions 按鈕 -->
        <template #cell(actions)="{ item }">
          <div class="flex justify-center gap-2">
            <button type="button" class="cursor-pointer border border-red-500 px-2 text-red-500" @click="deleteBtn(item.id)">刪除</button>
            <button type="button" class="cursor-pointer border bg-deepTeal px-2 text-white">查看/編輯</button>
          </div>
        </template>
      </TableWithPagination>
      <!-- <table class="min-w-full bg-white">
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
      </table> -->
    </div>
  </AppLayout>
</template>
