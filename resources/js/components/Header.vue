<template>
  <header
    class="fixed top-6 left-1/2 -translate-x-1/2 z-50 max-w-[1800px] w-full h-[80px] bg-[#F2F2F2]/75 shadow-md rounded-full flex items-center justify-around px-10"
  >
    <!-- Logo 區塊 -->
    <div class="flex items-center space-x-3">
      <img src="@/images/logo.svg" alt="Logo" class="h-[40px] w-[40px]" />
      <span class="text-4xl font-bold text-[#0b0b0b]">五術研究社</span>
    </div>

    <!-- 導覽列 -->
    <nav
      class="flex items-center gap-6 font-['Microsoft_JhengHei'] font-bold text-[#0b0b0b] text-[24px] leading-[1] tracking-normal"
    >
      <router-link
        to="/about"
        class="px-3 py-2 hover:text-[#1f9c95]  whitespace-nowrap"
      >
        關於站主
      </router-link>
      <router-link
        to="/services"
        class="px-3 py-2 hover:text-[#1f9c95]  whitespace-nowrap"
      >
        服務與課程
      </router-link>
    </nav>

    <!-- Icon 區域 -->
    <div class="flex items-center gap-4 text-black">
      <button aria-label="搜尋" class="hover:text-[#1f9c95]">
        <img src="@/images/search.png" alt="搜尋" class="w-8 h-8" />
      </button>
      <button aria-label="購物車" class="hover:text-[#1f9c95]">
        <img src="@/images/cart.png" alt="購物車" class="w-8 h-8 hover:text-[#1f9c95]" />
      </button>
      <router-link to="/login" class="hover:text-[#1f9c95] flex items-center gap-1">
        <img src="@/images/user.png" alt="登入" class="w-8 h-8" />
        <span
          class="font-['Microsoft_JhengHei'] font-normal text-[18px] leading-8 tracking-normal whitespace-nowrap"
        >
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