<script setup lang>
import { ref, computed, watchEffect } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import ContactDetailModal from '@/Components/ContactDetailModal.vue';
import { useConfirmDialog } from '@/composables/useConfirmDialog';
import TableWithPagination from '@/Components/TableWithPagination.vue';

// const contacts = page.props.contacts;

// Inertia 資料
const page = usePage();
const contacts = computed(() => page.props.contacts);
const items = computed(() => contacts.value.data); // 分頁資料陣列
const currentPage = computed(() => contacts.value.current_page);
const totalPages = computed(() => contacts.value.last_page);

console.log('page.props.contacts', page.props.contacts);

// 表格欄位
const columns = [
  { label: '日期', key: 'created_at', sortable: true },
  { label: '姓名', key: 'name' },
  { label: '主旨', key: 'title' },
  { label: '操作', key: 'actions' },
];

// 麵包屑
const breadcrumbs = [{ title: '五術研究社 後臺管理', href: '/dashboard' }];

// 排序狀態
const currentSortKey = ref('id');
const currentSortDirection = ref('asc');

// Modal 開關
const showModal = ref(false);
const openModal = () => (showModal.value = true);
const closeModal = () => (showModal.value = false);

// 搜尋
const searchQuery = ref('');
const handleSearch = (keyword) => {
  searchQuery.value = keyword;
  router.get(
    route('admin.contact.list'),
    {
      search: keyword,
      sort: currentSortKey.value,
      direction: currentSortDirection.value,
      page: 1,
    },
    {
      preserveState: true,
      preserveScroll: true,
    },
  );
};
// 換頁
const handlePageChange = (pageNum) => {
  router.get(
    route('admin.contact.list'),
    {
      page: pageNum,
      search: searchQuery.value,
      sort: currentSortKey.value,
      direction: currentSortDirection.value,
    },
    {
      preserveState: true,
      preserveScroll: true,
    },
  );
};

// 排序
const handleSortChange = ({ sortKey, sortDirection }) => {
  currentSortKey.value = sortKey;
  currentSortDirection.value = sortDirection;
  router.get(
    route('admin.contact.list'),
    {
      search: searchQuery.value,
      page: 1,
      sort: sortKey,
      direction: sortDirection,
    },
    {
      preserveState: true,
      preserveScroll: true,
    },
  );
};

// 個別查看詳細內容
const selectedContact = ref(null);
function openDetail(contact) {
  selectedContact.value = contact;
}

// 按鈕事件
const deleteBtn = async (id) => {
  const confirmed = await useConfirmDialog();
  if (confirmed) {
    router.get(route('admin.contact.delete', id));
  }
};
</script>

<template>
  <AppLayout :breadcrumbs="breadcrumbs">
    <div>
      <h1 class="mb-4 text-2xl font-bold">聯絡我們紀錄</h1>
      <TableWithPagination
        :columns="[
          { label: '日期', key: 'formatted_date', sortable: true },
          { label: '姓名', key: 'name' },
          { label: '主旨', key: 'title' },
          { label: '操作', key: 'actions' },
        ]"
        :items="items"
        :totalPages="totalPages"
        :currentPage="currentPage"
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
            <button type="button" class="cursor-pointer border px-2" @click="deleteBtn(item.id)">刪除</button>
            <button type="button" class="cursor-pointer border px-2" @click="openDetail(item)">查看</button>
          </div>
        </template>
      </TableWithPagination>

      <!-- <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="border px-4 py-2">姓名</th>
            <th class="border px-4 py-2">電話</th>
            <th class="border px-4 py-2">Email</th>
            <th class="border px-4 py-2">主旨</th>
            <th class="border px-4 py-2">內容</th>
            <th class="border px-4 py-2">操作</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="contact in contacts" :key="contact.id">
            <td class="border px-4 py-2">{{ contact.name }}</td>
            <td class="border px-4 py-2">{{ contact.phone }}</td>
            <td class="border px-4 py-2">{{ contact.email }}</td>
            <td class="border px-4 py-2">{{ contact.title }}</td>
            <td class="border px-4 py-2">{{ contact.content }}</td>
            <td class="border px-4 py-2">
              <div class="flex justify-center gap-2">
                <button type="button" class="cursor-pointer border px-2" @click="deleteBtn(contact.id)">刪除</button>
                <button type="button" class="cursor-pointer border px-2" @click="openDetail(contact)">查看</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table> -->
    </div>
  </AppLayout>
  <ContactDetailModal :contact="selectedContact" @close="selectedContact = null" />
</template>
