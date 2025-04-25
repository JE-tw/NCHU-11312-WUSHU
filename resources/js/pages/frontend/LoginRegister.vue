<script setup>
import { ref, defineComponent } from 'vue';
import Header from '../../components/Header.vue';


const tab = ref('signup')

const activeTabClass = 'bg-blue-500 text-white'
const inactiveTabClass = 'bg-gray-200 text-gray-700'

// 子組件定義
const InputWithIcon = defineComponent({
  props: {
    icon: String,
    placeholder: String,
    type: String,
  },
  template: `
  <div class="relative">
    <input :type="type" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10" :placeholder="placeholder" />
    <i :class="'fas fa-' + icon + ' absolute left-3 top-3 text-gray-400'"></i>
    </div>
    `
  })
</script>


<template>
  <div class="bg-white min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4">
      <Header/>
      <div
        class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-300">
        <!-- Header -->

        <!-- Content -->
        <div class="p-8">
          <!-- Tabs -->
          <div class="flex justify-center mb-6">
            <button @click="tab = 'signup'" :class="tab === 'signup' ? activeTabClass : inactiveTabClass"
              class="px-4 py-2 rounded-l-md focus:outline-none transition-colors duration-300">
              Sign Up
            </button>
            <button @click="tab = 'login'" :class="tab === 'login' ? activeTabClass : inactiveTabClass"
              class="px-4 py-2 rounded-r-md focus:outline-none transition-colors duration-300">
              Login
            </button>
          </div>

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
