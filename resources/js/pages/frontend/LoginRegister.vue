<script setup>
import { ref, defineComponent } from 'vue';
import Header from '../../components/Header.vue';


const tab = ref('signup')

const activeTabClass = 'bg-blue-500 text-white'
const inactiveTabClass = 'bg-gray-200 text-gray-700'


</script>


<template>
  <header class="flex h-[234px] w-full flex-col items-center bg-black sm:h-[303px] xl:h-[444px]">
    <p
      class="pt-[120px] font-serif text-[32px]/[46px] font-bold text-grayWhite sm:pt-[160px] sm:text-[52px]/[75px] xl:pt-[224px] xl:text-[64px]/[92px]">
      登入註冊
    </p>
    <span class="w-[120px] border-b-2 border-grayWhite sm:w-[300px]"></span>
  </header>

  <div class="bg-white min-h-screen flex justify-center mt-8">
    <div class="container mx-auto px-4">
      <Header />

      <!-- Flex 容器：包含 Tabs + 卡片 -->
      <div class="flex flex-col items-center gap-4">
        <!-- Tabs 在卡片上方，左右對齊 -->
        <div class="flex justify-between items-center w-full max-w-md">
          <button @click="tab = 'signup'" :class="tab === 'signup' ? activeTabClass : inactiveTabClass"
            class="text-2xl px-16 py-3 rounded-md focus:outline-none transition-colors duration-300 whitespace-nowrap"
            style="background-color: #1F9C95; color: white;">
            登入
          </button>

          <!-- 這裡的中間線條保持顯示 -->
          <div class="w-px h-12 bg-gray-300"></div>

          <button @click="tab = 'login'" :class="tab === 'login' ? activeTabClass : inactiveTabClass"
            class="text-2xl px-16 py-3 rounded-md focus:outline-none transition-colors duration-300 whitespace-nowrap">
            註冊
          </button>
        </div>

        <div
          class="w-full max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-300">
          <!-- Content -->
          <div class="p-8">
            <!-- Signup Form -->
            <form v-if="tab === 'signup'" class="space-y-6">
              <div class="flex flex-col">
                <label class="text-2xl font-semibold text-gray-700 mb-2">帳號</label>
                <div class="relative">
                  <input type="text" placeholder="帳號"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#518C95] pl-10" />
                  <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
                </div>
              </div>

              <div class="flex flex-col">
                <label class="text-2xl font-semibold text-gray-700 mb-2">密碼</label>
                <div class="relative">
                  <input type="password" placeholder="密碼"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#518C95] pl-10" />
                  <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                </div>
              </div>

              <!-- 同意條款 Checkbox -->
              <div class="flex items-start space-x-2 mt-2">
                <input type="checkbox" id="terms"
                  class="w-5 h-5 text-[#518C95] focus:ring-[#518C95] border-gray-300 rounded mt-1">
                <label for="terms" class="text-gray-600 text-base">
                  同意本站的
                  <a href="http://127.0.0.1:8001/wushu/Policy" target="_blank" class="text-blue-500 hover:underline">
                    付款與退款政策
                  </a>
                  與
                  <a href="http://127.0.0.1:8001/wushu/Privacy" target="_blank" class="text-blue-500 hover:underline">
                    隱私權政策
                  </a>
                </label>
              </div>

              <!-- 忘記密碼 -->
              <div class="flex justify-start">
                <a href="#" class="text-gray-400 text-lg hover:underline">忘記密碼？</a>
              </div>

              <!-- 登入按鈕 -->
              <button
                class="w-full bg-[#518C95] text-white text-lg py-3 rounded-md hover:opacity-90 transition-opacity duration-300 transform hover:scale-105">
                登入會員
              </button>
            </form>

            <!-- Login Form -->
            <form v-else class="space-y-4">
              <!-- Email -->
              <div class="relative">
                <input type="email" placeholder="帳號"
                  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" />
                <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
              </div>

              <!-- Password -->
              <div class="relative">
                <input type="password" placeholder="密碼"
                  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" />
                <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
              </div>
              <button
                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 rounded-md hover:opacity-90 transition-opacity duration-300 transform hover:scale-105">
                Login
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<!-- Input component with icon (reusable) -->

<!-- FontAwesome & Tailwind -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

body {
  font-family: 'Poppins', sans-serif;
}
</style>

<!-- External Links (place in index.html or main layout) -->
<!--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
-->
