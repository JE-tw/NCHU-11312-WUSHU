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
        <div class="flex justify-between gap-x-6 w-full max-w-md">
          <button @click="tab = 'signup'" :class="tab === 'signup' ? activeTabClass : inactiveTabClass"
            class="text-lg px-20 py-4 rounded-md focus:outline-none transition-colors duration-300"
            style="background-color: #1F9C95; color: white;">
            登入
          </button>
          <button @click="tab = 'login'" :class="tab === 'login' ? activeTabClass : inactiveTabClass"
            class="text-lg px-20 py-4 rounded-md focus:outline-none transition-colors duration-300">
            註冊
          </button>
        </div>

        <div class="w-full max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-300">


          <!-- Content -->
          <div class="p-8">

            <!-- Signup Form -->
            <form v-if="tab === 'signup'" class="space-y-4">
              <div class="relative">
                <input type="text" placeholder="Full Name"
                  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" />
                <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
              </div>

              <!-- Email -->
              <div class="relative">
                <input type="email" placeholder="Email"
                  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" />
                <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
              </div>

              <!-- Password -->
              <div class="relative">
                <input type="password" placeholder="Password"
                  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" />
                <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
              </div>

              <button
                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 rounded-md hover:opacity-90 transition-opacity duration-300 transform hover:scale-105">
                Sign Up
              </button>
            </form>

            <!-- Login Form -->
            <form v-else class="space-y-4">
              <!-- Email -->
              <div class="relative">
                <input type="email" placeholder="Email"
                  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" />
                <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
              </div>

              <!-- Password -->
              <div class="relative">
                <input type="password" placeholder="Password"
                  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" />
                <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
              </div>
              <button
                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2 rounded-md hover:opacity-90 transition-opacity duration-300 transform hover:scale-105">
                Login
              </button>
            </form>

            <!-- Social Buttons -->
            <div class="mt-6">
              <p class="text-center text-gray-600 mb-4">Or continue with</p>
              <div class="flex justify-center space-x-4">
                <button
                  class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300">
                  <i class="fab fa-facebook-f mr-2"></i> Facebook
                </button>
                <button
                  class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors duration-300">
                  <i class="fab fa-google mr-2"></i> Google
                </button>
              </div>
            </div>
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
