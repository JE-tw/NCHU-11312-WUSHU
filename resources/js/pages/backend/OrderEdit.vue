<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Switch } from '@headlessui/vue';
import Swal from 'sweetalert2';

import { computed } from 'vue';

const props = defineProps({
  order: Object,
});
const page = usePage();


const form = useForm({
  remittance_date: props.order.remittance_date ?? '',
  remittance_amount: props.order.remittance_amount ?? '',
  remittance_account_last5: props.order.remittance_account_last5 ?? '',
  status: props.order.status,
  course_permissions: Object.fromEntries(
    props.order.order_items.filter((item) => item.product_type === 'App\\Models\\Course').map((item) => [item.id, item.is_accessible]),
  ),
});

// const enabled = ref(false);

const productType = (type) => {
  if (!type) return '未知';
  if (type.includes('Service')) return '服務';
  if (type.includes('Course')) return '課程';
  return '其他';
};

const statusOptions = [
  { label: '確認收款', value: 2 },
  { label: '等待客服確認款項', value: 1 },
  { label: '尚未付款', value: 0 },
  { label: '訂單取消', value: 3 },
];

// 訂單按鈕狀態事件
const handleStatusChange = (value) => {
  form.status = value;

  if (value === 2) {
    // 如果選擇的是「確認收款」（value === 2）
    props.order.order_items
      .filter((i) => i.product_type.includes('Course'))
      .forEach((item) => {
        form.course_permissions[item.id] = true;
      });
  } else if (value === 3) {
    // 取消訂單 ➜ 關閉所有課程權限
    props.order.order_items
      .filter((i) => i.product_type.includes('Course'))
      .forEach((item) => {
        form.course_permissions[item.id] = false;
      });
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

function submit() {
  router.put(route('admin.order.update', props.order.id), {
    status: form.status,
    course_permissions: form.course_permissions,
  });
}

function goBack() {
  router.get(route('admin.order.list'));
}
</script>

<template>
  <AppLayout title="編輯訂單">
    <nav class="mb-4 flex w-full items-center gap-3 border-b p-2">
      <button type="button" class="rounded-sm bg-darkGray px-4 py-2 text-white" @click="goBack">返回</button>
      <h1 class="text-2xl font-bold">編輯付款紀錄</h1>
    </nav>
    <div class="flex w-full gap-10 px-2">
      <!-- 左區塊 -->
      <div class="w-1/3 max-w-[428px] space-y-6">
        <!-- 會員資訊 -->
        <div class="space-y-2 rounded border bg-white p-4">
          <h2 class="mb-2 font-semibold">會員資料</h2>
          <hr />
          <p>{{ props.order.user?.user_info?.name || '姓名未提供' }}</p>
          <p>{{ props.order.user?.user_info?.phone || '電話未提供' }}</p>
          <p>{{ props.order.user?.email }}</p>
        </div>
      </div>
      <!-- 右區塊 -->
      <div class="w-1/2 max-w-[832px] space-y-6">
        <!-- 訂單資訊 -->
        <div class="space-y-3 rounded border bg-white p-4">
          <h2 class="mb-2 font-semibold">訂單資訊</h2>

          <div class="flex justify-between gap-2">
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">訂單日期</label>
              <input :value="props.order.created_at?.slice(0, 10)" type="text" class="input w-full" disabled />
            </div>
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">訂單狀態</label>
              <input :value="statusOptions.find((opt) => opt.value === form.status)?.label || '未知'" type="text" class="input w-full" disabled />
            </div>
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">總金額</label>
              <input :value="props.order.total_amount" type="text" class="input w-full" disabled />
            </div>
          </div>

          <div class="flex justify-between gap-2">
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">匯款日期</label>
              <input v-model="form.remittance_date" type="date" class="input w-full bg-white text-gray-900" disabled />
            </div>
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">匯款金額</label>
              <input v-model="form.remittance_amount" type="number" class="input w-full bg-white text-gray-900" disabled />
            </div>
            <div class="w-full">
              <label class="block text-sm font-medium text-gray-700">帳號後五碼</label>
              <input v-model="form.remittance_account_last5" maxlength="5" class="input w-full bg-white text-gray-900" disabled />
            </div>
          </div>

          <!-- 分隔線 -->
          <hr class="my-4" />

          <!-- 訂單狀態按鈕 -->
          <div>
            <label class="mb-1 block text-sm font-medium text-gray-700">訂單狀態：</label>
            <div class="flex flex-wrap gap-2">
              <button
                v-for="option in statusOptions.filter((opt) => opt.value !== 1)"
                :key="option.value"
                type="button"
                @click="handleStatusChange(option.value)"
                class="rounded border px-3 py-1"
                :class="{ 'bg-blue-500 text-white': form.status === option.value }"
              >
                {{ option.label }}
              </button>
            </div>
          </div>
        </div>

        <!-- 購買明細 -->
        <div class="rounded border bg-white p-4">
          <h2 class="mb-2 font-semibold">購買明細</h2>
          <ul>
            <li v-for="(item, index) in props.order.order_items" :key="item.id" class="border-b py-1 last:border-0">
              <!-- {{ item.product?.name || '未找到商品' }}
               -->
              <div class="flex justify-between gap-4">
                <span class="w-8">{{ index + 1 }}</span>
                <span class="flex-1">{{ item.product?.name || '未找到商品' }}</span>
                <span class="w-24 text-right">NT${{ item.price_at_order_time }}</span>
                <span class="w-20 text-right">
                  {{ productType(item.product_type) }}
                </span>
              </div>
            </li>
          </ul>
        </div>
        <!-- 課程權限 -->
        <div class="rounded border bg-white p-4">
          <h2 class="mb-2 font-semibold">課程權限</h2>
          <ul>
            <li
              v-for="(item, index) in props.order.order_items.filter((i) => i.product_type.includes('Course'))"
              :key="item.id"
              class="border-b py-1 last:border-0"
            >
              <div class="flex items-center justify-between gap-4">
                <span class="w-8">{{ index + 1 }}</span>
                <span class="flex-1">{{ item.product?.name || '未找到商品' }}</span>
                <div class="flex items-center gap-2">
                  <Switch
                    v-model="form.course_permissions[item.id]"
                    :class="form.course_permissions[item.id] ? 'bg-green-600' : 'bg-gray-200'"
                    class="relative inline-flex h-6 w-11 items-center rounded-full"
                  >
                    <span class="sr-only">課程權限</span>
                    <span
                      :class="form.course_permissions[item.id] ? 'translate-x-6' : 'translate-x-1'"
                      class="inline-block h-4 w-4 transform rounded-full bg-white transition"
                    />
                  </Switch>
                </div>
              </div>
            </li>
          </ul>
        </div>

        <!-- 儲存按鈕 -->
        <div class="text-right">
          <button @click="submit" class="rounded bg-green-600 px-4 py-2 text-white">儲存變更</button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.input {
  border: 1px solid #ccc;
  padding: 4px 8px;
  border-radius: 4px;
}
</style>
