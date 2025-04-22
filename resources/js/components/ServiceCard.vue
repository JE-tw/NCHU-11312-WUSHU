<script setup>
import { ref } from "vue";
import plusIcon from "@/images/f-plus.png";
import dashIcon from "@/images/f-dash.png";

import CartButton from "./CartButton.vue";

defineProps({
  item: {
    type: Object,
    required: true,
  },
});

const showDescription = ref(false);
const toggleDescription = () => {
  showDescription.value = !showDescription.value;
};
</script>

<template>
  <div
    @click="toggleDescription"
    class="shadow-[0_0_5px_rgba(0,0,0,0.2)] cursor-pointer transition-colors duration-400 mb-4"
    :class="showDescription ? 'bg-gray-200' : 'bg-white'"
  >
    <div class="flex justify-between items-center  p-4">
      <div class="flex items-center">
        <!-- 展開/收合圖示 -->
        <button @click.stop="toggleDescription" class="w-8 h-8">
          <img
            :src="showDescription ? dashIcon : plusIcon"
            alt="toggle"
            class="object-contain cursor-pointer"
          />
        </button>
        <!--  -->
        <div class="ml-6">
          <!-- 標題 -->
          <p class="text-[32px]/[42px] font-bold text-gray-800">{{ item.title }}</p>
          <!-- 價格 -->
          <p v-if="item.price" class="text-[24px]/[32px] text-blue-500">
            NT$ {{ item.price.toLocaleString() }}
          </p>
        </div>
      </div>
      <CartButton />
    </div>

    <!-- 描述文字 -->
    <div v-if="showDescription" class="whitespace-pre-line px-[16px]">
      <hr />
      <p class="py-[16px] text-black text-[24px] font-['Microsoft_JhengHei']">
        {{ item.description }}
      </p>
    </div>
  </div>
</template>

