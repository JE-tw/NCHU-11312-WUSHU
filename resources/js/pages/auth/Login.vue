<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';

defineProps<{
  status?: string;
  canResetPassword: boolean;
}>();

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <Header />
  <header class="flex h-[234px] w-full flex-col items-center bg-black sm:h-[303px] xl:h-[444px] mb-16">
    <p
      class="pt-[120px] font-serif text-[32px]/[46px] font-bold text-grayWhite sm:pt-[160px] sm:text-[52px]/[75px] xl:pt-[224px] xl:text-[64px]/[92px]"
    >
      會員登入
    </p>
    <span class="w-[90px] border-b-2 border-grayWhite sm:w-[200px]"></span>
  </header>
  

  <!-- 下方不要動到 -->
  <div class="flex items-center justify-center bg-white">
    <div class="h-min-[400px] w-[468px] rounded-lg bg-grayWhite p-8 shadow-lg">
      <form @submit.prevent="submit">
        <div class="grid gap-5">
          <!-- 帳號 -->
          <div class="grid gap-2">
            <label for="email" class="block text-[32px] font-bold text-black">帳號</label>
            <input
              id="email"
              type="email"
              required
              autofocus
              :tabindex="1"
              autocomplete="email"
              v-model="form.email"
              placeholder="輸入電子郵件"
              class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <InputError :message="form.errors.email" />
          </div>
          <!-- 密碼 -->
          <div class="grid gap-2">
            <label for="password" class="block text-[32px] font-bold text-black">密碼</label>
            <input
              type="password"
              id="password"
              required
              :tabindex="2"
              autocomplete="current-password"
              v-model="form.password"
              class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="輸入密碼"
            />
            <InputError :message="form.errors.password" />
            <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm" :tabindex="5"> 忘記密碼? </TextLink>
          </div>

          <!-- <div class="flex items-center justify-between" :tabindex="3">
            <Label for="remember" class="flex items-center space-x-3">
              <Checkbox id="remember" v-model:checked="form.remember" :tabindex="4" />
              <span>記住我</span>
            </Label>
          </div> -->

          <Button type="submit" class="mt-4 w-full bg-deepTeal" :tabindex="4" :disabled="form.processing">
            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
            登入
          </Button>
        </div>
      </form>
    </div>
  </div>
  <!-- 上方不要動到 -->

  <Footer class="mt-16" />
</template>
