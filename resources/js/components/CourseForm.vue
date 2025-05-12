<script setup>
import { ref, reactive, watch, defineEmits } from 'vue';
import { router } from '@inertiajs/vue3';
import BaseInput from '@/components/BaseInput.vue';
import Swal from 'sweetalert2';

const emit = defineEmits(['submitted']);

const props = defineProps({
  course: {
    type: Object,
    default: null,
  },
  categories: {
    type: Array,
    default: () => [],
  },
});

// 表單資料
const form = reactive({
  name: '',
  category_id: null,
  is_featured: false,
  price: '',
  list_intro: '',
  detail_intro: '',
});

const errors = ref({});
// 初始化表單（編輯模式）
watch(
  () => props.course,
  (course) => {
    if (course) {
      form.name = course.name || '';
      form.category_id = course.category_id || null;
      form.is_featured = !!course.is_featured;
      form.price = course.price || '';
      form.list_intro = course.introduction || '';
      form.detail_intro = course.detail || '';
    }
  },
  { immediate: true }
);
// 表單驗證
const validateForm = () => {
  const newErrors = {};

  if (!form.name) newErrors.name = '請輸入課程名稱';
  else if (form.name.length > 30) newErrors.name = '課程名稱最多 30 字';

  if (!form.category_id) newErrors.category_id = '請選擇課程類別';

  if (!form.price && form.price !== 0) newErrors.price = '請輸入金額';
  else if (isNaN(form.price) || form.price < 0) newErrors.price = '金額必須為非負整數';

  if (!form.list_intro) newErrors.list_intro = '請輸入列表簡介';
  else if (form.list_intro.length > 36) newErrors.list_intro = '列表簡介最多 36 字';

  if (!form.detail_intro) newErrors.detail_intro = '請輸入詳細介紹';
  else if (form.detail_intro.length > 500) newErrors.detail_intro = '詳細介紹最多 500 字';

  errors.value = newErrors;
  return Object.keys(newErrors).length === 0;
};
// 表單送出
const submit = () => {
  if (!validateForm()) return;

  const url = props.course
    ? route('admin.course.update', props.course.id)
    : route('admin.course.store');

  const method = props.course ? 'put' : 'post';

  router[method](url, form, {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      errors.value = {};
      emit('submitted');
    },
    onError: (err) => {
      errors.value = err;
      if (err.is_featured) {
        Swal.fire({
          icon: 'error',
          title: '錯誤',
          text: err.is_featured, // 取第一筆錯誤訊息
        });
      }
    },
  });
};
</script>

<template>
  <div class="w-full space-y-4">
    <!-- 標題與類別 -->
    <div class="flex gap-2">
      <BaseInput id="name" label="課程標題" class="flex-1" v-model="form.name" />
      <div class="flex-1">
        <label for="category_id" class="mb-1 block text-sm text-gray-700">課程類別</label>
        <select id="category_id" v-model="form.category_id" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm">
          <option value="" disabled selected>請選擇類別</option>
          <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
        </select>
      </div>
    </div>
    <p class="text-sm text-red-500">課程標題不得超過10字</p>

    <hr />

    <!-- 主打課程開關 -->
    <div class="flex items-center gap-4">
      <label class="text-sm text-gray-700">設為主打課程</label>
      <input type="checkbox" v-model="form.is_featured" class="h-5 w-5" />
    </div>
    <p class="text-sm text-red-500">主打課程上限為2堂，若已經兩堂則無法再選擇</p>

    <hr />

    <!-- 金額 -->
    <BaseInput id="price" label="金額" v-model="form.price" />

    <!-- 列表簡介 -->
    <div>
      <label for="list_intro" class="mb-1 block text-sm text-gray-700">列表簡介</label>
      <textarea
        id="list_intro"
        v-model="form.list_intro"
        rows="2"
        placeholder="請輸入文字"
        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"
      ></textarea>
      <p class="text-sm text-red-500">列表簡介: 顯示於課程列表之簡介，不得超過36字</p>
    </div>

    <hr />

    <!-- 詳細介紹 -->
    <div>
      <label for="detail_intro" class="mb-1 block text-sm text-gray-700">詳細介紹</label>
      <textarea
        id="detail_intro"
        v-model="form.detail_intro"
        rows="4"
        placeholder="請輸入文字"
        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm"
      ></textarea>
      <p class="text-sm text-red-500">詳細介紹不得超過500字</p>
    </div>

    <div class="flex justify-end gap-2">
      <button class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700" @click="submit">
        {{ course ? '更新' : '新增' }}
      </button>
    </div>
  </div>
</template>
