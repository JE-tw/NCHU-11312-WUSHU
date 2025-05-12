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
const isMobile = computed(() => windowWidth.value <= 600); 
const isTablet = computed(() => windowWidth.value > 600 && windowWidth.value <= 1270); 
const isDesktop = computed(() => windowWidth.value > 1270); 


const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
  
  if (isMobileMenuOpen.value) {
    isSearchActive.value = false;
  }
};


const toggleSearch = () => {
  isSearchActive.value = !isSearchActive.value;
};


const handleResize = () => {
  windowWidth.value = window.innerWidth;

  // 超過平板版，關閉手機選單
  if (windowWidth.value > 1270) {
    isMobileMenuOpen.value = false;
  }
};


const handleClickOutside = (event) => {
  const header = document.querySelector('header');
  const menu = document.querySelector('.menu-dropdown');
  const searchBtn = event.target.closest('button[aria-label="搜尋"]');
  const searchInput = event.target.closest('input[placeholder="關鍵字"]');

  
  if (isMobileMenuOpen.value && header && !header.contains(event.target) && menu && !menu.contains(event.target)) {
    isMobileMenuOpen.value = false;
  }

  
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

  cartStore.loadCartFromLocalStorage(); 
});

onUnmounted(() => {
  window.removeEventListener('resize', handleResize);
  document.removeEventListener('click', handleClickOutside);
});

watch([isMobile, isTablet], () => {
  
  isMobileMenuOpen.value = false;
  isSearchActive.value = false;
});

const scrollToAboutSection = () => {
  if (window.location.pathname === '/' || window.location.pathname === '/index.html') {
    const section = document.getElementById('about-section')
    if (section) {
      section.scrollIntoView({ behavior: 'smooth' })
    }
    isMobileMenuOpen.value = false 
  } else {
    
    window.location.href = '/#about-section'
  }
}

</script>

<template>
  <header class="fixed left-0 right-0 top-0 z-50 w-full shadow-md">
    <div :class="[
      'flex w-full items-center',
      isMobile ? 'h-[60px]' : 'h-[80px]',
      !isTablet && !isMobile ? 'mt-6 px-4 sm:px-6' : 'mt-0 px-4',
      isDesktop ? 'mx-auto max-w-[1800px] rounded-full' : '',
      'bg-white/75',
      'justify-between xl:justify-around',
    ]">
      <!-- Logo 區塊 -->
      <div class="flex cursor-pointer items-center space-x-1">
        <img src="@/images/logo.svg" alt="Logo" :class="[isMobile ? 'h-[30px] w-[30px]' : 'h-[40px] w-[40px]']" />
        <Link :href="route('wushu.home')" class="whitespace-nowrap px-3 py-2 hover:text-[#1f9c95]">
        <span :class="[isMobile ? 'text-xl' : 'text-2xl sm:text-4xl', 'font-bold text-[#0b0b0b]']"> 五術研究社 </span>
        </Link>
      </div>

      <!-- 電腦版選單 -->
      <div v-if="!isTablet && !isMobile" class="flex justify-center">
        <nav
          class="flex cursor-pointer items-center gap-4 font-['Microsoft_JhengHei'] text-[24px] font-bold leading-[1] tracking-normal text-black">
          <Link :href="route('wushu.home') + '#about-section'" class="whitespace-nowrap px-3 py-2 hover:text-[#1f9c95]">
          關於站主 </Link>
          <Link :href="route('wushu.list')" class="whitespace-nowrap px-3 py-2 hover:text-[#1f9c95]"> 服務與課程 </Link>
        </nav>
      </div>

      <!-- 電腦版右側 -->
      <div v-if="!isTablet && !isMobile" class="flex items-center gap-4 text-black">
        <!-- 購物車 -->
        <div class="relative">
          <Link :href="route('wushu.cart')" aria-label="購物車"
            class="group relative flex h-8 w-8 items-center justify-center">
          <img src="@/images/cart.svg" alt="購物車" class="absolute inset-0 h-8 w-8 group-hover:hidden" />
          <img src="@/images/gcart.svg" alt="購物車懸停" class="absolute inset-0 hidden h-8 w-8 group-hover:block" />
          <!-- 數量氣泡 -->
          <span v-if="cartCount > 0"
            class="absolute -right-2 -top-2 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs text-white">
            {{ cartCount }}
          </span>
          </Link>
        </div>

        <!-- 登入註冊 -->
        <Link :href="user ? route('wushu.memberCenter') : route('login')" class="group flex h-8 items-center gap-1">
        <div class="relative h-8 w-8">
          <img src="@/images/user.svg" alt="登入" class="absolute inset-0 h-8 w-8 group-hover:hidden" />
          <img src="@/images/guser.svg" alt="登入懸停" class="absolute inset-0 hidden h-8 w-8 group-hover:block" />
        </div>
        <span
          class="cursor-pointer whitespace-nowrap font-['Microsoft_JhengHei'] text-[18px] font-normal leading-8 tracking-normal group-hover:text-[#1f9c95]">
          <template v-if="user">
            會員中心
          </template>
          <template v-else>
            會員登入
          </template>
        </span>
        </Link>
      </div>

      <!-- 平板版 -->
      <div v-if="isTablet && !isMobile" class="flex items-center gap-3">
        <div class="flex items-center gap-3">
          <!-- 購物車 -->
          <div class="relative">
            <Link :href="route('wushu.cart')" aria-label="購物車"
              class="group relative flex h-7 w-7 items-center justify-center">
            <img src="@/images/cart.svg" alt="購物車" class="absolute inset-0 h-7 w-7 group-hover:hidden" />
            <img src="@/images/gcart.svg" alt="購物車懸停" class="absolute inset-0 hidden h-7 w-7 group-hover:block" />
            </Link>
            <!-- 數量氣泡 -->
            <span v-if="cartCount > 0"
              class="absolute -right-2 -top-2 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs text-white">
              {{ cartCount }}
            </span>
          </div>

          <!-- 選單 -->
          <button @click="toggleMobileMenu" aria-label="選單"
            class="flex h-7 items-center justify-center hover:text-[#1f9c95]">
            <img src="@/images/menu.svg" alt="選單" class="h-7 w-7" />
          </button>
        </div>
      </div>

      <!-- 手機版 -->
      <div v-if="isMobile" class="flex items-center gap-3">
        <div class="flex items-center gap-2">
          <!-- 購物車 -->
          <div class="relative">
            <Link :href="route('wushu.cart')" aria-label="購物車"
              class="group relative flex h-6 w-6 items-center justify-center">
            <img src="@/images/cart.svg" alt="購物車" class="absolute inset-0 h-6 w-6 group-hover:hidden" />
            <img src="@/images/gcart.svg" alt="購物車懸停" class="absolute inset-0 hidden h-6 w-6 group-hover:block" />
            </Link>
            <!-- 數量氣泡 -->
            <span v-if="cartCount > 0"
              class="absolute -right-1 -top-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] text-white">
              {{ cartCount }}
            </span>
          </div>

          <!-- 選單 -->
          <button @click="toggleMobileMenu" aria-label="選單"
            class="flex h-6 items-center justify-center hover:text-[#1f9c95]">
            <img src="@/images/menu.svg" alt="選單" class="h-6 w-6" />
          </button>
        </div>
      </div>
    </div>
  </header>


  <!-- 展開的選單 (平板和手機版) -->
  <div v-if="(isTablet || isMobile) && isMobileMenuOpen"
    class="fixed left-0 right-0 z-40 w-full overflow-hidden bg-[#F2F2F2] shadow-md transition-all duration-300"
    :class="isMobile ? 'top-[60px]' : 'top-[80px]'" :style="{ maxHeight: isMobileMenuOpen ? '300px' : '0' }">
    <nav class="flex flex-col py-2">
      <!-- 關於站主（滾動至區塊） -->
      <a href="#" @click.prevent="scrollToAboutSection"
        class="flex items-center border-b border-gray-300 px-6 py-3 font-['Microsoft_JhengHei'] text-[18px] font-bold text-[#0b0b0b] hover:bg-darkGray hover:text-white sm:px-10 sm:text-[22px]"
        :class="isMobile ? 'justify-center' : 'justify-start'">
        關於站主
      </a>

      <!-- 服務與課程 -->
      <Link :href="route('wushu.list')"
        class="flex items-center border-b border-gray-300 px-6 py-3 font-['Microsoft_JhengHei'] text-[18px] font-bold text-[#0b0b0b] hover:bg-darkGray hover:text-white sm:px-10 sm:text-[22px]"
        :class="isMobile ? 'justify-center' : 'justify-start'">
      服務與課程
      </Link>

      <!-- 登入 / 會員中心 -->
      <template v-if="user">
        <Link :href="route('wushu.memberCenter')"
          class="flex items-center gap-2 px-6 py-3 font-['Microsoft_JhengHei'] text-[18px] font-bold text-[#0b0b0b] hover:bg-darkGray hover:text-white sm:px-10 sm:text-[22px]"
          :class="isMobile ? 'justify-center' : 'justify-start'">
        會員中心
        </Link>
      </template>
      <template v-else>
        <Link :href="route('login')"
          class="flex items-center gap-2 px-6 py-3 font-['Microsoft_JhengHei'] text-[18px] font-bold text-[#0b0b0b] hover:bg-darkGray hover:text-white sm:px-10 sm:text-[22px]"
          :class="isMobile ? 'justify-center' : 'justify-start'">
        會員登入
        </Link>
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
