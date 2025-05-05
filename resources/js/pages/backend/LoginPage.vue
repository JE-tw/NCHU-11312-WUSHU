<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="bg-white p-8 rounded-lg shadow-lg w-[468px] h-[400px]">
      
        
        <!-- 登入表單 -->
        <form @submit.prevent="handleLogin">
          <div class="mb-4">
            <label for="email" class="block text-[32px] font-bold text-black">帳號</label>
            <input
              type="email"
              id="email"
              v-model="email"
              class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="輸入電子郵件"
              required
            />
          </div>
  
          <div class="mb-6">
            <label for="password" class="block text-sm font-bold text-black">密碼</label>
            <input
              type="password"
              id="password"
              v-model="password"
              class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="輸入密碼"
              required
            />
          </div>
  
          <button
            type="submit"
            class="w-full bg-deepTeal text-white p-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            登入
          </button>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  const email = ref('')
  const password = ref('')
  
  // 處理登入邏輯
  const handleLogin = () => {
    // 在這裡執行登入邏輯
    console.log('登入表單提交：', { email: email.value, password: password.value })
  }
  </script>
  
  <style scoped>
  
  </style>
  