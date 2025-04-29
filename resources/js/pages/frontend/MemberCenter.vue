<script setup>
import { ref } from 'vue';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';

const tab = ref('personalinfo') // 初始預設在個人資料

const activeTopTabClass = 'bg-white border border-white';
const inactiveTopTabClass = 'text-white border border-white';

const courses = [
  {
    title: '基礎班',
    description: '良好的風水可以使家庭收入增加，人才健康。在選擇居家風水，實在不可不慎。',
    tag: '吠陀占星'
  },
  {
    title: '進階班',
    description: '深入了解風水佈局，掌握財富與健康的密碼。',
    tag: '陽宅風水'
  },
  {
    title: '專業班',
    description: '專業實務演練，成為風水佈局的專家。',
    tag: '專業認證'
  },
];

</script>

<template>

  <!-- 頁首 Banner -->
  <header class="flex h-[234px] w-full flex-col items-center bg-black sm:h-[303px] xl:h-[540px]">
    <p
      class="pt-[120px] font-serif text-[32px]/[46px] font-bold text-grayWhite sm:pt-[160px] sm:text-[52px]/[75px] xl:pt-[224px] xl:text-[64px]/[92px]">
      會員中心
    </p>

    <span class="w-[120px] border-b-2 border-grayWhite sm:w-[300px]"></span>

    <!-- 上方 Tabs -->
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

  <!-- 主要內容區 -->
  <div class="bg-white min-h-screen my-20">
    <div class="container mx-auto ">
      <Header />

      <!-- 個人資料 -->
      <div v-if="tab === 'personalinfo'" class="flex flex-col items-center gap-4">
        <div class="w-full max-w-md bg-white rounded-lg overflow-hidden border border-gray-200 shadow-lg">
          <div class="p-8">
            <!-- 個人資料表單 -->
            <form class="space-y-6">
              <h2 class="text-3xl font-bold mb-6">個人資料</h2>

              <!-- 姓名 -->
              <div class="relative">
                <input type="text" id="name" placeholder=" "
                  class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none" />
                <label for="name"
                  class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs bg-white px-1">
                  姓名
                </label>
              </div>

              <!-- 手機 -->
              <div class="relative">
                <input type="tel" id="phone" placeholder=" "
                  class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none" />
                <label for="phone"
                  class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs bg-white px-1">
                  手機號碼
                </label>
              </div>

              <!-- 出生日期 / 時間 -->
              <div class="flex flex-col sm:flex-row sm:space-x-4">
                <div class="relative flex-1">
                  <input type="date" id="birth-date" placeholder=" "
                    class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none" />
                  <label for="birth-date"
                    class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs bg-white px-1">
                    出生日期
                  </label>
                </div>

                <div class="relative flex-1 mt-4 sm:mt-0">
                  <input type="time" id="birth-time" placeholder=" "
                    class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none" />
                  <label for="birth-time"
                    class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs bg-white px-1">
                    出生時間
                  </label>
                </div>
              </div>

              <!-- 出生城市 -->
              <div class="relative">
                <input type="text" id="birth-city" placeholder=" "
                  class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none" />
                <label for="birth-city"
                  class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs bg-white px-1">
                  出生城市
                </label>
              </div>

              <!-- 地址 -->
              <div class="relative">
                <input type="text" id="address" placeholder=" "
                  class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none" />
                <label for="address"
                  class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs bg-white px-1">
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

        <!-- 修改密碼區塊開始 -->
        <div class="w-full max-w-md bg-white rounded-lg overflow-hidden border border-gray-200 shadow-lg">
          <div class="p-8">
            <h3 class="text-2xl font-bold mb-6">修改密碼</h3>
            <p class="text-gray-400 mb-4">至少6個字元，不可有空白與特殊符號。需英數混合</p>


            <!-- 修改密碼表單 -->
            <form class="space-y-6">
              <!-- 新密碼 -->
              <div class="relative">
                <input type="password" id="new-password" placeholder=" "
                  class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none" />
                <label for="new-password"
                  class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs bg-white px-1">
                  輸入新密碼
                </label>
              </div>

              <!-- 確認新密碼 -->
              <div class="relative">
                <input type="password" id="confirm-new-password" placeholder=" "
                  class="peer w-full px-4 py-3 border border-gray-400 rounded-md focus:outline-none" />
                <label for="confirm-new-password"
                  class="absolute left-3 top-3 text-gray-400 text-sm transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs bg-white px-1">
                  再次輸入新密碼
                </label>
              </div>

              <!-- 修改密碼按鈕 -->
              <button
                class="w-full bg-[#518C95] text-white text-xl py-3 rounded-md hover:opacity-90 transition-opacity duration-300 transform hover:scale-105 mt-6">
                確定修改
              </button>
            </form>
          </div>
        </div>
        <!-- 修改密碼區塊結束 -->
      </div>

      <!-- 我的課程卡 -->
      <div v-else-if="tab === 'mycourse'" class="w-full px-4 ">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
          <div v-for="(course, index) in courses" :key="index"
            class="border border-gray-200 rounded-lg p-6 shadow-sm bg-white">
            <h3 class="text-lg sm:text-xl md:text-2xl font-bold mb-2">{{ course.title }}</h3>
            <p class="text-sm sm:text-base text-gray-700 leading-relaxed mb-4 whitespace-pre-line">
              {{ course.description }}
            </p>
            <div class="flex justify-between items-center">
              <span class="px-3 py-1 text-sm rounded-full bg-purple-200 text-purple-800">{{ course.tag }}</span>
              <button class="bg-teal-600 text-white px-4 py-2 text-sm rounded hover:bg-teal-700 transition">
                前往課程
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- 購買記錄 -->
      <div v-else-if="tab === 'purchaserecord'" class="w-full px-4 py-8 text-center text-gray-600">
        <p class="text-lg">（購買記錄功能待開發）</p>
      </div>

      <!-- 登出 -->
      <div v-else-if="tab === 'logout'" class="flex justify-center items-center py-20">
        <button class="bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 transition">
          確認登出
        </button>
      </div>

    </div>
  </div>

  <Footer />
</template>

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
}
</style>
