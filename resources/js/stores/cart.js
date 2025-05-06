import { defineStore } from 'pinia';
import { ref, computed } from 'vue';


export const useCartStore = defineStore('cart', {
  state: () => ({
    cartItems: [], // 不直接從 localStorage 初始化，改為在外部 mounted 時呼叫 loadCartFromLocalStorage
  }),
  getters: {
    cartCount: (state) => state.cartItems.length,
    isInCart: (state) => (productId, productType) => {
      return state.cartItems.some((item) => item.id == productId && item.product_type == productType);
    },
  },
  actions: {
    addToCart(item) {
      const exists = this.cartItems.find((i) => i.id === item.id && i.product_type === item.product_type);
      if (!exists) {
        this.cartItems.push(item);
        localStorage.setItem('cart', JSON.stringify(this.cartItems));
      }
    },
    removeFromCart(productId, productType) {
      this.cartItems = this.cartItems.filter((item) => !(item.id === productId && item.product_type === productType));
      localStorage.setItem('cart', JSON.stringify(this.cartItems));
    },
    loadCartFromLocalStorage() {
      const local = JSON.parse(localStorage.getItem('cart') || '[]');
      this.cartItems = local;
    },
  },
});
