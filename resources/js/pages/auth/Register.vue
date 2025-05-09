<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';

const form = useForm({
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

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};

const goLogin = () => {
  router.get('/login');
};
</script>

<template>
  <header class="mb-16 flex h-[234px] w-full flex-col items-center bg-black sm:h-[303px] xl:h-[444px]">
    <p
      class="pt-[120px] font-serif text-[32px]/[46px] font-bold text-grayWhite sm:pt-[160px] sm:text-[52px]/[75px] xl:pt-[224px] xl:text-[64px]/[92px]"
    >
      會員註冊
    </p>
    <span class="w-[90px] border-b-2 border-grayWhite sm:w-[200px]"></span>
  </header>
  <Header />
  <!-- <AuthBase class="bg-red-500"> -->
  <Head title="Register" />
  <div class="mb-16 flex flex-col items-center gap-4">
    <!-- 登入/註冊按鈕 -->
    <div class="flex w-full max-w-md items-center justify-between">
      <button
        @click="goLogin"
        class="whitespace-nowrap rounded-md border border-[#1F9C95] bg-white px-12 py-3 text-lg text-[#1F9C95] transition-colors duration-300 hover:bg-[#1F9C95] hover:text-white focus:outline-none sm:px-16 sm:text-2xl"
      >
        登入
      </button>

      <div class="h-12 w-px bg-gray-300"></div>

      <button
        type="button"
        class="whitespace-nowrap rounded-md border border-[#1F9C95] bg-[#1F9C95] px-12 py-3 text-lg text-white transition-colors duration-300 hover:bg-[#1F9C95] hover:text-white focus:outline-none sm:px-16 sm:text-2xl"
      >
        註冊
      </button>
    </div>
    <!-- 註冊表單 -->
    <form @submit.prevent="submit" class="flex w-[468px] flex-col gap-6 bg-grayWhite p-8">
      <div class="grid gap-6">
        <div class="grid gap-2">
          <Label for="name">姓名</Label>
          <Input id="name" type="text" required autofocus autocomplete="name" v-model="form.name" placeholder="姓名" />
          <InputError :message="form.errors.name" />
        </div>

        <div class="grid gap-2">
          <Label for="phone">手機號碼</Label>
          <Input id="phone" type="tel" required autocomplete="tel" v-model="form.phone" placeholder="手機號碼" />
          <InputError :message="form.errors.phone" />
        </div>

        <div class="grid gap-2">
          <Label for="birth_date">出生日期</Label>
          <Input id="birth_date" type="date" v-model="form.birth_date" />
          <InputError :message="form.errors.birth_date" />
        </div>

        <div class="grid gap-2">
          <Label for="birth_time">出生時間</Label>
          <Input id="birth_time" type="time" v-model="form.birth_time" />
          <InputError :message="form.errors.birth_time" />
        </div>

        <div class="grid gap-2">
          <Label for="birth_city">出生城市</Label>
          <Input id="birth_city" type="text" v-model="form.birth_city" placeholder="出生城市" />
          <InputError :message="form.errors.birth_city" />
        </div>

        <div class="grid gap-2">
          <Label for="address">地址</Label>
          <Input id="address" type="text" v-model="form.address" placeholder="地址" />
          <InputError :message="form.errors.address" />
        </div>

        <div class="grid gap-2">
          <Label for="email">電子郵件</Label>
          <Input id="email" type="email" required autocomplete="email" v-model="form.email" placeholder="email@example.com" />
          <InputError :message="form.errors.email" />
        </div>

        <div class="grid gap-2">
          <Label for="password">密碼</Label>
          <Input id="password" type="password" required autocomplete="new-password" v-model="form.password" placeholder="密碼" />
          <InputError :message="form.errors.password" />
        </div>

        <div class="grid gap-2">
          <Label for="password_confirmation">再次輸入密碼</Label>
          <Input
            id="password_confirmation"
            type="password"
            required
            autocomplete="new-password"
            v-model="form.password_confirmation"
            placeholder="確認密碼"
          />
          <InputError :message="form.errors.password_confirmation" />
        </div>

        <Button type="submit" class="mt-2 w-full bg-blueGreen" :disabled="form.processing">
          <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
          建立帳號
        </Button>
      </div>

      <div class="text-center text-sm text-muted-foreground">
        已經有帳號了嗎？
        <TextLink :href="route('login')" class="underline underline-offset-4">登入</TextLink>
      </div>
    </form>
  </div>
  <!-- </AuthBase> -->
  <Footer />
</template>
