<template>
  <header class="fixed top-0 left-0 right-0 z-50 shadow-md w-full">
    <div :class="[
      'flex items-center justify-between w-full',
      isMobile ? 'h-[60px]' : 'h-[80px]',
      !isTablet && !isMobile ? 'mt-6 px-4 sm:px-6' : 'mt-0 px-4',
      isDesktop ? 'max-w-[1800px] mx-auto rounded-full' : '',
      'bg-white/75'  
    ]">
      <!-- Logo 區塊 -->
      <div class="flex items-center space-x-2 cursor-pointer">
        <img src="@/images/logo.svg" alt="Logo" :class="[isMobile ? 'h-[30px] w-[30px]' : 'h-[40px] w-[40px]']" />
        <span :class="[isMobile ? 'text-xl' : 'text-2xl sm:text-4xl', 'font-bold text-[#0b0b0b]']">五術研究社</span>
      </div>

      <!-- 平板版 -->
      <div v-if="isTablet && !isMobile" class="flex items-center gap-3">
        <div class="flex items-center gap-3">
          <button aria-label="購物車" class="hover:text-[#1f9c95]">
            <img src="@/images/cart.svg" alt="購物車" class="w-7 h-7" />
          </button>
          <button @click="toggleMobileMenu" aria-label="選單" class="hover:text-[#1f9c95]">
            <img src="@/images/menu.svg" alt="選單" class="w-7 h-7" />
          </button>
        </div>
      </div>

      <!-- 手機版 -->
      <div v-if="isMobile" class="flex items-center gap-3">
        <div class="relative flex items-center">
          <input type="text" placeholder="關鍵字"
            class="bg-white rounded-full pl-8 pr-3 py-1 w-[160px] text-sm outline-none" />
          <img src="@/images/search.png" alt="搜尋" class="absolute left-2 w-4 h-4" />
        </div>
        <div class="flex items-center gap-2">
          <button aria-label="購物車" class="hover:text-[#1f9c95]">
            <img src="@/images/cart.svg" alt="購物車" class="w-6 h-6" />
          </button>
          <button @click="toggleMobileMenu" aria-label="選單" class="hover:text-[#1f9c95]">
            <img src="@/images/menu.svg" alt="選單" class="w-6 h-6" />
          </button>
        </div>
      </div>

      <!-- 電腦版選單 -->
      <div v-if="!isTablet && !isMobile" class="flex-1 flex justify-center">
        <nav
          class="flex items-center gap-4 font-['Microsoft_JhengHei'] font-bold text-black text-[24px] leading-[1] tracking-normal cursor-pointer">
          <router-link to="/about" class="px-3 py-2 hover:text-[#1f9c95] whitespace-nowrap">
            關於站主
          </router-link>
          <router-link to="/services" class="px-3 py-2 hover:text-[#1f9c95] whitespace-nowrap">
            服務與課程
          </router-link>
        </nav>
      </div>

      <!-- 電腦版右側 -->
      <div v-if="!isTablet && !isMobile" class="flex items-center gap-4 text-black">
        <button aria-label="搜尋" class="hover:text-[#1f9c95]">
          <img src="@/images/search.png" alt="搜尋" class="w-8 h-8" />
        </button>
        <button aria-label="購物車" class="hover:text-[#1f9c95]">
          <img src="@/images/cart.svg" alt="購物車" class="w-8 h-8" />
        </button>
        <router-link to="/login" class="hover:text-[#1f9c95] flex items-center gap-1">
          <img src="@/images/user.svg" alt="登入" class="w-8 h-8 " />
          <span
            class="font-['Microsoft_JhengHei'] font-normal text-[18px] leading-8 tracking-normal whitespace-nowrap cursor-pointer">
            登入註冊
          </span>
        </router-link>
      </div>

    </div>
  </header>

  <!-- 展開的選單 (平板和手機版) -->
  <div v-if="(isTablet || isMobile) && isMobileMenuOpen"
    class="fixed left-0 right-0 z-40 w-full bg-[#F2F2F2] shadow-md overflow-hidden transition-all duration-300"
    :class="isMobile ? 'top-[60px]' : 'top-[80px]'" :style="{ maxHeight: isMobileMenuOpen ? '300px' : '0' }">
    <nav class="flex flex-col py-2 px-4">
      <!-- 平板版專用搜尋欄 -->
      <div v-if="isTablet && !isMobile" class="relative flex items-center py-3 border-b border-gray-300">
        <input type="text" placeholder="關鍵字" class="bg-white rounded-full pl-10 pr-4 py-2 w-full outline-none" />
        <img src="@/images/search.png" alt="搜尋" class="absolute left-3 w-5 h-5" />
      </div>

      <router-link to="/about"
        class="font-['Microsoft_JhengHei'] font-bold text-[#0b0b0b] text-[18px] sm:text-[22px] py-3 border-b border-gray-300 hover:text-[#1f9c95]">
        關於站主
      </router-link>
      <router-link to="/services"
        class="font-['Microsoft_JhengHei'] font-bold text-[#0b0b0b] text-[18px] sm:text-[22px] py-3 border-b border-gray-300 hover:text-[#1f9c95]">
        服務與課程
      </router-link>
      <router-link to="/login"
        class="font-['Microsoft_JhengHei'] font-bold text-[#0b0b0b] text-[18px] sm:text-[22px] py-3 flex items-center gap-2 hover:text-[#1f9c95]">
        <img src="@/images/user.svg" alt="登入" class="w-6 h-6" />
        登入註冊
      </router-link>
    </nav>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';

const isMobileMenuOpen = ref(false);

// 追蹤視窗寬度
const windowWidth = ref(window.innerWidth);

// 裝置判斷
const isMobile = computed(() => windowWidth.value <= 600);
const isTablet = computed(() => windowWidth.value > 600 && windowWidth.value <= 1270);
const isDesktop = computed(() => windowWidth.value > 1270);  // 桌面版判斷

// 開關手機版選單
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

// 視窗縮放時更新
const handleResize = () => {
  windowWidth.value = window.innerWidth;

  // 超過平板版，關閉手機選單
  if (windowWidth.value > 1270) {
    isMobileMenuOpen.value = false;
  }
};

// 點擊外面關閉手機選單
const handleClickOutside = (event) => {
  const header = document.querySelector('header');
  const menu = document.querySelector('.menu-dropdown');

  if (isMobileMenuOpen.value && header && !header.contains(event.target) &&
    menu && !menu.contains(event.target)) {
    isMobileMenuOpen.value = false;
  }
};

// 生命週期
onMounted(() => {
  // 監聽視窗變動
  window.addEventListener('resize', handleResize);
  document.addEventListener('click', handleClickOutside);

  handleResize();
});

onUnmounted(() => {
  window.removeEventListener('resize', handleResize);
  document.removeEventListener('click', handleClickOutside);
});

watch([isMobile, isTablet], () => {
  isMobileMenuOpen.value = false;
});
</script>

<style scoped>
.font-MicrosoftJhengHei {
  font-family: 'Microsoft JhengHei', sans-serif;
}

.transition-all {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
</style>