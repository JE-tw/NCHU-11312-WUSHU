<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import btnTopImg from '@/images/btn-top.webp'

const props = defineProps({
    position: {
        type: String,
        default: 'bottom-6 right-6'
    },
    threshold: {
        type: Number,
        default: 0
    }
})

const showButton = ref(true)


const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' })
}


</script>

<template>
    <button v-show="showButton" @click="scrollToTop" 
        :class="[
            'fixed z-[9999] rounded-full shadow-md bg-transparent',
            'w-[50px] h-[50px] bottom-4 right-4',
            'sm:w-[80px] sm:h-[80px] sm:bottom-6 sm:right-6'
        ]">
        <img :src="btnTopImg" alt="回到頂部" class="w-full h-full object-contain" />
    </button>
</template>


<style scoped></style>
