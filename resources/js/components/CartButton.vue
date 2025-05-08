<!-- CartButton.vue -->
<script setup>
import { useCartStore } from '@/stores/cart';
import { onMounted, computed } from 'vue';
import smallcart from '@/images/f-smallCart.png';

const cartStore = useCartStore();
onMounted(() => {
  cartStore.loadCartFromLocalStorage();
});

const props = defineProps({
  hideText: {
    type: Boolean,
    default: true,
  },
  cartShorter: {
    type: Boolean,
    default: true,
  },
  productId: Number,
  productName: String,
  price: Number,
  productType: Number, // 1=服務, 2=課程
});

// 是否已加入購物車
const isInCart = computed(() => cartStore.isInCart(props.productId, props.productType));

// 加至購物車
function addToCart(event) {
  if (isInCart.value) return;
  event.stopPropagation(); //按鈕防穿透
  cartStore.addToCart({
    id: props.productId,
    name: props.productName,
    price: props.price,
    quantity: 1,
    product_type: props.productType,
  });

  alert(`已加入「${props.productName}」至購物車`);
}
</script>

<template>
  <button
    type="button"
    @click="addToCart"
    :disabled="isInCart"
    :class="[
      'flex items-center justify-center rounded-full',
      isInCart ? 'cursor-not-allowed bg-gray-400' : 'bg-blueGreen',
      cartShorter ? 'h-[32px] w-[32px] sm:h-[40px] sm:w-[178px]' : 'h-[32px] w-[120px] sm:h-[40px] sm:w-[178px]',
    ]"
  >
    <img :src="smallcart" alt="small cart" class="mr-1 h-[16px] w-[16px] sm:mr-4 sm:h-[24px] sm:w-[24px]" />
    <span :class="hideText ? 'hidden text-[18px] text-white sm:block' : 'text-[12px] text-white sm:text-[18px]'"> 加入購物車 </span>
  </button>
</template>
