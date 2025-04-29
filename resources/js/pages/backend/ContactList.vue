<script setup lang="ts">
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, router } from '@inertiajs/vue3';
import type { PageProps } from '@/types'; // 如果有 type 設定，依照情況調整
import ContactDetailModal from '@/Components/ContactDetailModal.vue';
import { useConfirmDialog } from '@/composables/useConfirmDialog';

const page = usePage<{ contacts: any[] }>();

const contacts = page.props.contacts;
const breadcrumbs: BreadcrumbItem[] = [
  {
    title: '五術研究社 後臺管理',
    href: '/dashboard',
  },
];

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
      <table class="min-w-full bg-white">
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
              <button type="button" @click="deleteBtn(contact.id)">刪除</button>
              <button type="button" @click="openDetail(contact)">查看</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
  <ContactDetailModal :contact="selectedContact" @close="selectedContact = null" />
</template>
