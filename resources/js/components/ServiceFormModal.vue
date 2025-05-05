<script setup>
import {  reactive, ref, onMounted } from 'vue';
import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
  service: {
    type: Object,
    default: null,
  },
});

const emit = defineEmits(['close']);

const form = useForm({
  name: '',
  price: '',
  introduction: '',
});

// 初始化資料（編輯時才有 service）
onMounted(() => {
  if (props.service) {
    form.name = props.service.name;
    form.price = props.service.price;
    form.introduction = props.service.introduction;
  }
});

const validateForm = () => {
  const newErrors = {};
  if (!form.name) newErrors.name = '請輸入服務名稱';
  else if (form.name.length > 12) newErrors.name = '服務名稱不得超過12字';

  if (!form.price) newErrors.price = '請輸入金額';

  if (!form.introduction) newErrors.introduction = '請輸入介紹';
  else if (form.introduction.length > 100) newErrors.introduction = '介紹不得超過100字';

  form.errors = newErrors;
  return Object.keys(newErrors).length === 0;
};

const submit = () => {
  if (!validateForm()) return;
  const isEdit = !!props.service;

  const url = isEdit ? route('admin.service.update', props.service.id) : route('admin.service.create');

  if (isEdit) {
    form.put(url, {
      preserveScroll: true,
      onSuccess: () => {
        form.reset();
        form.clearErrors?.();
        emit('close');
      },
      onError: (err) => {
        form.errors = err || {};
      },
    });
  } else {
    form.post(url, {
      preserveScroll: true,
      onSuccess: () => {
        form.reset();
        form.clearErrors?.();
        emit('close');
      },
      onError: (err) => {
        form.errors = err || {};
      },
    });
  }
};
</script>

<template>
  <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="relative w-full max-w-md bg-white shadow-lg">
      <!-- 標題列 -->
      <div class="flex items-center justify-between bg-darkGray p-2 text-white shadow-sm">
        <h2 class="text-xl">{{ props.service ? '編輯服務' : '新增服務' }}</h2>
        <button class="cursor-pointer border bg-lightGray px-1 text-gray-500 hover:text-gray-700" @click="$emit('close')">✕</button>
      </div>

      <!-- 表單內容 -->
      <div class="w-full border-b p-2 text-left">
        <!-- 名稱欄位 -->
        <div class="relative w-full">
          <input
            type="text"
            id="name"
            v-model="form.name"
            placeholder=" "
            class="peer mt-4 block w-full rounded-md border border-gray-300 px-3 pb-2 pt-4 text-sm text-gray-900"
          />
          <label for="name" class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500">服務名稱</label>
        </div>
        <div v-if="form.errors.name" class="mb-2 text-sm text-red-500">{{ form.errors.name }}</div>

        <!-- 金額欄位 -->
        <div class="relative w-full">
          <input
            type="text"
            id="price"
            v-model="form.price"
            placeholder=" "
            class="peer mt-4 block w-full rounded-md border border-gray-300 px-3 pb-2 pt-4 text-sm text-gray-900"
          />
          <label for="price" class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500">金額</label>
        </div>
        <div v-if="form.errors.price" class="mb-2 text-sm text-red-500">{{ form.errors.price }}</div>

        <!-- 介紹欄位 -->
        <div class="relative w-full">
          <input
            type="text"
            id="introduction"
            v-model="form.introduction"
            placeholder=" "
            class="peer mt-4 block w-full rounded-md border border-gray-300 px-3 pb-2 pt-4 text-sm text-gray-900"
          />
          <label for="introduction" class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500">介紹(100字內)</label>
        </div>
        <div v-if="form.errors.introduction" class="mb-4 text-sm text-red-500">{{ form.errors.introduction }}</div>
      </div>

      <!-- 按鈕 -->
      <div class="flex justify-end gap-2 border-t p-2">
        <button type="button" @click="$emit('close')" class="rounded border bg-white px-4 py-2 text-gray-700">取消</button>
        <button type="button" @click="submit" class="rounded bg-blue-600 px-4 py-2 text-white">{{ props.service ? '儲存' : '新增' }}</button>
      </div>
    </div>
  </div>
</template>
