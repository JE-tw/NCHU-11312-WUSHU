<template>
    <header
      class="fixed top-6 left-1/2 -translate-x-1/2 z-50 w-[1800px] h-[80px] bg-[#F2F2F2]/75 shadow-md rounded-full flex items-center justify-between px-8">
  
     
      <div class="flex items-center space-x-3">
        <img src="../../images/logo.svg" alt="Logo"  class="h-8 w-8" />
        <span class="text-3xl font-bold text-[#0b0b0b]">五術研究社</span>
      </div>
  
      <!-- 導覽列 -->
      <nav
        class="absolute top-4 left-[768px] w-[264px] h-[48px] flex items-center gap-6 font-MicrosoftJhengHei text-[#0b0b0b]">
        <router-link to="/about" class="w-[120px] h-[48px] px-3 py-2 flex items-center gap-2 hover:text-[#1f9c95]">
          關於站主
        </router-link>
        <router-link to="/services" class="w-[144px] h-[48px] px-3 py-2 flex items-center gap-2 hover:text-[#1f9c95]">
          服務與課程
        </router-link>
      </nav>
  
      <!-- Icon 區域 -->
      <div class="absolute top-6 left-[1432px] w-[220px] h-[32.1px] flex items-center gap-4 text-gray-700">
        <button aria-label="搜尋" class="hover:text-indigo-600">
          <img src="../../images/search.png" alt="搜尋" class="w-8 h-[32.1px]" />
        </button>
        <button aria-label="購物車" class="hover:text-indigo-600">
          <img src="../../images/cart.png" alt="購物車" class="w-8 h-[32.1px]" />
        </button>
        <router-link to="/login" class="hover:text-indigo-600 flex items-center gap-1">
          <img src="../../images/user.png" alt="登入" class="w-8 h-[32.1px]" />
          <span
            class="w-[72px] h-[24px] font-MicrosoftJhengHei font-normal text-[18px] leading-[32px] tracking-normal whitespace-nowrap">
            登入註冊
          </span>
        </router-link>
      </div>
    </header>
  </template>
  
  <script setup>
  </script>
  
  <style scoped>
  .font-MicrosoftJhengHei {
    font-family: 'Microsoft JhengHei', sans-serif;
  }
  </style>
  