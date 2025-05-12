<!-- 聯絡我們頁 -->
<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Header from '../../components/Header.vue';
import Swal from 'sweetalert2';
import Footer from '../../components/Footer.vue';

const item = ref({
  name: '',
  phone: '',
  email: '',
  title: '',
  content: '',
});

const name = ref(''); // 輸入時label往上方移動
const phone = ref(''); // 輸入時label往上方移動
const email = ref(''); // 輸入時label往上方移動
const title = ref(''); // 輸入時label往上方移動

// 表單格式驗證 → 彈窗 → 送出彈窗 → 成功提示彈窗
// 表單格式驗證
const validateForm = () => {
  if (!item.value.name.trim()) {
    Swal.fire('錯誤', '請輸入姓名', 'error');
    return false;
  }
  if (!/^09\d{8}$/.test(item.value.phone)) {
    Swal.fire('錯誤', '請輸入正確手機號碼', 'error');
    return false;
  }
  if (!/^[\w.-]+@[\w.-]+\.\w+$/.test(item.value.email)) {
    Swal.fire('錯誤', '請輸入正確的 Email 格式', 'error');
    return false;
  }
  if (!item.value.title.trim() || !item.value.content.trim()) {
    Swal.fire('錯誤', '請完整填寫所有欄位', 'error');
    return false;
  }
  return true;
};

// 送出+彈窗
const handleSubmit = () => {
  // 先格式驗證
  if (!validateForm()) return;

  // 然後跑確認對話框
  Swal.fire({
    title: '是否確認送出?',
    showCancelButton: true,
    cancelButtonText: '取消',
    confirmButtonText: '確定',
    reverseButtons: true,
    customClass: {
      confirmButton: 'my-confirm-btn',
      cancelButton: 'my-cancel-btn',
    },
  }).then((result) => {
    if (result.isConfirmed) {
      router.post(route('wushu.store'), item.value, {
        onSuccess: () => {
          Swal.fire({
            title: '送出成功!',
            text: '我們將盡速回覆至您的信箱，請耐心等候。',
            icon: 'success',
            customClass: {
              confirmButton: 'my-confirm-btn2',
            },
          });

          // 清空欄位（可選）
          item.value = {
            name: '',
            phone: '',
            email: '',
            title: '',
            content: '',
          };
        },
      });
    }
  });
};
</script>

<template>
  <Header />

  <div class="bg-softGray">
    <!-- header -->
    <header class="flex h-[234px] flex-col items-center bg-black sm:h-[400px]">
      <p
        class="pt-[116px] font-serif text-[32px]/[46px] font-bold text-grayWhite sm:pt-[160px] sm:text-[52px]/[75px] xl:pt-[224px] xl:text-[64px]/[92px]"
      >
        聯絡我們
      </p>
      <span class="w-[120px] border-b-2 border-grayWhite sm:w-[300px]"></span>
      <p class="mt-4 text-[18px]/[23.94px] sm:mt-[40px] sm:text-[32px]">請如實填寫</p>
    </header>
    <main>
      <!-- 聯絡我們表單 -->
      <section class="pb-[120px] pt-[30px] sm:pt-[60px]">
        <form @submit.prevent="handleSubmit" action="" class="mb-[24px] flex flex-col items-center px-[24px]">
          <!-- 姓名 -->
          <div class="relative w-[360px] sm:w-[438px]">
            <input
              id="name"
              type="text"
              name="name"
              v-model="item.name"
              class="mb-4 h-[48px] w-[100%] rounded-sm border border-mediumGray bg-white pl-4 text-[18px]/[24px] font-normal text-black outline-none"
              required
            />
            <label
              for="name"
              :class="[
                'absolute left-0 text-darkGray',
                item.name ? 'ml-4 -translate-y-2 bg-white p-0 text-[12px]/[16px] font-light' : 'py-[11.5px] pl-[18px] text-[18px] font-normal',
              ]"
            >
              姓名
            </label>
          </div>

          <!-- 電話 -->
          <div class="relative w-[360px] sm:w-[438px]">
            <input
              id="phone"
              type="text"
              name="phone"
              v-model="item.phone"
              minlength="10"
              maxlength="10"
              class="mb-4 h-[48px] w-[100%] rounded-sm border border-mediumGray bg-white pl-4 text-[18px]/[24px] font-normal text-black outline-none"
              required
            />
            <label
              for="phone"
              :class="[
                'absolute left-0 text-darkGray',
                item.phone ? 'ml-4 -translate-y-2 bg-white p-0 text-[12px]/[16px] font-light' : 'py-[11.5px] pl-[18px] text-[18px] font-normal',
              ]"
              >手機號碼</label
            >
          </div>
          <!-- 電子郵件 -->
          <div class="relative w-[360px] sm:w-[438px]">
            <input
              id="email"
              type="text"
              name="email"
              v-model="item.email"
              class="mb-4 h-[48px] w-[100%] rounded-sm border border-mediumGray bg-white pl-4 text-[18px]/[24px] font-normal text-black outline-none"
              required
            />
            <label
              for="email"
              :class="[
                'absolute left-0 text-darkGray',
                item.email ? 'ml-4 -translate-y-2 bg-white p-0 text-[12px]/[16px] font-light' : 'py-[11.5px] pl-[18px] text-[18px] font-normal',
              ]"
              >電子郵件</label
            >
          </div>

          <!-- 主旨 title -->
          <div class="relative w-[360px] sm:w-[438px]">
            <p class="mb-2 text-[20px]/[27px] font-bold text-black sm:text-[32px]/[43px]">主旨</p>
            <input
              id="title"
              type="text"
              name="title"
              maxlength="20"
              v-model="item.title"
              class="mb-4 h-[48px] w-[100%] rounded-sm border border-mediumGray bg-white pl-4 text-[18px]/[24px] font-normal text-black outline-none"
              required
            />
            <label
              for="title"
              :class="[
                'absolute left-0 text-darkGray',
                item.title ? 'ml-4 -translate-y-2 bg-white p-0 text-[12px]/[16px] font-light' : 'py-[11.5px] pl-[18px] text-[18px] font-normal',
              ]"
              >主旨(限20字內)</label
            >
          </div>
          <!-- 內容 -->
          <div class="relative w-[360px] sm:w-[438px]">
            <p class="mb-2 text-[20px]/[27px] font-bold text-black sm:text-[32px]/[43px]">內容</p>
            <textarea
              name="content"
              v-model="item.content"
              id="content"
              class="mb-[24px] h-[113px] w-full rounded-sm border border-mediumGray p-4 text-[18px]/[24px] text-black outline-none"
              required
            ></textarea>
          </div>
          <p class="mb-[24px] w-[360px] text-[12px]/[16px] text-darkGray sm:w-[438px] sm:text-[18px]/[24px]">
            謝謝您的詢問，按下送出後，將盡速回覆至您的信箱，請耐心等候。
          </p>
          <!-- 送出按鈕 -->
          <button
            type="submit"
            class="h-[36px] w-[360px] rounded-sm bg-blueGreen text-[16px]/[28px] tracking-tight text-white sm:h-[48px] sm:w-[438px] sm:text-[24px]/[40px]"
          >
            送出
          </button>
        </form>
      </section>
    </main>
  </div>
  <Footer />
</template>
<style>
.my-confirm-btn {
  background-color: #1f9c95;
  color: white;
  border: 1px solid #1f9c95;
}

.my-cancel-btn {
  background-color: white;
  color: #1f9c95;
  border: 1px solid #1f9c95;
}
.my-confirm-btn2 {
  background-color: #1f9c95;
  color: white;
  border: 1px solid #1f9c95;
}
</style>
