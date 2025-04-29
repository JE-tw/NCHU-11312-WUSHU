<!-- 引入到Cart.vue -->
<script setup>
import deleteIcon from '@/images/f-delete.png';

// 定義 props
const props = defineProps({
  id: Number,
  title: String,
  price: String,
});

// 控制彈窗顯示與隱藏的狀態
const showDeleteConfirmation = ref(false);

// 刪除邏輯（例如觸發父級方法或其他處理）
const deleteItem = () => {
  // 這裡可以放你實際的刪除邏輯，比如發送刪除請求，或觸發父組件的事件
  console.log(`刪除項目：${props.id}`);
  showDeleteConfirmation.value = false; // 隱藏彈窗
};

// 取消刪除
const cancelDelete = () => {
  showDeleteConfirmation.value = false; // 隱藏彈窗
};
</script>

<template>
  <div>
    <div class="py-4 sm:flex sm:justify-between sm:px-[20px] sm:py-[16px]">
      <div class="mb-2 flex text-[20px]/[27px] sm:mb-0 sm:text-[28px]/[37px] xl:text-[32px]/[43px]">
        <span class="mx-6 shrink-0 font-bold tracking-tight text-darkGray sm:mx-0 sm:mr-[60px]">{{ props.id }}</span>
        <span class="font-bold tracking-tight text-black">{{ props.title }}</span>
      </div>
      <div class="pr-24px flex shrink-0 items-center justify-between pl-[60px] sm:pl-4">
        <span v-if="props.price" class="text-[16px]/[21px] font-bold text-blueGreen sm:mr-[60px] sm:text-[24px]/[32px]"> NT${{ props.price }} </span>
        <button @click="showDeleteConfirmation = true" type="button" class="">
          <img :src="deleteIcon" alt="" class="h-[28px] sm:h-[35px]" />
        </button>
      </div>
    </div>
    <hr class="border-0.5 border-mediumGray" />
    <!-- 確認刪除彈窗 -->
    <div v-if="showDeleteConfirmation" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="w-[300px] rounded-lg bg-white p-6 text-center">
        <p class="mb-4">確定要刪除這個項目嗎？</p>
        <div class="flex justify-between">
          <button @click="cancelDelete" class="rounded-lg bg-gray-300 px-4 py-2">取消</button>
          <button @click="deleteItem" class="rounded-lg bg-red-500 px-4 py-2 text-white">確認刪除</button>
        </div>
      </div>
    </div>
  </div>
</template>
