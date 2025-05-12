<script setup>
import { ref, computed } from 'vue';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';
import MemberOrder from '../../components/MemberOrder.vue';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

import CourseCard from '@/components/CourseCard.vue';
import UserForm from '@/components/UserForm.vue';

const tab = ref('personalinfo'); // 初始預設在個人資料

const activeTopTabClass = 'bg-white border border-white';
const inactiveTopTabClass = 'text-white border border-white hover:bg-stone-300 hover:text-black';

// 分頁控制
// const currentPage = ref(1);
// const perPage = 2;

// const paginatedRecords = computed(() => {
//   const start = (currentPage.value - 1) * perPage;
//   return purchaseRecords.value.slice(start, start + perPage);
// });

const totalPages = computed(() => Math.ceil(purchaseRecords.value.length / perPage));

const props = defineProps({
  userInfo: Object,
  orders: Object, // 含 data, meta, links 等
  courses: Array,
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

// 我的課程
// 點擊跳轉 詳細資訊頁
function goToIntro(id) {
  router.visit(route('wushu.intro', id));
}

// 登出彈窗 sweet alert
const logOut = () => {
  Swal.fire({
    title: '確定要登出嗎?',
    text: '練功不打卡，會退步喔！下次記得再回來！',
    icon: 'warning',
    showCancelButton: true,
    reverseButtons: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#B5B5B5',
    confirmButtonText: '我要登出!',
    cancelButtonText: '取消',
  }).then((result) => {
    if (result.isConfirmed) {
      router.post('/logout');
      // Swal.fire({
      //   position: 'top-end',
      //   // icon: 'success',
      //   title: '登出成功',
      //   showConfirmButton: false,
      //   timer: 1500,
      // });
    }
  });
};
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
      <div class="mx-2 h-10 w-px bg-gray-300"></div>
      <button
        @click="logOut"
        type="button"
        class="tab-button whitespace-nowrap rounded-md border border-white px-12 py-3 text-2xl text-white transition-colors duration-300 hover:bg-red-600"
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
        <div class="w-full max-w-md overflow-hidden  border border-gray-200 bg-white shadow-custom">
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
                type="button"
                class="mt-6 w-full transform rounded-md bg-[#518C95] py-3 text-xl text-white transition-opacity duration-300 hover:scale-105 hover:opacity-90"
              >
                儲存
              </button>
            </form>
          </div>
        </div>

        <!-- 修改密碼區塊開始 -->
        <div class="w-full max-w-md overflow-hidden  border border-gray-200 bg-white shadow-custom">
          <div class="p-8">
            <h3 class="mb-6 text-2xl font-bold">修改密碼</h3>
            <p class="mb-4 text-gray-400">至少6個字元，不可有空白與特殊符號。需英數混合</p>

            <!-- 修改密碼表單 -->
            <form class="space-y-6">
              <!-- 新密碼 -->
              <!-- 真正的input type應為password -->
              <div class="relative">
                <input
                  type="text"
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
                <!-- 真正的input type應為password -->
                <input
                  type="text"
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
                type="button"
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
        <div
          v-if="props.courses.length === 0"
          class="bg-white px-2 py-16 text-center text-[14px] text-gray-600 shadow-custom sm:px-32 sm:text-[20px] xl:text-[24px]"
        >
          若您已購買課程，我們將儘速為您開通權限！ 
        </div>
        <div v-else>
          <div class="course-grid">
            <div v-for="course in props.courses" :key="course.id" class="course-card shadow-custom">
              <h3 class="mb-2 break-words text-xl font-bold">
                {{ course.name }}
              </h3>
              <p class="mb-4 break-words text-base leading-relaxed text-gray-700">
                {{ course.introduction }}
              </p>
              <div class="flex items-center justify-between">
                <span class="rounded-full bg-purple-200 px-3 py-1 text-sm text-purple-800">
                  {{ course.category_name }}
                </span>
                <button @click="goToIntro(course.id)" class="rounded bg-teal-600 px-4 py-2 text-sm text-white transition hover:bg-teal-500 hover:scale-125 duration-300">
                  前往課程
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 購買記錄 -->
      <div v-else-if="tab === 'purchaserecord'" class="w-full px-4 py-8 text-gray-800">
        <!-- 組件 購買紀錄表格 -->
        <MemberOrder class="shadow-custom" :columns="columns" :items="items" :current-page="currentPage2" :total-pages="totalPages2" @pageChange="handlePageChange">
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
        <!-- 登出 -->
        <Link href="/logout" method="post" as="button" class="rounded-md bg-red-600 px-6 py-3 text-white transition hover:bg-red-700">
          確認登出
        </Link>
        <!-- <button class="rounded-md bg-red-600 px-6 py-3 text-white transition hover:bg-red-700">確認登出</button> -->
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
  padding: 1.25rem;
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
