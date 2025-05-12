<script setup>
import Header from '@/components/Header.vue';
import Footer from '@/components/Footer.vue';

import { ref } from 'vue';

const title = ref('隱私權政策 : ');

const policyPoints = ref([
  '1. 隱私政策內容，包括本網站如何處理在您使用網站服務時收集到的個人識別資料。',
  '2. 當您造訪本網站或使用本網站所提供之功能服務時，將請您提供必要的個人資料，並在該特定目的範圍內處理及利用您的個人資料；非經您同意，本網站不會將個人資料用於其他用途。',
  '3. 本網站在您使用服務信箱、問卷調查等互動性功能時，會保留您所提供之姓名、電子郵件、聯絡方式等。',
  '4. 為提供精確的服務，我們會將收集的問卷調查內容進行統計與分析，分析結果之統計數據或說明文字呈現，除供內部研究外，我們會視需要公佈統計數據及說明文字，但不涉及特定個人之資料。',
  '5. 您可以隨時向我們提出請求，以更正或刪除您的帳戶或本網站所蒐集的個人資料等隱私資訊。',
  '6. 本網站絕不會提供、交換、出租或出售任何您的個人資料給其他個人、團體、私人企業或公務機關，但有法律依據或合約義務者，不在此限。',
  '7. 本網站隱私權保護政策將因應需求隨時進行修正，修正後的條款將刊登於網站上。',
]);
</script>

<template>
  <div>
    <Header />
    <main class="min-h-screen w-full">
      <div class="flex h-[444px] items-center justify-center bg-black">
        <h1
          class="md:underline-offset-[18px] mt-24 text-center font-serif text-[32px] font-semibold leading-snug text-white underline decoration-[2px] underline-offset-[12px] sm:text-[52px] sm:underline-offset-[16px] xl:text-[64px]"
        >
          隱私權政策
        </h1>
      </div>

      <div class="container mx-auto px-4 py-8">
        <div class="mx-auto mb-2 mt-3 max-w-5xl px-4 text-left">
          <p class="md:text-4xl font-['Microsoft_JhengHei'] text-[32px] font-bold text-deepTeal sm:text-[36px]">
            {{ title }}
          </p>
        </div>

        <div class="md:p-10 mx-auto max-w-5xl bg-white p-6 sm:p-8">
          <div
            class="md:text-[24px] md:leading-[55px] space-y-6 text-left font-['Microsoft_JhengHei'] text-[20px] font-medium leading-[36px] tracking-[0.02em] text-black sm:text-[22px] sm:leading-[44px]"
          >
            <p v-for="(point, index) in policyPoints" :key="index">
              {{ point }}
            </p>
          </div>
        </div>
      </div>
    </main>
    <Footer />
  </div>
</template>
