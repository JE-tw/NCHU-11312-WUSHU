<!-- 購物車 引入 ProductCard 作為購買商品列表 -->
<script setup>
import { ref, onMounted } from 'vue';
import ProductCard from '@/components/ProductCard.vue';
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';
import Swal from 'sweetalert2';

import deleteIcon from '@/images/f-delete.png';

import { useCartStore } from '@/stores/cart';
const cartStore = useCartStore();

// 購物車步驟
const step = ref(1);

const nextStep = () => {
  step.value++;
};

const prevStep = () => {
  step.value--;
};

// 繼續觀看課程
const goList = () => {
  router.get('/wushu/ServiceCourse');
};

// 拿出localStorage儲存的商品
const cartItems = ref([]); // 儲存從 localStorage 拿到的商品
const serviceItems = computed(() => cartItems.value.filter((item) => item.product_type === 1));
const courseItems = computed(() => cartItems.value.filter((item) => item.product_type === 2));

onMounted(() => {
  const storedCart = localStorage.getItem('cart'); // 從 localStorage 讀取資料
  if (storedCart) {
    cartItems.value = JSON.parse(storedCart);
  }
});

// 計算總金額
const totalAmount = computed(() => {
  // 服務的總金額
  const serviceTotal = serviceItems.value.reduce((total, item) => total + item.price, 0);

  // 課程的總金額
  const courseTotal = courseItems.value.reduce((total, item) => total + item.price, 0);

  return serviceTotal + courseTotal; // 返回總金額
});

// 刪除功能
// 控制彈窗顯示與隱藏的狀態
const showDeleteConfirmation = ref(false);

// 刪除方法
function removeItem(id, type) {
  // 刪除
  cartItems.value = cartItems.value.filter((item) => item.product_type !== type || item.id !== id);
  // 寫入 localStorage
  localStorage.setItem('cart', JSON.stringify(cartItems.value));
  showDeleteConfirmation.value = false; // 隱藏彈窗
}

// 新增變數儲存要刪除的項目
const deleteTarget = ref({ id: null, type: null });

// 先抓到儲存要刪除項目的變數
const confirmDelete = (id, type) => {
  deleteTarget.value = { id, type };
  showDeleteConfirmation.value = true; // 顯示彈窗
};

// 確定刪除
const deleteItem = () => {
  removeItem(deleteTarget.value.id, deleteTarget.value.type);
};

// 取消刪除
const cancelDelete = () => {
  showDeleteConfirmation.value = false; // 隱藏彈窗
};

// 獲取會員資料
const page = usePage();
const userInfo = computed(() => page.props.userInfo);
const email = computed(() => userInfo.value?.email || '');
const name = computed(() => userInfo.value?.name || '');
const phone = computed(() => userInfo.value?.user_info?.phone || '');

// 匯款資料
const order = ref({
  remittance_date: '',
  remittance_amount: '',
  remittance_account_last5: '',
});

// 購物車送出
const handleSubmit = () => {
  // 檢查必填欄位是否為空
  if (!order.value.remittance_date || !order.value.remittance_amount || !order.value.remittance_account_last5) {
    Swal.fire({
      title: '請填寫所有欄位',
      text: '匯款日期、匯款金額和帳號末五碼是必填欄位，請檢查並補充資料。',
      icon: 'error',
      customClass: {
        confirmButton: 'my-confirm-btn2',
      },
    });
    return; // 退出函式，不繼續執行後續程式
  }
  // 檢查匯款金額是否小於等於 0
  if (Number(order.value.remittance_amount) <= 0) {
    Swal.fire({
      title: '金額錯誤',
      text: '匯款金額不可為 0 或負數，請重新輸入正確金額。',
      icon: 'error',
      customClass: {
        confirmButton: 'my-confirm-btn2',
      },
    });
    return;
  }
  // 檢查帳號末五碼是否為五個數字
  const last5 = order.value.remittance_account_last5;
  if (!/^\d{5}$/.test(last5)) {
    Swal.fire({
      title: '帳號格式錯誤',
      text: '請輸入正確的帳號末五碼（5 位數字）。',
      icon: 'error',
      customClass: {
        confirmButton: 'my-confirm-btn2',
      },
    });
    return;
  }
  Swal.fire({
    title: '是否確認送出?',
    showCancelButton: true,
    cancelButtonText: '取消',
    confirmButtonText: '確定',
    reverseButtons: false,
    customClass: {
      confirmButton: 'my-confirm-btn',
      cancelButton: 'my-cancel-btn',
    },
  }).then((result) => {
    if (result.isConfirmed) {
      const payload = {
        user: {
          name: name.value,
          phone: phone.value,
          email: email.value,
        },
        remittance: {
          remittance_date: order.value.remittance_date,
          remittance_amount: order.value.remittance_amount,
          remittance_account_last5: order.value.remittance_account_last5,
        },
        items: cartItems.value.map((item) => ({
          product_id: item.id,
          product_type: item.product_type === 1 ? 'App\\Models\\Service' : 'App\\Models\\Course',
          price_at_order_time: item.price,
        })),
      };

      router.post('/orders', payload, {
        onSuccess: () => {
          Swal.fire({
            title: '送出訂單成功!',
            text: '我們將盡速審核您的訂單，請耐心等候。',
            icon: 'success',
            customClass: {
              confirmButton: 'my-confirm-btn2',
            },
          });

          localStorage.removeItem('cart');
          cartItems.value = [];
          order.value = {
            remittance_date: '',
            remittance_amount: '',
            remittance_account_last5: '',
            totalAmount: 0,
          };

          router.get('/wushu/MemberCenter');
        },
        onError: (errors) => {
          Swal.fire({
            title: '送出訂單失敗',
            text: '請確認資料或稍後再試。',
            customClass: {
              confirmButton: 'my-confirm-btn2',
            },
          });
        },
      });
    }
  });
};
</script>

<template>
  <Header />

  <div class="bg-softGray pb-[120px] text-black">
    <!-- step1 購物車 -->
    <div v-if="step === 1" class="flex flex-col items-center">
      <header class="flex h-[234px] flex-col items-center sm:h-[400px] xl:h-[444px]">
        <p
          class="pt-[116px] font-serif text-[32px]/[46px] font-semibold text-black sm:pt-[160px] sm:text-[52px]/[75px] xl:pt-[224px] xl:text-[64px]/[92px]"
        >
          購物車
        </p>
        <span class="w-[100px] border-b-2 border-black sm:w-[150px]"></span>
      </header>

      <!-- 會員資料卡 -->
      <section class="w-[343px] sm:mx-auto sm:mb-[60px] sm:w-full sm:max-w-[720px] sm:px-[24px] xl:max-w-[1020px] xl:px-0">
        <div class="mb-10 px-[32px] py-[24px] text-[20px]/[26.6px] shadow-custom">
          <p class="pb-[12px]/[16px] pb-2 text-[20px] font-bold sm:text-[32px]/[42px]">會員資料</p>
          <hr class="" />
          <div class="text-[12px] sm:text-[18px]/[24px]">
            <p class="mt-[12px]">{{ name }}</p>
            <p class="my-[8px]">{{ phone }}</p>
            <p>{{ email }}</p>
          </div>
        </div>
      </section>
      <!-- 購物車商品列表 -->
      <div class="flex w-full flex-col items-center px-[32px] pb-[76px] sm:mx-[216px] sm:px-[48px]">
        <!-- 服務 -->
        <div class="mb-8 w-full max-w-[311px] sm:max-w-[672px] xl:w-full xl:max-w-[1020px]">
          <p class="mb-[24px] text-[20px]/[27px] font-bold text-blueGreen sm:text-[28px]/[37px] xl:text-[32px]/[43px]">服務</p>
          <!-- 列表title -->
          <div class="hidden sm:block">
            <div class="flex justify-between px-[5px] text-[24px]/[32px] font-bold text-darkGray">
              <div class="flex">
                <span class="mr-[44px]">項次</span>
                <span class="mr-[128px] xl:mr-[188px]">品項</span>
              </div>
              <div class="mr-[128px] xl:mr-[188px]">金額</div>
            </div>
          </div>
          <!-- 列表 -->
          <hr class="border-0.5 border-mediumGray" />
          <div>
            <!-- 服務 -->
            <div v-for="(item, index) in serviceItems" :key="index">
              <ProductCard :id="index + 1" :title="item.name" :price="item.price.toLocaleString()">
                <button @click="confirmDelete(item.id, item.product_type)" type="button" class="">
                  <img :src="deleteIcon" alt="" class="h-[28px] sm:h-[35px]" />
                </button>
                <!-- @click="removeItem(item.id, 1)" -->
              </ProductCard>
            </div>
          </div>
        </div>

        <!-- 課程 -->
        <div class="w-full max-w-[311px] sm:max-w-[672px] xl:w-full xl:max-w-[1020px]">
          <p class="mb-[24px] text-[20px]/[27px] font-bold text-blueGreen sm:text-[28px]/[37px] xl:text-[32px]/[43px]">課程</p>
          <!-- 列表title -->
          <div class="hidden sm:block">
            <div class="flex justify-between px-[5px] text-[24px]/[32px] font-bold text-darkGray">
              <div class="flex">
                <span class="mr-[44px]">項次</span>
                <span class="mr-[128px] xl:mr-[188px]">品項</span>
              </div>
              <div class="mr-[128px] xl:mr-[188px]">金額</div>
            </div>
          </div>
          <!-- 列表 -->
          <hr class="border-0.5 border-mediumGray" />
          <div>
            <!-- 引入ProductCard 並用測試假資料 -->
            <!-- <div v-for="item in fakeCourses" :key="item.id">
              <ProductCard :id="item.id" :title="item.title" :price="item.price" />
            </div> -->
            <!-- 課程 -->
            <div v-for="(item, index) in courseItems" :key="index">
              <ProductCard :id="index + 1" :title="item.name" :price="item.price.toLocaleString()">
                <button @click="confirmDelete(item.id, item.product_type)" type="button" class="">
                  <img :src="deleteIcon" alt="" class="h-[28px] sm:h-[35px]" />
                </button>
              </ProductCard>
            </div>
          </div>
        </div>
        <!-- 總計 -->
        <div
          class="flex w-full max-w-[311px] flex-wrap justify-between px-[10px] py-[16px] text-[16px]/[21px] font-bold sm:max-w-[672px] sm:text-[24px]/[32px] xl:max-w-[1020px] xl:pl-[5px] xl:pr-[110px]"
        >
          <div class="text-darkGray">共計 {{ serviceItems.length + courseItems.length }} 項</div>
          <div>
            <span class="text-darkGray">合計</span>
            <span class="ml-[34px] text-blueGreen"> NT$ {{ totalAmount.toLocaleString() }}</span>
          </div>
        </div>
      </div>
      <!-- 按鈕區 -->
      <div class="sm:w-[100%] sm:max-w-[672px] sm:px-3 xl:max-w-[760px] xl:px-0">
        <div class="flex flex-wrap justify-center gap-4 sm:justify-between">
          <button
            @click="goList"
            class="h-[44px] w-[147.5px] rounded-sm border border-blueGreen text-[16px]/[28px] text-blueGreen hover:bg-blueGreen hover:text-white sm:mr-0 sm:h-[56px] sm:w-[276px] sm:text-[24px]/[40px] xl:w-[320px]"
          >
            繼續看課程
          </button>
          <button
            v-if="cartItems.length > 0"
            class="h-[44px] w-[147.5px] rounded-sm border border-blueGreen text-[16px]/[28px] text-blueGreen hover:bg-blueGreen hover:text-white sm:h-[56px] sm:w-[276px] sm:text-[24px]/[40px] xl:w-[320px]"
            @click="nextStep"
          >
            匯款去
          </button>
        </div>
      </div>
    </div>
    <!-- 確認刪除彈窗 -->
    <div v-if="showDeleteConfirmation" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="w-[300px] rounded-lg bg-white p-6 text-center">
        <p class="mb-4">確定要刪除這個項目嗎？</p>
        <div class="flex justify-around">
          <button @click="deleteItem" class="rounded-lg bg-red-500 px-4 py-2 text-white hover:bg-red-600">確認刪除</button>
          <button @click="cancelDelete" class="rounded-lg border border-blueGreen px-4 py-2 text-blueGreen hover:bg-gray-100">取消</button>
        </div>
      </div>
    </div>

    <!-- step2 付款說明畫面 -->
    <div v-else-if="step === 2" class="flex flex-col items-center">
      <header class="flex h-[234px] w-full flex-col items-center sm:h-[400px] xl:h-[444px]">
        <p
          class="pt-[116px] font-serif text-[32px]/[46px] font-semibold text-black sm:pt-[160px] sm:text-[52px]/[75px] xl:pt-[224px] xl:text-[64px]/[92px]"
        >
          付款說明
        </p>
        <span class="w-[100px] border-b-2 border-black sm:w-[150px]"></span>
      </header>
      <div class="max-w-[311px] px-4 sm:max-w-none sm:px-0">
        <!-- 付款說明 -->
        <div class="mb-[60px] text-[20px]/[27px] sm:px-[48px] sm:pt-[127px] xl:w-[1256px] xl:px-0 xl:pt-0">
          <p class="mb-[24px] font-bold text-blueGreen sm:text-[32px]/[42px]">付款說明</p>
          <p class="mb-[30px] sm:text-[24px]/[32px] sm:font-bold">我們唯一的付款方式為「轉帳」，恕不提供信用卡的選項。</p>
          <div class="font-bold sm:text-[28px]/[38px] sm:font-normal xl:bg-white xl:px-[84px] xl:py-[24px] xl:text-[24px]/[40px] xl:shadow-custom">
            您須匯款的金額為<span class="text-blueGreen xl:text-[32px]/[42px]">NT$ {{ totalAmount.toLocaleString() }} </span>
            <br />
            請匯款至台新銀行812（內湖分行0481）
            <br />
            戶名：陳奎宇
            <br />
            帳號：20481000179199
            <br />
            匯款後，請填寫下列表格，告知我們您的匯款帳號後五碼，客服將即刻為您處理。
          </div>
        </div>
        <!-- 填入轉帳資料表單 -->
        <div class="sm:mb-[60px] sm:px-[48px] xl:px-0">
          <p class="mb-[24px] text-[20px]/[27px] font-bold text-blueGreen sm:text-[32px]/[42px]">輸入轉帳資料</p>
          <!-- 匯款日期 -->
          <div class="relative">
            <label
              for="date"
              :class="[
                'absolute left-0 top-[50%] ml-[16px] -translate-y-[80%] bg-white pr-5 text-[18px] text-darkGray',
                order.remittance_date ? 'hidden' : 'block',
              ]"
              >匯款日期</label
            >
            <input
              type="date"
              id="date"
              name="paid_date"
              v-model="order.remittance_date"
              class="mb-4 h-[48px] w-[100%] rounded-sm border border-mediumGray bg-white p-4 text-[18px]/[24px] font-normal text-black outline-none sm:w-[300px]"
              required
            />
          </div>
          <!-- 匯款金額 -->
          <div class="relative">
            <input
              id="price"
              type="number"
              name="paid_price"
              v-model="order.remittance_amount"
              class="mb-4 h-[48px] w-[100%] rounded-sm border border-mediumGray bg-white p-4 text-[18px]/[24px] font-normal text-black outline-none sm:w-[300px]"
              required
            />
            <label
              for="price"
              :class="[
                'absolute left-0 text-darkGray',
                order.remittance_amount
                  ? 'ml-4 -translate-y-2 bg-white p-0 text-[12px]/[16px] font-light'
                  : 'py-[11.5px] pl-[18px] text-[18px] font-normal',
              ]"
              >匯款金額</label
            >
          </div>
          <!-- 匯款帳號後五碼  -->
          <div class="relative">
            <input
              id="accountNumber"
              type="text"
              name="paid_account"
              v-model="order.remittance_account_last5"
              minlength="5"
              maxlength="5"
              class="mb-4 h-[48px] w-[100%] rounded-sm border border-mediumGray bg-white p-4 text-[18px]/[24px] font-normal text-black outline-none sm:w-[300px]"
              required
            />
            <label
              for="accountNumber"
              :class="[
                'absolute left-0 text-darkGray',
                order.remittance_account_last5
                  ? 'ml-4 -translate-y-2 bg-white p-0 text-[12px]/[16px] font-light'
                  : 'py-[11.5px] pl-[18px] text-[18px] font-normal',
              ]"
              >匯款帳號後五碼</label
            >
          </div>
        </div>
      </div>

      <!-- 按鈕區 -->
      <div class="sm:w-[100%] sm:px-[48px] xl:max-w-[760px] xl:px-0">
        <div class="box-border flex flex-wrap flex-nowrap justify-center gap-4 xl:justify-between">
          <button
            @click="prevStep"
            class="h-[44px] w-[147.5px] rounded-sm border border-blueGreen text-[16px]/[28px] text-blueGreen hover:bg-blueGreen hover:text-white sm:mr-[120px] sm:h-[56px] sm:w-[320px] sm:text-[24px]/[40px]"
          >
            返回購物車
          </button>
          <button
            @click="handleSubmit"
            class="h-[44px] w-[147.5px] rounded-sm border border-blueGreen text-[16px]/[28px] text-blueGreen hover:bg-blueGreen hover:text-white sm:h-[56px] sm:w-[320px] sm:text-[24px]/[40px]"
          >
            送出匯款資料
          </button>
        </div>
      </div>
    </div>
  </div>
  <Footer />
</template>

<style>
.my-confirm-btn {
  background-color: #1f9c95;
  color: white;
  border: 1px solid #1f9c95;
}

.my-cancel-btn {
  background-color: white;
  color: #1f9c95;
  border: 1px solid #1f9c95;
}
.my-confirm-btn2 {
  background-color: #1f9c95;
  color: white;
  border: 1px solid #1f9c95;
}
</style>
