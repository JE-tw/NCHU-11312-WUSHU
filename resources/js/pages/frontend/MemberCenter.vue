<script setup>
import { ref } from 'vue';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';

const tab = ref('signup')

const activeTopTabClass = 'bg-white border border-white';

const inactiveTopTabClass = 'text-white border border-white';

</script>

<template>

  <header class="flex h-[234px] w-full flex-col items-center bg-black sm:h-[303px] xl:h-[540px]">
    <p
      class="pt-[120px] font-serif text-[32px]/[46px] font-bold text-grayWhite sm:pt-[160px] sm:text-[52px]/[75px] xl:pt-[224px] xl:text-[64px]/[92px]">
      會員中心
    </p>

    <span class="w-[120px] border-b-2 border-grayWhite sm:w-[300px]"></span>

    <div class="flex items-center gap-4 my-10">

      <button @click="tab = 'personalinfo'"
        :class="[tab === 'personalinfo' ? activeTopTabClass : inactiveTopTabClass, 'text-2xl px-10 py-3 rounded-md focus:outline-none transition-colors duration-300 whitespace-nowrap']">
        個人資料
      </button>

      <button @click="tab = 'mycourse'"
        :class="[tab === 'mycourse' ? activeTopTabClass : inactiveTopTabClass, 'text-2xl px-10 py-3 rounded-md focus:outline-none transition-colors duration-300 whitespace-nowrap']">
        我的課程
      </button>

      <button @click="tab = 'purchaserecord'"
        :class="[tab === 'purchaserecord' ? activeTopTabClass : inactiveTopTabClass, 'text-2xl px-10 py-3 rounded-md focus:outline-none transition-colors duration-300 whitespace-nowrap']">
        購買記錄
      </button>

      <button @click="tab = 'logout'"
        :class="[tab === 'logout' ? activeTopTabClass : inactiveTopTabClass, 'text-2xl px-10 py-3 rounded-md focus:outline-none transition-colors duration-300 whitespace-nowrap']">
        登出
      </button>

    </div>
  </header>

  <div class="bg-white min-h-screen flex justify-center my-20">
    <div class="container mx-auto px-4">
      <Header />

      <!-- Flex 容器：含個人資料卡片＋修改密碼卡片 -->
      <div class="flex flex-col items-center gap-4">
        <div class="w-full max-w-md mx-auto bg-white rounded-lg overflow-hidden border border-gray-00 shadow-lg">
          <!-- Content -->
          <div class="p-8">
            <!-- Signup Form -->
            <form v-if="tab === 'personalinfo'" class="space-y-6">
              <h2 class="text-3xl font-bold mb-6">個人資料</h2>

              <!-- 姓名 -->
              <div class="relative">
                <input type="text" id="name" placeholder=" "
                  class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none  " />
                <label for="name"
                  class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs  bg-white px-1">
                  姓名
                </label>
              </div>

              <!-- 手機號碼 -->
              <div class="relative">
                <input type="tel" id="phone" placeholder=" "
                  class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none  " />
                <label for="phone"
                  class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs  bg-white px-1">
                  手機號碼
                </label>
              </div>

              <!-- 出生日期和出生時間 -->
              <div class="flex flex-col sm:flex-row sm:space-x-4">
                <!-- 出生日期 -->
                <div class="relative flex-1">
                  <input type="date" id="birth-date" placeholder=" "
                    class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none  " />
                  <label for="birth-date"
                    class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs  bg-white px-1">
                    出生日期
                  </label>
                </div>

                <!-- 出生時間 -->
                <div class="relative flex-1 mt-4 sm:mt-0">
                  <input type="time" id="birth-time" placeholder=" "
                    class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none  " />
                  <label for="birth-time"
                    class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs  bg-white px-1">
                    出生時間
                  </label>
                </div>
              </div>


              <!-- 出生城市 -->
              <div class="relative">
                <input type="text" id="birth-city" placeholder=" "
                  class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none  " />
                <label for="birth-city"
                  class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs  bg-white px-1">
                  出生城市
                </label>
              </div>

              <!-- 地址 -->
              <div class="relative">
                <input type="text" id="address" placeholder=" "
                  class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none  " />
                <label for="address"
                  class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs  bg-white px-1">
                  地址
                </label>
              </div>

              
              <!-- 儲存按鈕 -->
              <button
              class="w-full bg-[#518C95] text-white text-xl py-3 rounded-md hover:opacity-90 transition-opacity duration-300 transform hover:scale-105 mt-6">
              儲存
            </button>
          </form>
        </div>
      </div>
      
      <!-- 修改密碼卡片 -->
      <div class="w-full max-w-md mx-auto bg-white rounded-lg overflow-hidden border border-gray-00 shadow-lg">
        <div class="p-8">
          <form class="space-y-2">
            <!-- Email -->
            <h2 class="text-3xl font-bold mt-0 mb-6">修改密碼</h2>
            <p class="text-gray-600 mb-4">至少6個字元，不可有空白與特殊符號，需英數混合</p>
      
              <div class="flex flex-col">
                <div class="relative">
                  <input type="text" placeholder="輸入新密碼"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none   pl-10" />
                  <i class="fas fa-user absolute left-3 top-3 text-gray-400"></i>
                </div>
              </div>

              <div class="flex flex-col">
                <div class="relative">
                  <input type="password" placeholder="再次輸入新密碼"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none   pl-10" />
                  <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                </div>
              </div>

              <!-- 登入按鈕 -->
              <button
                class="w-full bg-[#518C95] text-white text-lg py-3 rounded-md hover:opacity-90 transition-opacity duration-300 transform hover:scale-105">
                確定修改
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Footer />
</template>



<!-- FontAwesome & Tailwind -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

body {
  font-family: 'Poppins', sans-serif;
}

input[type="date"]::-webkit-datetime-edit {
  color: transparent;
}

input[type="date"]:focus::-webkit-datetime-edit {
  color: black;
  /* 聚焦時再顯示正常文字 */
}
</style>
