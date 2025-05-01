<script setup>
import { defineProps, defineEmits, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Flatpickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

const emit = defineEmits(['close']);

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
});

const dateOptions = {
  dateFormat: 'Y-m-d', // 對應資料庫格式 YYYY-MM-DD
  allowInput: true,
};

const timeOptions = {
  enableTime: true,
  noCalendar: true,
  dateFormat: 'H:i', // 對應 HH:mm 格式
  time_24hr: true,
  allowInput: true,
};

const showPassword = ref(false);
const showPasswordConfirmation = ref(false);

const errors = ref({});

const submit = () => {
  router.post(route('admin.user.store'), form, {
    onSuccess: () => {
      emit('close');
    },
    onError: (err) => {
      errors.value = err;
    },
  });
};
</script>

<template>
  <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="relative w-full max-w-md bg-white shadow-lg">
      <!-- 標題列 -->
      <div class="flex items-center justify-between bg-darkGray p-2 text-white shadow-sm">
        <h2 class="text-xl">新增會員</h2>
        <button class="cursor-pointer border bg-lightGray px-1 text-gray-500 hover:text-gray-700" @click="$emit('close')">✕</button>
      </div>

      <!-- 資料內容 -->
      <div class="w-full border-b p-2 text-left">
        <h2 class="text-2xl font-bold">個人資料</h2>
        <!-- 姓名 -->
        <div class="relative w-full">
          <input
            type="text"
            id="name"
            v-model="form.name"
            placeholder=" "
            class="peer mt-4 block w-full appearance-none rounded-md border border-gray-300 bg-transparent px-3 pb-2 pt-4 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
          />
          <label
            for="name"
            class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:text-blue-600"
          >
            姓名
          </label>
        </div>
        <!-- 手機 -->
        <div class="relative w-full">
          <input
            type="text"
            id="phone"
            v-model="form.phone"
            placeholder=" "
            class="peer mt-4 block w-full appearance-none rounded-md border border-gray-300 bg-transparent px-3 pb-2 pt-4 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
          />
          <label
            for="phone"
            class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:text-blue-600"
          >
            手機號碼
          </label>
        </div>
        <!-- 出生時間 -->
        <div class="flex gap-2">
          <Flatpickr
            v-model="form.birth_date"
            :config="dateOptions"
            placeholder="出生日期"
            class="input mt-4 block w-full rounded-md border border-gray-300 bg-transparent px-3 py-3 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
          />
          <Flatpickr
            v-model="form.birth_time"
            :config="timeOptions"
            placeholder="出生時間"
            class="input mt-4 block w-full rounded-md border border-gray-300 bg-transparent px-3 py-3 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
          />
        </div>
        <!-- 出生城市 -->
        <div class="relative w-full">
          <input
            type="text"
            id="birth_city"
            v-model="form.birth_city"
            placeholder=" "
            class="peer mt-4 block w-full appearance-none rounded-md border border-gray-300 bg-transparent px-3 pb-2 pt-4 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
          />
          <label
            for="birth_city"
            class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:text-blue-600"
          >
            出生城市
          </label>
        </div>
        <!-- 地址 -->
        <div class="relative w-full">
          <input
            type="text"
            id="address"
            v-model="form.address"
            placeholder=" "
            class="peer mb-4 mt-4 block w-full appearance-none rounded-md border border-gray-300 bg-transparent px-3 pb-2 pt-4 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
          />
          <label
            for="address"
            class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:text-blue-600"
          >
            地址
          </label>
        </div>
      </div>
      <div class="w-full border p-2 text-left">
        <h2 class="text-2xl font-bold">電子郵件</h2>
        <p class="mt-4 text-sm text-darkGray">此信箱同時作為登入帳號使用。</p>
        <div class="relative w-full">
          <input
            type="text"
            id="email"
            v-model="form.email"
            placeholder=" "
            class="peer mb-4 mt-4 block w-full appearance-none rounded-md border border-gray-300 bg-transparent px-3 pb-2 pt-4 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
          />
          <label
            for="email"
            class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:text-blue-600"
          >
            電子郵件
          </label>
        </div>
        <!-- <p class="text-sm text-red-500">此帳號已有人使用，請確認是否輸入錯誤</p> -->
        <div v-if="errors.email" class="mb-4 text-sm text-red-500">此帳號已有人使用，請確認是否輸入錯誤</div>
        <!-- 密碼 -->
        <h2 class="text-2xl font-bold">密碼</h2>

        <div class="relative mt-4">
          <input
            :type="showPassword ? 'text' : 'password'"
            v-model="form.password"
            placeholder="密碼/至少6碼/英數混合"
            class="block w-full rounded-md border border-gray-300 bg-transparent px-3 py-3 pr-10 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
          />
          <button
            type="button"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
            @click="showPassword = !showPassword"
          >
            <font-awesome-icon :icon="showPassword ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'" class="h-5 w-5" />
          </button>
        </div>

        <!-- 確認密碼欄位 -->
        <div class="relative mt-4">
          <input
            :type="showPasswordConfirmation ? 'text' : 'password'"
            v-model="form.password_confirmation"
            placeholder="再次輸入密碼"
            class="block w-full rounded-md border border-gray-300 bg-transparent px-3 py-3 pr-10 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0"
          />
          <button
            type="button"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
            @click="showPasswordConfirmation = !showPasswordConfirmation"
          >
            <font-awesome-icon :icon="showPasswordConfirmation ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'" class="h-5 w-5" />
          </button>
        </div>
      </div>
      <!-- 按鈕區塊 -->
      <div class="flex justify-end gap-2 border-t p-2">
        <button type="button" @click="$emit('close')" class="rounded border border-gray-300 bg-white px-4 py-2 text-gray-700 hover:bg-gray-100">
          取消
        </button>
        <button type="button" @click="submit" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">新增</button>
      </div>
    </div>
  </div>
</template>
