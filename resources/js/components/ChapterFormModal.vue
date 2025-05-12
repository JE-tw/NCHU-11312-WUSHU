<script setup>
import { reactive, ref, onMounted } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import BaseInput from '@/components/BaseInput.vue';

const props = defineProps({
  chapter: {
    type: Object,
    default: null,
  },
  course_id: {
    type: [Number, String],
    required: true,
  },
});

const emit = defineEmits(['close']);

const form = useForm({
  course_id: props.course_id ?? '',
  name: '',
  sort: '',
  introduction: '',
  video_url: '',
});

// 初始化資料（編輯時才有 chapter）
onMounted(() => {
  if (props.chapter) {
    form.name = props.chapter.name;
    form.sort = props.chapter.sort;
    form.introduction = props.chapter.introduction;
    form.video_url = props.chapter.video_url;
  }
});

const validateForm = () => {
  const newErrors = {};
  if (!form.name) newErrors.name = '請輸入章節名稱';
  else if (form.name.length > 16) newErrors.name = '章節名稱不得超過16字';

  if (!form.introduction) newErrors.introduction = '請輸入簡介';
  else if (form.introduction.length > 40) newErrors.introduction = '章節簡介不得超過40字';

  form.errors = newErrors;
  return Object.keys(newErrors).length === 0;
};

const submit = () => {
  if (!validateForm()) return;
  const isEdit = !!props.chapter;

  const url = isEdit ? route('admin.chapter.update', props.chapter.id) : route('admin.chapter.store');

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
      data: {
        ...form.data(), // 表單其他欄位
        course_id: props.course_id, // 傳入課程 ID
      },
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
        <h2 class="text-xl">{{ props.chapter ? '編輯課程章節' : '新增課程章節' }}</h2>
        <button class="cursor-pointer border bg-lightGray px-1 text-gray-500 hover:text-gray-700" @click="$emit('close')">✕</button>
      </div>

      <!-- 表單內容 -->
      <div class="w-full border-b p-3 text-left">
        <div class="flex items-center gap-3">
          <p class="whitespace-nowrap text-xl font-bold">章節資訊</p>
          <div class="relative ml-auto w-20">
            <label class="absolute left-3 top-[-8px] block bg-white text-xs font-medium text-gray-700">排序</label>
            <input v-model="form.sort" maxlength="5" class="input w-full bg-white text-gray-900" />
          </div>
        </div>
        <!-- 名稱欄位 -->
        <div class="relative w-full">
          <input
            type="text"
            id="name"
            v-model="form.name"
            placeholder=" "
            class="peer mt-4 block w-full rounded-md border border-gray-300 px-3 pb-2 pt-4 text-sm text-gray-900"
          />
          <label for="name" class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500">章節名稱</label>
        </div>
        <div v-if="form.errors.name" class="mb-2 text-sm text-red-500">{{ form.errors.name }}</div>

        <!-- 介紹欄位 -->
        <div class="relative w-full">
          <textarea
            id="introduction"
            v-model="form.introduction"
            placeholder=" "
            class="peer mt-4 block h-[200px] w-full resize-none overflow-auto rounded-md border border-gray-300 px-3 pb-2 pt-4 text-sm text-gray-900"
          />
          <label for="introduction" class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500">章節簡介</label>
        </div>
        <div v-if="form.errors.introduction" class="mb-4 text-sm text-red-500">{{ form.errors.introduction }}</div>
        <hr />
        <p>課程影片</p>
        <BaseInput id="video_url" label="網址" class="flex-1" v-model="form.video_url" />
      </div>

      <!-- 按鈕 -->
      <div class="flex justify-end gap-2 border-t p-2">
        <button type="button" @click="$emit('close')" class="rounded border bg-white px-4 py-2 text-gray-700">取消</button>
        <button type="button" @click="submit" class="rounded bg-blue-600 px-4 py-2 text-white">{{ props.chapter ? '儲存' : '新增' }}</button>
      </div>
    </div>
  </div>
</template>
<style scoped>
.input {
  border: 1px solid #ccc;
  padding: 4px 8px;
  border-radius: 4px;
}
</style>
