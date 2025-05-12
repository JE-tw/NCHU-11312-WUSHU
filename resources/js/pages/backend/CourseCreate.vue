<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { usePage, useForm, router } from '@inertiajs/vue3';
import CourseForm from '@/components/CourseForm.vue';
import Swal from 'sweetalert2';
import { ref, computed, watchEffect } from 'vue';
import ChapterFormModal from '@/components/ChapterFormModal.vue';
import { useConfirmDialog } from '@/composables/useConfirmDialog';



// 接收 props
const props = defineProps({
  course: Object,
  categories: Object,
  chapters: Object,
});

const page = usePage();
const showModal = ref(false);
const currentChapter = ref(null);
const course = computed(() => page.props.course);
const categories = computed(() => page.props.categories);
const chapters = computed(() => page.props.chapters);

const openCreateModal = () => {
  currentChapter.value = null;
  showModal.value = true;
};

const openEditModal = (chapter) => {
  currentChapter.value = { ...chapter };
  showModal.value = true;
};

const closeModal = () => {
  currentChapter.value = null;
  showModal.value = false;
};
const deleteBtn = async (id) => {
  const confirmed = await useConfirmDialog();
  if (confirmed) {
    router.get(route('admin.chapter.delete', id));
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
      text:'記得到課程編輯新增課程章節!',
      confirmButtonText: '確定',
    }).then(() => {
      router.get(route('admin.course.list'));
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

function goBack() {
  router.get(route('admin.course.list'));
}
</script>

<template>
  <AppLayout title="新增子課程">
    <nav class="mb-4 flex w-full items-center gap-3 border-b p-2">
      <button type="button" class="rounded-sm bg-darkGray px-4 py-2 text-white" @click="goBack">返回</button>
      <h1 class="text-2xl font-bold">新增子課程</h1>
    </nav>
    <div class="p-5">
      <CourseForm :course="course" :categories="categories" />
    </div>
  </AppLayout>
</template>
