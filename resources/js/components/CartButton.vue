<!-- CartButton.vue -->
<script setup>
import smallcart from '@/images/f-smallCart.png';

const props = defineProps({
  hideText: {
    type: Boolean,
    default: true,
  },
  cartShorter: {
    type: Boolean,
    default: true,
  },
  productId: String,
  productName: String,
  price: Number,
  productType: Number, // 1=服務, 2=課程
});

function addToCart() {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];

  const exists = cart.find((item) => item.id === props.productId && item.product_type === props.productType);

  if (exists) {
    alert(`「${props.productName}」已在購物車，無法重複加入`);
    return;
  }

  cart.push({
    id: props.productId,
    name: props.productName,
    price: props.price,
    quantity: 1,
    product_type: props.productType,
  });

  localStorage.setItem('cart', JSON.stringify(cart));
  alert(`已加入「${props.productName}」至購物車`);
  console.log(`已加入購物車  id:${props.productId},品項：${props.productName},金額：${props.price}`);
}
</script>

<template>
  <button
    type="button"
    @click="addToCart"
    :class="[
      'flex items-center justify-center rounded-full bg-blueGreen',
      cartShorter ? 'h-[32px] w-[32px] sm:h-[40px] sm:w-[178px]' : 'h-[32px] w-[120px] sm:h-[40px] sm:w-[178px]',
    ]"
  >
    <img :src="smallcart" alt="small cart" class="mr-1 h-[16px] w-[16px] sm:mr-4 sm:h-[24px] sm:w-[24px]" />
    <span :class="hideText ? 'hidden text-[18px] text-white sm:block' : 'text-[12px] text-white sm:text-[18px]'"> 加入購物車 </span>
  </button>
</template>
