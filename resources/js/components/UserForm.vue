<script setup>
import { ref, reactive, watch, defineEmits } from 'vue';
import { router } from '@inertiajs/vue3';
import Flatpickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import BaseInput from '@/components/BaseInput.vue';

// Props 與 Emits
const props = defineProps({
  user: {
    type: Object,
    default: null,
  },
});
const emit = defineEmits(['close', 'submitted']);

// 表單資料
const form = reactive({
  name: '',
  phone: '',
  birth_date: '',
  birth_time: '',
  birth_city: '',
  address: '',
  email: '',
  password: '',
  password_confirmation: '',
  status: null,
});
// 顯示密碼切換
const showPassword = ref(false);
const showPasswordConfirmation = ref(false);
// 錯誤訊息
const errors = ref({});

// 日期格式化
const formatDate = (dateStr) => {
  if (!dateStr) return '';
  const date = new Date(dateStr);
  const y = date.getFullYear();
  const m = String(date.getMonth() + 1).padStart(2, '0');
  const d = String(date.getDate()).padStart(2, '0');
  return `${y}/${m}/${d}`;
};
// console.log(props.user);

// 初始化表單（編輯模式）
watch(
  () => props.user,
  (user) => {
    if (user) {
      form.name = user.name || '';
      form.phone = user.user_info?.phone || '';
      form.birth_date = user.user_info?.birth_date || '';
      form.birth_time = user.user_info?.birth_time || '';
      form.birth_city = user.user_info?.birth_city || '';
      form.address = user.user_info?.address || '';
      form.email = user.email || '';
      form.status = Number(user.user_info?.status ?? 1);
    }
  },
  { immediate: true },
);

// 表單驗證
const validateForm = () => {
  const newErrors = {};
  if (!form.name) newErrors.name = '請輸入姓名';
  if (!form.phone) newErrors.phone = '請輸入手機號碼';
  if (!form.email) newErrors.email = '請輸入電子郵件';
  else if (!/^\S+@\S+\.\S+$/.test(form.email)) newErrors.email = '電子郵件格式不正確';

  if (!props.user) {
    if (!form.password) newErrors.password = '請輸入密碼';
    else if (form.password.length < 6) newErrors.password = '密碼至少 6 碼';
    if (form.password !== form.password_confirmation) {
      newErrors.password_confirmation = '密碼不一致';
    }
  }

  errors.value = newErrors;
  return Object.keys(newErrors).length === 0;
};

// 表單送出
const submit = () => {
  if (!validateForm()) return;

  const url = props.user ? route('admin.user.update', props.user.id) : route('admin.user.create');
  const method = props.user ? 'put' : 'post';

  router[method](url, form, {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      errors.value = {};
      emit('submitted');
    },
    onError: (err) => {
      errors.value = err;
    },
  });
};
// 顯示建立時間
const formattedCreatedAt = computed(() => formatDate(props.user?.created_at));

// // flatpickr 設定
// const dateOptions = {
//   dateFormat: 'Y-m-d',
//   allowInput: true,
// };
// const timeOptions = {
//   enableTime: true,
//   noCalendar: true,
//   dateFormat: 'H:i',
//   time_24hr: true,
//   defaultDate: null, // 不自動套預設時間
//   allowInput: true,
// };
</script>

<template>
  <div class="w-full">
    <!-- 如果有傳入 user 資料就顯示基本資訊欄位 -->
    <div v-if="user">
      <div class="flex w-full gap-2">
        <BaseInput id="id" label="會員編號" class="flex-1" v-model="user.id" :readonly="true" :disabled="true" />
        <BaseInput id="created_at" label="創建日期" class="flex-1" v-model="formattedCreatedAt" :readonly="true" :disabled="true" />
        <div class="flex-1">
          <label for="status" class="mb-1 block text-sm text-gray-700">會員狀態</label>
          <select
            id="status"
            v-model="form.status"
            class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"
            :class="form.status === 0 ? 'text-red-600' : 'text-gray-900'"
          >
            <option :value="1">使用中</option>
            <option :value="0">停權</option>
          </select>
        </div>
      </div>
      <BaseInput id="email" label="帳號(E-mail)" v-model="user.email" disabled="true" />
    </div>
    <!-- 姓名與手機 -->
    <BaseInput id="name" label="姓名" v-model="form.name" />
    <BaseInput id="phone" label="手機號碼" v-model="form.phone" />

    <!-- 出生日期與時間 -->
    <div class="flex gap-2">
      <div class="relative w-full">
        <label for="birth_date" class="absolute left-4 top-2 bg-white text-sm text-gray-500"> 出生日期 </label>
        <input
          id="birth_date"
          v-model="form.birth_date"
          type="date"
          placeholder="出生日期"
          class="input mt-4 block w-full rounded-md border border-gray-300 bg-transparent px-3 py-3 text-sm"
        />
      </div>
      <div class="relative w-full">
        <label for="birth_time" class="absolute left-4 top-2 bg-white text-sm text-gray-500"> 出生時間 </label>
        <input
          id="birth_time"
          v-model="form.birth_time"
          type="time"
          placeholder="出生時間"
          class="input mt-4 block w-full rounded-md border border-gray-300 bg-transparent px-3 py-3 text-sm"
        />
      </div>
    </div>

    <!-- 出生城市與地址 -->
    <BaseInput id="birth_city" label="出生城市" v-model="form.birth_city" />
    <BaseInput id="address" label="地址" v-model="form.address" />

    <!-- 信箱（僅新增時顯示） -->
    <template v-if="!user">
      <BaseInput id="email" label="電子郵件" v-model="form.email" />
    </template>

    <!-- 密碼（僅新增時顯示） -->
    <template v-if="!user">
      <div class="relative mt-4">
        <input
          :type="showPassword ? 'text' : 'password'"
          v-model="form.password"
          placeholder="密碼/至少6碼/英數混合"
          class="block w-full rounded-md border border-gray-300 px-3 py-3 pr-10 text-sm"
        />
        <button
          type="button"
          class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
          @click="showPassword = !showPassword"
        >
          <font-awesome-icon :icon="showPassword ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'" />
        </button>
      </div>

      <div class="relative mt-4">
        <input
          :type="showPasswordConfirmation ? 'text' : 'password'"
          v-model="form.password_confirmation"
          placeholder="再次輸入密碼"
          class="block w-full rounded-md border border-gray-300 px-3 py-3 pr-10 text-sm"
        />
        <button
          type="button"
          class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
          @click="showPasswordConfirmation = !showPasswordConfirmation"
        >
          <font-awesome-icon :icon="showPasswordConfirmation ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'" />
        </button>
      </div>
    </template>

    <div v-if="Object.keys(errors).length" class="mt-2 text-sm text-red-500">
      {{ Object.values(errors)[0] }}
    </div>

    <div class="mt-4 flex justify-end gap-2">
      <button @click="$emit('close')" class="rounded border border-gray-300 px-4 py-2">取消</button>
      <button @click="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
        {{ user ? '更新' : '新增' }}
      </button>
    </div>
  </div>
</template>
