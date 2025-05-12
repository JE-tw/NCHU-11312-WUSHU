<script setup>
import { useCartStore } from '@/stores/cart'; //cart
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
import { storeToRefs } from 'pinia'

import { usePage, Link } from '@inertiajs/vue3';
const page = usePage();
const user = computed(() => page.props.auth.user);

const isMobileMenuOpen = ref(false);
const isSearchActive = ref(false);

// cart 數量顯示
const cartStore = useCartStore();

const cartCount = computed(() => cartStore.cartCount);

// 追蹤視窗寬度
const windowWidth = ref(window.innerWidth);

// 裝置判斷 - 使用 tailwindcss 的斷點
const isMobile = computed(() => windowWidth.value <= 600); // sm: 600px
const isTablet = computed(() => windowWidth.value > 600 && windowWidth.value <= 1270); // xl: 1270px
const isDesktop = computed(() => windowWidth.value > 1270); // 桌面版判斷

// 開關手機版選單
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
  // 如果開啟選單，則關閉搜尋
  if (isMobileMenuOpen.value) {
    isSearchActive.value = false;
  }
};

// 開關搜尋功能
const toggleSearch = () => {
  isSearchActive.value = !isSearchActive.value;
};

// 視窗縮放時更新
const handleResize = () => {
  windowWidth.value = window.innerWidth;

  // 超過平板版，關閉手機選單
  if (windowWidth.value > 1270) {
    isMobileMenuOpen.value = false;
  }
};

// 點擊外面關閉手機選單和搜尋
const handleClickOutside = (event) => {
  const header = document.querySelector('header');
  const menu = document.querySelector('.menu-dropdown');
  const searchBtn = event.target.closest('button[aria-label="搜尋"]');
  const searchInput = event.target.closest('input[placeholder="關鍵字"]');

  // 關閉選單
  if (isMobileMenuOpen.value && header && !header.contains(event.target) && menu && !menu.contains(event.target)) {
    isMobileMenuOpen.value = false;
  }

  // 關閉搜尋 (但不包括點擊搜尋按鈕或搜尋框的情況)
  if (isSearchActive.value && !searchBtn && !searchInput) {
    const isClickInsideSearch = event.target.closest('.relative') !== null;
    if (!isClickInsideSearch) {
      isSearchActive.value = false;
    }
  }
};

// 生命週期
onMounted(() => {
  // 監聽視窗變動
  window.addEventListener('resize', handleResize);
  document.addEventListener('click', handleClickOutside);

  handleResize();

  cartStore.loadCartFromLocalStorage(); // 確保頁面刷新後還是有資料
});

onUnmounted(() => {
  window.removeEventListener('resize', handleResize);
  document.removeEventListener('click', handleClickOutside);
});

watch([isMobile, isTablet], () => {
  // 如果裝置類型改變，關閉搜尋和選單
  isMobileMenuOpen.value = false;
  isSearchActive.value = false;
});
</script>

<template>
  <header class="fixed left-0 right-0 top-0 z-50 w-full shadow-md">
    <div
      :class="[
        'flex w-full items-center',
        isMobile ? 'h-[60px]' : 'h-[80px]',
        !isTablet && !isMobile ? 'mt-6 px-4 sm:px-6' : 'mt-0 px-4',
        isDesktop ? 'mx-auto max-w-[1800px] rounded-full' : '',
        'bg-white/75',
        'justify-between xl:justify-around',
      ]"
    >
      <!-- Logo 區塊 -->
      <div class="flex cursor-pointer items-center space-x-1">
        <img src="@/images/logo.svg" alt="Logo" :class="[isMobile ? 'h-[30px] w-[30px]' : 'h-[40px] w-[40px]']" />
        <a href="http://127.0.0.1:8000" class="whitespace-nowrap px-3 py-2 hover:text-[#1f9c95]">
          <span :class="[isMobile ? 'text-xl' : 'text-2xl sm:text-4xl', 'font-bold text-[#0b0b0b]']"> 五術研究社 </span>
        </a>
      </div>

      <!-- 電腦版選單 -->
      <div v-if="!isTablet && !isMobile" class="flex justify-center">
        <nav class="flex cursor-pointer items-center gap-4 font-['Microsoft_JhengHei'] text-[24px] font-bold leading-[1] tracking-normal text-black">
          <a href="http://127.0.0.1:8000/#about-section" class="whitespace-nowrap px-3 py-2 hover:text-[#1f9c95]"> 關於站主 </a>
          <a href="http://127.0.0.1:8000/wushu/ServiceCourse" class="whitespace-nowrap px-3 py-2 hover:text-[#1f9c95]"> 服務與課程 </a>
        </nav>
      </div>

      <!-- 電腦版右側 -->
      <div v-if="!isTablet && !isMobile" class="flex items-center gap-4 text-black">
        <!-- 搜尋功能 -->
        <!-- <div class="group relative flex h-8 items-center">
          <button v-if="!isSearchActive" @click="toggleSearch" aria-label="搜尋" class="relative flex h-8 w-8 items-center justify-center">
            <img src="@/images/search.png" alt="搜尋" class="absolute inset-0 h-8 w-8 group-hover:hidden" />
            <img src="@/images/g1search.svg" alt="搜尋懸停" class="absolute inset-0 hidden h-8 w-8 group-hover:block" />
          </button>

          <!-- 搜尋列 -->
        <!-- <div v-if="isSearchActive" class="absolute right-0 top-1/2 flex -translate-y-1/2 items-center rounded-full bg-white shadow-md">
            <input type="text" placeholder="關鍵字" class="w-[200px] rounded-full bg-white py-2 pl-8 pr-3 outline-none" />
            <img src="@/images/g2search.svg" alt="搜尋" class="absolute left-2 h-5 w-5" />
            <button @click="toggleSearch" class="px-3 hover:text-[#1f9c95]">
              <span class="text-lg">×</span>
            </button>
          </div>
        </div> -->

        <!-- 購物車 -->
        <div class="relative">
          <a href="http://127.0.0.1:8000/wushu/Cart" aria-label="購物車" class="group relative flex h-8 w-8 items-center justify-center">
            <img src="@/images/cart.svg" alt="購物車" class="absolute inset-0 h-8 w-8 group-hover:hidden" />
            <img src="@/images/gcart.svg" alt="購物車懸停" class="absolute inset-0 hidden h-8 w-8 group-hover:block" />
            <!-- 數量氣泡 -->
            <span
              v-if="cartCount > 0"
              class="absolute -right-2 -top-2 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs text-white"
            >
              {{ cartCount }}
            </span>
          </a>
        </div>

        <!-- 登入註冊 -->
        <!-- <a href="http://127.0.0.1:8000/wushu/MemberCenter" class="group flex h-8 items-center gap-1"> -->
        <a href="" class="group flex h-8 items-center gap-1">
          <div class="relative h-8 w-8">
            <img src="@/images/user.svg" alt="登入" class="absolute inset-0 h-8 w-8 group-hover:hidden" />
            <img src="@/images/guser.svg" alt="登入懸停" class="absolute inset-0 hidden h-8 w-8 group-hover:block" />
          </div>
          <span
            class="cursor-pointer whitespace-nowrap font-['Microsoft_JhengHei'] text-[18px] font-normal leading-8 tracking-normal group-hover:text-[#1f9c95]"
          >
            <!-- 登入註冊 或是 會員中心 -->
            <template v-if="user">
              <Link
                href="/wushu/MemberCenter"
                class="cursor-pointer whitespace-nowrap font-['Microsoft_JhengHei'] text-[18px] font-normal leading-8 tracking-normal group-hover:text-[#1f9c95]"
                >會員中心</Link
              >
            </template>
            <template v-else>
              <Link
                href="/login"
                class="cursor-pointer whitespace-nowrap font-['Microsoft_JhengHei'] text-[18px] font-normal leading-8 tracking-normal group-hover:text-[#1f9c95]"
                >會員登入</Link
              >
            </template>
          </span>
        </a>
      </div>

      <!-- 平板版 -->
      <div v-if="isTablet && !isMobile" class="flex items-center gap-3">
        <div class="flex items-center gap-3">
          <!-- 搜尋 -->
          <div class="group relative flex h-7 items-center">
            <!-- <button v-if="!isSearchActive" @click="toggleSearch" aria-label="搜尋" class="relative flex h-7 w-7 items-center justify-center">
              <img src="@/images/search.png" alt="搜尋" class="absolute inset-0 h-7 w-7 group-hover:hidden" />
              <img src="@/images/g1search.svg" alt="搜尋懸停" class="absolute inset-0 hidden h-7 w-7 group-hover:block" />
            </button> -->

            <!-- 平板搜尋列 -->
            <!-- <div v-if="isSearchActive" class="absolute right-0 top-1/2 flex -translate-y-1/2 items-center rounded-full bg-white shadow-md">
              <input type="text" placeholder="關鍵字" class="w-[200px] rounded-full bg-white py-2 pl-8 pr-3 outline-none" />
              <img src="@/images/g2search.svg" alt="搜尋" class="absolute left-2 h-5 w-5" />
              <button @click="toggleSearch" class="px-3 hover:text-[#1f9c95]">
                <span class="text-lg">×</span>
              </button>
            </div> -->
          </div>

          <!-- 購物車 -->
          <div class="relative">
            <a href="http://127.0.0.1:8000/wushu/Cart" aria-label="購物車" class="group relative flex h-7 w-7 items-center justify-center">
              <img src="@/images/cart.svg" alt="購物車" class="absolute inset-0 h-7 w-7 group-hover:hidden" />
              <img src="@/images/gcart.svg" alt="購物車懸停" class="absolute inset-0 hidden h-7 w-7 group-hover:block" />
            </a>
            <!-- 數量氣泡 -->
            <span
              v-if="cartCount > 0"
              class="absolute -right-2 -top-2 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs text-white"
            >
              {{ cartCount }}
            </span>
          </div>

          <!-- 選單 -->
          <button @click="toggleMobileMenu" aria-label="選單" class="flex h-7 items-center justify-center hover:text-[#1f9c95]">
            <img src="@/images/menu.svg" alt="選單" class="h-7 w-7" />
          </button>
        </div>
      </div>

      <!-- 手機版 -->
      <div v-if="isMobile" class="flex items-center gap-3">
        <!-- <div class="relative flex items-center">
          <input type="text" placeholder="關鍵字" class="w-[160px] rounded-full bg-white py-1 pl-8 pr-3 text-sm outline-none" />
          <img src="@/images/g2search.svg" alt="搜尋" class="absolute left-2 h-4 w-4" />
        </div> -->
        <div class="flex items-center gap-2">
          <!-- 購物車 -->
          <div class="relative">
            <a href="http://127.0.0.1:8000/wushu/Cart" aria-label="購物車" class="group relative flex h-6 w-6 items-center justify-center">
              <img src="@/images/cart.svg" alt="購物車" class="absolute inset-0 h-6 w-6 group-hover:hidden" />
              <img src="@/images/gcart.svg" alt="購物車懸停" class="absolute inset-0 hidden h-6 w-6 group-hover:block" />
            </a>
            <!-- 數量氣泡 -->
            <span
              v-if="cartCount > 0"
              class="absolute -right-1 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] text-white"
            >
              {{ cartCount }}
            </span>
          </div>

          <!-- 選單 -->
          <button @click="toggleMobileMenu" aria-label="選單" class="flex h-6 items-center justify-center hover:text-[#1f9c95]">
            <img src="@/images/menu.svg" alt="選單" class="h-6 w-6" />
          </button>
        </div>
      </div>
    </div>
  </header>

  <!-- 展開的選單 (平板和手機版) -->
  <div
    v-if="(isTablet || isMobile) && isMobileMenuOpen"
    class="fixed left-0 right-0 z-40 w-full overflow-hidden bg-[#F2F2F2] shadow-md transition-all duration-300"
    :class="isMobile ? 'top-[60px]' : 'top-[80px]'"
    :style="{ maxHeight: isMobileMenuOpen ? '300px' : '0' }"
  >
    <nav class="flex flex-col py-2">
      <a
        href="http://127.0.0.1:8000/wushu#about-section"
        class="flex items-center border-b border-gray-300 px-6 py-3 font-['Microsoft_JhengHei'] text-[18px] font-bold text-[#0b0b0b] hover:bg-darkGray hover:text-white sm:px-10 sm:text-[22px]"
        :class="isMobile ? 'justify-center' : 'justify-start'"
      >
        關於站主
      </a>

      <a
        href="http://127.0.0.1:8000/wushu/ServiceCourse"
        class="flex items-center border-b border-gray-300 px-6 py-3 font-['Microsoft_JhengHei'] text-[18px] font-bold text-[#0b0b0b] hover:bg-darkGray hover:text-white sm:px-10 sm:text-[22px]"
        :class="isMobile ? 'justify-center' : 'justify-start'"
      >
        服務與課程
      </a>

      <!-- <a
        href="http://127.0.0.1:8000/wushu/MemberCenter"
        class="flex items-center gap-2 px-6 py-3 font-['Microsoft_JhengHei'] text-[18px] font-bold text-[#0b0b0b] hover:bg-darkGray hover:text-white sm:px-10 sm:text-[22px]"
        :class="isMobile ? 'justify-center' : 'justify-start'"
      >
      登入註冊
    </a> -->
      <!-- 登入註冊 -->
      <template v-if="user">
        <Link
          href="/wushu/MemberCenter"
          class="flex items-center gap-2 px-6 py-3 font-['Microsoft_JhengHei'] text-[18px] font-bold text-[#0b0b0b] hover:bg-darkGray hover:text-white sm:px-10 sm:text-[22px]"
          :class="isMobile ? 'justify-center' : 'justify-start'"
          >會員中心</Link
        >
      </template>
      <template v-else>
        <Link
          href="/login"
          class="flex items-center gap-2 px-6 py-3 font-['Microsoft_JhengHei'] text-[18px] font-bold text-[#0b0b0b] hover:bg-darkGray hover:text-white sm:px-10 sm:text-[22px]"
          :class="isMobile ? 'justify-center' : 'justify-start'"
          >會員登入</Link
        >
      </template>
    </nav>
  </div>
</template>

<style scoped>
.font-MicrosoftJhengHei {
  font-family: 'Microsoft JhengHei', sans-serif;
}

.transition-all {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 300ms;
}
</style>
