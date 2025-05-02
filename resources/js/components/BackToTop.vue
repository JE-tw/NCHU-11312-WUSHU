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

const showButton = ref(false)

const handleScroll = () => {
    showButton.value = window.scrollY > props.threshold
}

const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' })
}

onMounted(() => window.addEventListener('scroll', handleScroll))
onUnmounted(() => window.removeEventListener('scroll', handleScroll))
</script>

<template>
    <button v-show="showButton" @click="scrollToTop"
        :class="['fixed z-[9999] w-[80px] h-[80px] rounded-full shadow-md bottom-6 right-6 bg-transparent']">
        <img :src="btnTopImg" alt="回到頂部" class="w-full h-full object-contain" />
    </button>
</template>

<style scoped>

</style>
