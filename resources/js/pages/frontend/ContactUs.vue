<!-- 聯絡我們頁 -->
<script setup>
import { ref } from 'vue';

const name = ref(''); // 輸入時label往上方移動
const phone = ref(''); // 輸入時label往上方移動
const email = ref(''); // 輸入時label往上方移動
const subject = ref(''); // 輸入時label往上方移動
</script>

<template>
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
        <form action="" class="mb-[24px] flex flex-col items-center px-[24px]">
          <!-- 姓名 -->
          <div class="relative w-[360px] sm:w-[438px]">
            <input
              id="name"
              type="text"
              name="name"
              v-model="name"
              class="mb-4 h-[48px] w-[100%] rounded-sm border border-mediumGray bg-white pl-4 text-[18px]/[24px] font-normal text-black outline-none"
              required
            />

            <!-- 
            <label for="name" class="absolute left-0 py-[11.5px] pl-[18px] text-[18px] text-darkGray">姓名</label> -->
            <label
              for="name"
              :class="[
                'absolute left-0 text-darkGray',
                name ? 'ml-4 -translate-y-2 bg-white p-0 text-[12px]/[16px] font-light' : 'py-[11.5px] pl-[18px] text-[18px] font-normal',
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
              v-model="phone"
              class="mb-4 h-[48px] w-[100%] rounded-sm border border-mediumGray bg-white pl-4 text-[18px]/[24px] font-normal text-black outline-none"
              required
            />
            <label
              for="phone"
              :class="[
                'absolute left-0 text-darkGray',
                phone ? 'ml-4 -translate-y-2 bg-white p-0 text-[12px]/[16px] font-light' : 'py-[11.5px] pl-[18px] text-[18px] font-normal',
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
              v-model="email"
              class="mb-4 h-[48px] w-[100%] rounded-sm border border-mediumGray bg-white pl-4 text-[18px]/[24px] font-normal text-black outline-none"
              required
            />
            <label
              for="email"
              :class="[
                'absolute left-0 text-darkGray',
                email ? 'ml-4 -translate-y-2 bg-white p-0 text-[12px]/[16px] font-light' : 'py-[11.5px] pl-[18px] text-[18px] font-normal',
              ]"
              >電子郵件</label
            >
          </div>

          <!-- 主旨 subject -->
          <div class="relative w-[360px] sm:w-[438px]">
            <p class="mb-2 text-[20px]/[27px] font-bold text-black sm:text-[32px]/[43px]">主旨</p>
            <input
              id="subject"
              type="text"
              name="subject"
              v-model="subject"
              class="mb-4 h-[48px] w-[100%] rounded-sm border border-mediumGray bg-white pl-4 text-[18px]/[24px] font-normal text-black outline-none"
              required
            />
            <label
              for="email"
              :class="[
                'absolute left-0 text-darkGray',
                subject ? 'ml-4 -translate-y-2 bg-white p-0 text-[12px]/[16px] font-light' : 'py-[11.5px] pl-[18px] text-[18px] font-normal',
              ]"
              >主旨(限20字內)</label
            >
          </div>
          <!-- 內容 -->
          <div class="relative w-[360px] sm:w-[438px]">
            <p class="mb-2 text-[20px]/[27px] font-bold text-black sm:text-[32px]/[43px]">內容</p>
            <textarea
              name="content"
              id="content"
              class="mb-[24px] h-[113px] w-full rounded-sm border border-mediumGray text-[18px]/[24px] text-black outline-none"
            ></textarea>
          </div>
          <p class="mb-[24px] w-[360px] text-[12px]/[16px] text-darkGray sm:w-[438px] sm:text-[18px]/[24px]">
            謝謝您的詢問，按下送出後，將盡速回覆至您的信箱，請耐心等候。
          </p>
          <!-- 送出按鈕 -->
          <button
            type=""
            class="h-[36px] w-[360px] rounded-sm bg-blueGreen text-[16px]/[28px] tracking-tight text-white sm:h-[48px] sm:w-[438px] sm:text-[24px]/[40px]"
          >
            送出
          </button>
        </form>
      </section>
    </main>
  </div>
</template>
