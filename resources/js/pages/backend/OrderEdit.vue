<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';
// import Switch from '@/Components/Switch.vue';
import { computed } from 'vue';

const props = defineProps({
  order: Object,
});

const form = useForm({
  remittance_date: props.order.remittance_date ?? '',
  remittance_amount: props.order.remittance_amount ?? '',
  remittance_account_last5: props.order.remittance_account_last5 ?? '',
  status: props.order.status,
  course_permissions: Object.fromEntries(
    props.order.order_items
      .filter(item => item.product_type === 'App\\Models\\Course')
      .map(item => [item.id, item.is_accessible])
  ),
});

const statusOptions = [
  { label: '尚未付款', value: 0 },
  { label: '確認收款', value: 2 },
  { label: '訂單取消', value: 3 },
];

function submit() {
  form.put(route('admin.order.update', props.order.id));
}
</script>

<template>
  <AppLayout title="編輯訂單">
    <div class="max-w-3xl mx-auto space-y-6">
      <h1 class="text-2xl font-bold mb-4">編輯付款紀錄</h1>

      <!-- 會員資訊 -->
      <div class="border p-4 rounded bg-white">
        <h2 class="font-semibold mb-2">會員資料</h2>
        <p>姓名：{{ props.order.user?.user_info?.name || '未提供' }}</p>
        <p>電話：{{ props.order.user?.user_info?.phone || '未提供' }}</p>
        <p>信箱：{{ props.order.user?.email }}</p>
      </div>

      <!-- 訂單資訊 -->
      <div class="border p-4 rounded bg-white">
        <h2 class="font-semibold mb-2">訂單資訊</h2>
        <p>訂單日期：{{ props.order.created_at?.slice(0, 10) }}</p>
        <p>總金額：{{ props.order.total_amount }} 元</p>

        <div class="mt-4 space-y-2">
          <div>
            <label>匯款日期：</label>
            <input v-model="form.remittance_date" type="date" class="input" />
          </div>
          <div>
            <label>匯款金額：</label>
            <input v-model="form.remittance_amount" type="number" class="input" />
          </div>
          <div>
            <label>帳號後五碼：</label>
            <input v-model="form.remittance_account_last5" maxlength="5" class="input" />
          </div>
        </div>

        <div class="mt-4">
          <label>訂單狀態：</label>
          <div class="flex gap-2 mt-1">
            <button
              v-for="option in statusOptions"
              :key="option.value"
              type="button"
              @click="form.status = option.value"
              class="px-3 py-1 border rounded"
              :class="{ 'bg-blue-500 text-white': form.status === option.value }"
            >
              {{ option.label }}
            </button>
          </div>
        </div>
      </div>

      <!-- 購買明細 -->
      <div class="border p-4 rounded bg-white">
        <h2 class="font-semibold mb-2">購買明細</h2>
        <ul>
          <li v-for="item in props.order.order_items" :key="item.id" class="border-b py-1 last:border-0">
            {{ item.product?.name || '未找到商品' }}
            <template v-if="item.product_type === 'App\\\\Models\\\\Course'">
              <!-- 課程權限滑桿 -->
              <div class="mt-1 flex items-center gap-2">
                <label>課程權限：</label>
                <!-- <Switch v-model="form.course_permissions[item.id]" /> -->
              </div>
            </template>
          </li>
        </ul>
      </div>

      <!-- 儲存按鈕 -->
      <div class="text-right">
        <button @click="submit" class="bg-green-600 text-white px-4 py-2 rounded">儲存變更</button>
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
