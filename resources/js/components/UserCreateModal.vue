<script setup>
import { defineProps, defineEmits, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Flatpickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import BaseInput from '@/components/BaseInput.vue'
import UserForm from '@/components/UserForm.vue';

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
  showPassword: false,
  showPasswordConfirmation: false,
});

const validateForm = () => {
  const newErrors = {};
  if (!form.name) newErrors.name = '請輸入姓名';
  if (!form.phone) newErrors.phone = '請輸入手機號碼';
  if (!form.email) newErrors.email = '請輸入電子郵件';
  else if (!/^\S+@\S+\.\S+$/.test(form.email)) newErrors.email = '電子郵件格式不正確';
  if (!form.password) newErrors.password = '請輸入密碼';
  else if (form.password.length < 6) newErrors.password = '密碼至少 6 碼';
  if (form.password !== form.password_confirmation) newErrors.password_confirmation = '密碼不一致';
  errors.value = newErrors;
  return Object.keys(newErrors).length === 0;
};

// 送出表單
const submit = () => {
  if (!validateForm()) return;

  router.post(route('admin.user.store'), form, {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      errors.value = {};
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
      <div class="w-full p-4 text-left">
        <UserForm
          :form="form"
          :errors="errors"
          :showPasswordFields="true"
          @togglePassword="form.showPassword = !form.showPassword"
          @togglePasswordConfirmation="form.showPasswordConfirmation = !form.showPasswordConfirmation"
        />
      </div>
    </div>
  </div>
</template>
