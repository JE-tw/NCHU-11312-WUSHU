<script setup>
import { ref, watch } from 'vue';
import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
  modelValue: Boolean,
  chapter: Object,
  isEdit: Boolean,
  courseId: Number,
});
const emit = defineEmits(['update:modelValue']);

const visible = ref(props.modelValue);
watch(() => props.modelValue, val => visible.value = val);
watch(visible, val => emit('update:modelValue', val));

const form = useForm({
  id: null,
  name: '',
  introduction: '',
  video_url: '',
  sort: 1,
});

watch(() => props.chapter, (chapter) => {
  if (chapter) {
    form.id = chapter.id;
    form.name = chapter.name;
    form.introduction = chapter.introduction;
    form.video_url = chapter.video_url;
    form.sort = chapter.sort;
  }
});

const submit = () => {
  router.put(`/admin/chapters/${form.id}`, form, {
    onSuccess: () => {
      visible.value = false;
    },
  });
};
</script>
<template>
  <div v-if="visible" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-xl shadow-lg space-y-4">
      <h2 class="text-xl font-bold">編輯章節</h2>
      <div class="space-y-2">
        <label class="block">名稱</label>
        <input v-model="form.name" class="w-full border p-2 rounded" />
        <label class="block">章節簡介</label>
        <textarea v-model="form.introduction" class="w-full border p-2 rounded"></textarea>
        <label class="block">影片網址</label>
        <input v-model="form.video_url" class="w-full border p-2 rounded" />
        <label class="block">排序</label>
        <input type="number" v-model="form.sort" class="w-full border p-2 rounded" />
      </div>
      <div class="flex justify-end gap-2 mt-4">
        <button @click="visible = false" class="px-4 py-2 border rounded">取消</button>
        <button @click="submit" class="px-4 py-2 bg-blue-600 text-white rounded">儲存</button>
      </div>
    </div>
  </div>
</template>

