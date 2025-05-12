<template>
  <footer class="bg-[#0b0b0b] text-white w-full text-sm font-['Microsoft_JhengHei']">
    <!-- 手機版佈局 (小於600px) -->
    <div class="max-w-[1903px] mx-auto px-4 py-6 flex flex-col sm:hidden">
      <div class="w-full text-center mb-8">
        <p class="font-bold text-[20px] leading-[100%] tracking-[0]">
          ©2022 五術研究社版權所有
        </p>
      </div>

      <div class="flex flex-row justify-center gap-16">
        <!-- 左側鏈接 -->
        <div class="flex flex-col gap-4 font-bold text-[18px] leading-[100%] tracking-[0]">
          <a href="/wushu/ContactUs" class="hover:text-blueGreen hover:underline py-1">聯絡我們</a>
          <a href="/wushu/Policy" class="hover:text-blueGreen hover:underline py-1">付款與退款流程</a>
          <a href="/wushu/Privacy" class="hover:text-blueGreen hover:underline py-1">隱私權政策</a>
        </div>

        <!-- 右側社交媒體圖標 -->
        <div class="flex flex-col gap-4">
          <a href="https://www.facebook.com/?locale=zh_TW" target="_blank" aria-label="Facebook"
            class="social-icon-link">
            <img src="@/images/facebook.png" alt="facebook" class="w-8 h-8" />
          </a>
          <a href="https://www.youtube.com/" target="_blank" aria-label="YouTube" class="social-icon-link">
            <img src="@/images/youtube-白 1.png" alt="youtube" class="w-8 h-8" />
          </a>
        </div>
      </div>
    </div>

    <!-- 平板版佈局 (600px-1270px) -->
    <div class="max-w-[1903px] mx-auto px-4 py-6 hidden sm:flex xl:hidden flex-col items-center">
      <div class="text-center mb-6">
        <p class="font-bold text-[22px] leading-[100%] tracking-[0]">
          ©2022 五術研究社版權所有
        </p>
      </div>

      <div class="flex flex-row items-center justify-center gap-6">
        <a href="/wushu/ContactUs"
          class="hover:text-blueGreen hover:underline font-bold text-[22px] leading-[100%] tracking-[0]">聯絡我們</a>
        <div class="h-6 border-r border-white"></div>
        <a href="/wushu/Policy"
          class="hover:text-blueGreen hover:underline font-bold text-[22px] leading-[100%] tracking-[0]">付款與退款流程</a>
        <div class="h-6 border-r border-white"></div>
        <a href="/wushu/Privacy"
          class="hover:text-blueGreen hover:underline font-bold text-[22px] leading-[100%] tracking-[0]">隱私權政策</a>

        <a href="https://www.facebook.com/?locale=zh_TW" target="_blank" aria-label="Facebook"
          class="social-icon-link ml-4">
          <img src="@/images/facebook.png" alt="facebook" class="w-9 h-9" />
        </a>
        <a href="https://www.youtube.com/" target="_blank" aria-label="YouTube" class="social-icon-link">
          <img src="@/images/youtube-白 1.png" alt="youtube" class="w-9 h-9" />
        </a>
      </div>
    </div>

    <!-- 電腦版佈局 (大於等於1270px) -->
    <div class="max-w-[1903px] mx-auto px-4 h-[120px] hidden xl:flex items-center justify-around">
      <div class="w-[313px] text-left">
        <p class="font-bold text-[24px] leading-[100%] tracking-[0] whitespace-nowrap">
          ©2022 五術研究社版權所有
        </p>
      </div>

      <div class="flex gap-6 font-bold text-[24px] leading-[100%] tracking-[0]">
        <a href="/wushu/ContactUs"
          class="hover:text-blueGreen hover:underline border-r border-white pr-6">聯絡我們</a>
        <a href="/wushu/Policy"
          class="hover:text-blueGreen hover:underline border-r border-white pr-6">付款與退款流程</a>
        <a href="/wushu/Privacy" class="hover:text-blueGreen hover:underline">隱私權政策</a>
      </div>

      <div class="w-[220px] flex items-center justify-end gap-3">
        <a href="https://www.facebook.com/?locale=zh_TW" target="_blank" aria-label="Facebook" class="social-icon-link">
          <img src="@/images/facebook.png" alt="facebook" class="w-10 h-10" />
        </a>
        <a href="https://www.youtube.com/" target="_blank" aria-label="YouTube" class="social-icon-link">
          <img src="@/images/youtube-白 1.png" alt="youtube" class="w-10 h-10" />
        </a>
      </div>
    </div>
  </footer>
</template>

<style scoped>

</style>