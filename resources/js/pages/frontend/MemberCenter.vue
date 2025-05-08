<script setup>
import { ref, computed } from 'vue';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';
import MemberOrder from '../../components/MemberOrder.vue';

import CourseCard from '@/components/CourseCard.vue';
import UserForm from '@/components/UserForm.vue';

const tab = ref('personalinfo'); // 初始預設在個人資料

const activeTopTabClass = 'bg-white border border-white';
const inactiveTopTabClass = 'text-white border border-white';

// 課程購買紀錄假資料
const courses = ref([
  {
    title: '基礎班',
    description: '良好的風水可以使家庭收入增加，人才健康。在選擇居家風水，實在不可不慎。',
    category: '吠陀占星',
  },
  {
    title: '進階班',
    description: '掌握行星能量與相位的精細解析，深入理解星盤奧秘。',
    category: '吠陀占星',
  },
  {
    title: '塔羅入門',
    description: '學習塔羅基礎牌意與解牌技巧，適合初學者。',
    category: '塔羅牌',
  },
  {
    title: '能量療癒課',
    description: '探索氣場與脈輪，啟動身心靈療癒力。',
    category: '靈性課程',
  },
]);
const purchaseRecords = ref([
  {
    date: '2025-01-01T12:00:00Z',
    items: ['古典針灸基礎班', '古典針灸進階班'],
    amount: 360000,
    payment: 'bank_transfer',
    status: 'pending',
  },
  {
    date: '2025-03-15T08:00:00Z',
    items: ['塔羅入門', '風水基礎'],
    amount: 120000,
    payment: 'credit_card',
    status: 'paid',
  },
  {
    date: '2025-04-20T18:30:00Z',
    items: ['金融占星', '靈性療癒'],
    amount: 160000,
    payment: 'bank_transfer',
    status: 'paid',
  },
]);

// 分頁控制
// const currentPage = ref(1);
// const perPage = 2;

// const paginatedRecords = computed(() => {
//   const start = (currentPage.value - 1) * perPage;
//   return purchaseRecords.value.slice(start, start + perPage);
// });

const totalPages = computed(() => Math.ceil(purchaseRecords.value.length / perPage));

// 格式化工具
// function formatDate(dateStr) {
//   return new Date(dateStr).toLocaleDateString('zh-TW');
// }

// function formatAmount(num) {
//   return num.toLocaleString();
// }

// function formatPayment(method) {
//   return method === 'bank_transfer' ? '匯款' : '信用卡';
// }

// function formatStatus(status) {
//   return status === 'paid' ? '收到款項：課程已解鎖' : '待客服確認款項';
// }

// 
const props = defineProps({
  userInfo: Object,
  orders: Object, // 含 data, meta, links 等
});
// ====================
// 會員資料頁
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const userInfo = computed(() => page.props.userInfo);
const name = computed(() => userInfo.value?.name || '');
const phone = computed(() => userInfo.value?.user_info?.phone || '');
const birth_city = computed(() => userInfo.value?.user_info?.birth_city || '');
const address = computed(() => userInfo.value?.user_info?.address || '');
const birth_date = computed(() => userInfo.value?.user_info?.birth_date || '');
const birth_time = computed(() => userInfo.value?.user_info?.birth_time || '');

// :config="dateOptions"
import Flatpickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

// flatpickr 設定
const dateOptions = {
  dateFormat: 'Y-m-d',
  allowInput: true,
};
const timeOptions = {
  enableTime: true,
  noCalendar: true,
  dateFormat: 'H:i',
  time_24hr: true,
  allowInput: true,
};

// 購買紀錄頁
import { useTableController } from '@/composables/useTableController';

const { items, currentPage2, totalPages2, handlePageChange } = useTableController('orders', 'admin.order.list'); // 名稱依照 controller 傳的變數與 route 命名
const columns = [
  { label: '日期', key: 'created_at' },
  { label: '購買項目', key: 'order_items' },
  { label: '價格', key: 'total_amount' },
  { label: '付款方式', key: 'payment_method' },
  { label: '訂單狀態', key: 'status_text' },
];
</script>
<template>
  <!-- 頁首 Banner -->
  <header class="flex w-full flex-col items-center bg-black py-10 sm:py-16 xl:py-28">
    <p
      class="pt-[120px] font-serif text-[32px]/[46px] font-bold text-grayWhite sm:pt-[160px] sm:text-[52px]/[75px] xl:pt-[224px] xl:text-[64px]/[92px]"
    >
      會員中心
    </p>
    <span class="w-[120px] border-b-2 border-grayWhite sm:w-[300px]"></span>

    <!-- 上方 Tabs -->
    <div class="my-10 flex items-center gap-4">
      <button
        @click="tab = 'personalinfo'"
        :class="[
          tab === 'personalinfo' ? activeTopTabClass : inactiveTopTabClass,
          'tab-button whitespace-nowrap rounded-md px-12 py-3 text-2xl transition-colors duration-300 focus:outline-none',
        ]"
      >
        個人資料
      </button>

      <button
        @click="tab = 'mycourse'"
        :class="[
          tab === 'mycourse' ? activeTopTabClass : inactiveTopTabClass,
          'tab-button whitespace-nowrap rounded-md px-12 py-3 text-2xl transition-colors duration-300 focus:outline-none',
        ]"
      >
        我的課程
      </button>

      <button
        @click="tab = 'purchaserecord'"
        :class="[
          tab === 'purchaserecord' ? activeTopTabClass : inactiveTopTabClass,
          'tab-button whitespace-nowrap rounded-md px-12 py-3 text-2xl transition-colors duration-300 focus:outline-none',
        ]"
      >
        購買記錄
      </button>

      <button
        @click="tab = 'logout'"
        :class="[
          tab === 'logout' ? activeTopTabClass : inactiveTopTabClass,
          'tab-button whitespace-nowrap rounded-md px-12 py-3 text-2xl transition-colors duration-300 focus:outline-none',
        ]"
      >
        登出
      </button>
    </div>
  </header>

  <!-- 主要內容區 -->
  <div class="min-h-screen overflow-x-hidden bg-softGray py-20">
    <div class="mx-auto w-full max-w-[95%] px-4">
      <Header />

      <!-- 個人資料 -->
      <div v-if="tab === 'personalinfo'" class="flex flex-col items-center gap-4">
        <div class="w-full max-w-md overflow-hidden rounded-lg border border-gray-200 bg-white shadow-lg">
          <div class="p-8">
            <!-- 個人資料表單 -->
            <form class="space-y-6">
              <h2 class="mb-6 text-3xl font-bold">個人資料</h2>

              <!-- 姓名 -->
              <div class="relative">
                <input
                  v-model="name"
                  type="text"
                  id="name"
                  placeholder=" "
                  class="peer w-full rounded-md border border-gray-400 px-4 py-3 focus:outline-none"
                />
                <label
                  for="name"
                  class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:text-blue-600"
                >
                  姓名
                </label>
              </div>

              <!-- 手機 -->
              <div class="relative">
                <input
                  v-model="phone"
                  type="tel"
                  id="phone"
                  placeholder=" "
                  class="peer w-full rounded-md border border-gray-400 px-4 py-3 focus:outline-none"
                />
                <label
                  for="phone"
                  class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:text-blue-600"
                >
                  手機號碼
                </label>
              </div>

              <!-- 出生日期 / 時間 -->
              <div class="flex flex-col sm:flex-row sm:space-x-4">
                <div class="relative flex-1">
                  <Flatpickr
                    v-model="birth_date"
                    :config="dateOptions"
                    placeholder="出生日期"
                    class="peer w-full rounded-md border border-gray-400 px-4 py-3 focus:outline-none"
                  />
                  <!-- <input
                    v-model="birth_date"
                    type="date"
                    id="birth-date"
                    class="peer w-full rounded-md border border-gray-400 px-4 py-3 focus:outline-none"
                  /> -->
                  <label
                    for="birth-date"
                    class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 peer-placeholder-shown:text-gray-400 peer-focus:text-blue-600"
                  >
                    出生日期
                  </label>
                </div>

                <div class="relative mt-4 flex-1 sm:mt-0">
                  <!-- <input
                    v-model="birth_time"
                    type="time"
                    id="birth-time"
                    placeholder=" "
                    class="peer w-full rounded-md border border-gray-400 px-4 py-3 focus:outline-none"
                  /> -->
                  <Flatpickr
                    v-model="birth_time"
                    :config="timeOptions"
                    placeholder="出生時間"
                    class="peer w-full rounded-md border border-gray-400 px-4 py-3 focus:outline-none"
                  />
                  <label
                    for="birth-time"
                    class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:text-blue-600"
                  >
                    出生時間
                  </label>
                </div>
              </div>

              <!-- 出生城市 -->
              <div class="relative">
                <input
                  v-model="birth_city"
                  type="text"
                  id="birth-city"
                  placeholder=" "
                  class="peer w-full rounded-md border border-gray-400 px-4 py-3 focus:outline-none"
                />
                <label
                  for="birth-city"
                  class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:text-blue-600"
                >
                  出生城市
                </label>
              </div>

              <!-- 地址 -->
              <div class="relative">
                <input
                  v-model="address"
                  type="text"
                  id="address"
                  placeholder=" "
                  class="peer w-full rounded-md border border-gray-400 px-4 py-3 focus:outline-none"
                />
                <label
                  for="address"
                  class="absolute left-3 top-[-10px] bg-white px-1 text-sm text-gray-500 transition-all duration-200 peer-placeholder-shown:text-gray-400 peer-focus:text-sm peer-focus:text-blue-600"
                >
                  地址
                </label>
              </div>

              <!-- 儲存按鈕 -->
              <button
                class="mt-6 w-full transform rounded-md bg-[#518C95] py-3 text-xl text-white transition-opacity duration-300 hover:scale-105 hover:opacity-90"
              >
                儲存
              </button>
            </form>
          </div>
        </div>

        <!-- 修改密碼區塊開始 -->
        <div class="w-full max-w-md overflow-hidden rounded-lg border border-gray-200 bg-white shadow-lg">
          <div class="p-8">
            <h3 class="mb-6 text-2xl font-bold">修改密碼</h3>
            <p class="mb-4 text-gray-400">至少6個字元，不可有空白與特殊符號。需英數混合</p>

            <!-- 修改密碼表單 -->
            <form class="space-y-6">
              <!-- 新密碼 -->
              <div class="relative">
                <input
                  type="password"
                  id="new-password"
                  placeholder=" "
                  class="peer w-full rounded-md border border-gray-400 px-4 py-3 focus:outline-none"
                />
                <label
                  for="new-password"
                  class="absolute left-3 top-3 bg-white px-1 text-sm text-gray-400 transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs"
                >
                  輸入新密碼
                </label>
              </div>

              <!-- 確認新密碼 -->
              <div class="relative">
                <input
                  type="password"
                  id="confirm-new-password"
                  placeholder=" "
                  class="peer w-full rounded-md border border-gray-400 px-4 py-3 focus:outline-none"
                />
                <label
                  for="confirm-new-password"
                  class="absolute left-3 top-3 bg-white px-1 text-sm text-gray-400 transition-all peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-focus:top-[-8px] peer-focus:text-xs"
                >
                  再次輸入新密碼
                </label>
              </div>

              <!-- 修改密碼按鈕 -->
              <button
                class="mt-6 w-full transform rounded-md bg-[#518C95] py-3 text-xl text-white transition-opacity duration-300 hover:scale-105 hover:opacity-90"
              >
                確定修改
              </button>
            </form>
          </div>
        </div>
        <!-- 修改密碼區塊結束 -->
      </div>

      <!-- 我的課程區塊 -->
      <div v-else-if="tab === 'mycourse'" class="w-full px-4 py-8">
        <div class="course-grid">
          <div v-for="(course, index) in courses" :key="index" class="course-card">
            <h3 class="mb-2 break-words text-xl font-bold">
              {{ course.title }}
            </h3>
            <p class="mb-4 break-words text-base leading-relaxed text-gray-700">
              {{ course.description }}
            </p>
            <div class="flex items-center justify-between">
              <span class="rounded-full bg-purple-200 px-3 py-1 text-sm text-purple-800">
                {{ course.category }}
              </span>
              <button class="rounded bg-teal-600 px-4 py-2 text-sm text-white transition hover:bg-teal-700">前往課程</button>
            </div>
          </div>
        </div>
      </div>

      <!-- 購買記錄 -->
      <div v-else-if="tab === 'purchaserecord'" class="w-full px-4 py-8 text-gray-800">
        <!-- 組件 購買紀錄表格 -->
        <MemberOrder :columns="columns" :items="items" :current-page="currentPage2" :total-pages="totalPages2" @pageChange="handlePageChange">
          <!-- 購買項目插槽 -->
          <template #cell(order_items)="{ item }">
            <div v-for="i in item.order_items" :key="i.id" class="border-b border-gray-300 py-1 last:border-0">
              {{ i.product?.name || '未找到商品' }}
            </div>
          </template>

          <!-- 日期格式化 -->
          <template #cell(created_at)="{ item }">
            {{ item.created_at?.slice(0, 10) }}
          </template>

          <!-- 付款方式固定為匯款 -->
          <template #cell(payment_method)> 匯款 </template>
        </MemberOrder>
      </div>
      <!-- 登出 -->
      <div v-else-if="tab === 'logout'" class="flex items-center justify-center py-20">
        <button class="rounded-md bg-red-600 px-6 py-3 text-white transition hover:bg-red-700">確認登出</button>
      </div>
    </div>
  </div>
  <Footer />
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

body {
  font-family: 'Poppins', sans-serif;
}

input[type='date']::-webkit-datetime-edit {
  color: transparent;
}

input[type='date']:focus::-webkit-datetime-edit {
  color: black;
}

.course-grid {
  display: grid;
  gap: 1.5rem;
  grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
}

.course-card {
  border: 1px solid #e5e7eb;
  /* gray-200 */
  border-radius: 1rem;
  padding: 1.25rem;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
  background-color: white;
}

/* 當畫面寬度 >= 600px，顯示 2 欄 */
@media (min-width: 600px) {
  .course-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

/* 當畫面寬度 >= 1270px，顯示 3 欄 */
@media (min-width: 1270px) {
  .course-grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* 自定義斷點：畫面寬度 < 1000px 時縮小按鈕 */
@media (max-width: 1000px) {
  .tab-button {
    padding: 0.75rem 2rem; /* 等於 py-3 px-8 */
    font-size: 1.25rem; /* text-xl */
  }
}

@media (max-width: 700px) {
  .tab-button {
    padding: 0.5rem 1.25rem; /* py-2 px-5 */
    font-size: 1rem; /* text-base */
  }
}

@media (max-width: 500px) {
  .tab-button {
    padding: 0.25rem 0.75rem; /* py-1 px-3 */
    font-size: 0.875rem; /* text-sm */
  }
}
</style>
