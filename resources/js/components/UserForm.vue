<script setup>
import { ref, reactive, watch, defineEmits } from 'vue';
import { router } from '@inertiajs/vue3';
import Flatpickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import BaseInput from '@/components/BaseInput.vue';

const props = defineProps({
  user: {
    type: Object,
    default: null,
  },
});
console.log(props);

const emit = defineEmits(['close', 'submitted']);

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

// watch(
//   () => props.user,
//   (user) => {
//     if (user) {
//       form.name = user.name || '';
//       form.phone = user.phone || '';
//       form.birth_date = user.birth_date || '';
//       form.birth_time = user.birth_time || '';
//       form.birth_city = user.birth_city || '';
//       form.address = user.address || '';
//       form.email = user.email || '';
//     }
//   },
//   { immediate: true },
// );
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
    }
  },
  { immediate: true },
);

const showPassword = ref(false);
const showPasswordConfirmation = ref(false);
const errors = ref({});

const validateForm = () => {
  const newErrors = {};
  if (!form.name) newErrors.name = '請輸入姓名';
  if (!form.phone) newErrors.phone = '請輸入手機號碼';
  if (!form.email) newErrors.email = '請輸入電子郵件';
  else if (!/^\S+@\S+\.\S+$/.test(form.email)) newErrors.email = '電子郵件格式不正確';
  if (props.user === null) {
    if (!form.password) newErrors.password = '請輸入密碼';
    else if (form.password.length < 6) newErrors.password = '密碼至少 6 碼';
    if (form.password !== form.password_confirmation) newErrors.password_confirmation = '密碼不一致';
  }
  errors.value = newErrors;
  return Object.keys(newErrors).length === 0;
};

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

const dateOptions = {
  dateFormat: 'Y-m-d',
  allowInput: true,
};
const timeOptions = {
  enableTime: true,
  noCalendar: true,
  dateFormat: 'H:i',
  time_24hr: true,
  allowInput: true,
};
</script>

<template>
  <div class="w-full">
    <!-- 姓名與手機 -->
    <BaseInput id="name" label="姓名" v-model="form.name" />
    <BaseInput id="phone" label="手機號碼" v-model="form.phone" />

    <!-- 出生日期與時間 -->
    <div class="flex gap-2">
      <Flatpickr
        v-model="form.birth_date"
        :config="dateOptions"
        placeholder="出生日期"
        class="input mt-4 block w-full rounded-md border border-gray-300 bg-transparent px-3 py-3 text-sm"
      />
      <Flatpickr
        v-model="form.birth_time"
        :config="timeOptions"
        placeholder="出生時間"
        class="input mt-4 block w-full rounded-md border border-gray-300 bg-transparent px-3 py-3 text-sm"
      />
    </div>

    <!-- 出生城市與地址 -->
    <BaseInput id="birth_city" label="出生城市" v-model="form.birth_city" />
    <BaseInput id="address" label="地址" v-model="form.address" />

    <!-- 信箱 -->
    <BaseInput id="email" label="電子郵件" v-model="form.email" />

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
