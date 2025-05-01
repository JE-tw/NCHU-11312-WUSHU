<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'

import Header from '../../components/Header.vue'
import Footer from '../../components/Footer.vue'

// ====== 載入圖片資源 ======
import imgSrc from '@/images/藥材aocax-ufyt5.webp'
import courseImg1 from '@/images/主打課程1a2axq-d0uqq.webp'
import courseImg2 from '@/images/主打課程2a1t2a-q5lk4.webp'
import masterImg1 from '@/images/關於站主a8k69-ybprq.webp'
import masterImg2 from '@/images/學會創立研革ay2gj-8gn6h.webp'
import tarotImg from '@/images/a1tgu3-dqrfv.webp'
import tcmImg from '@/images/ay1lo-pmcep.webp'
import magicImg from '@/images/a1tgu3-dqrfv.webp'
import othersImg from '@/images/FengShui.webp'

// ====== 背景圖 ======
const bgImage = imgSrc

// ====== 響應式裝置判斷 ======
const screens = {
    sm: '600px',
    xl: '1270px'
}

const windowWidth = ref(window.innerWidth)

const isDesktop = computed(() => windowWidth.value >= parseInt(screens.xl))
const isTablet = computed(() => windowWidth.value < parseInt(screens.xl) && windowWidth.value >= parseInt(screens.sm))
const isMobile = computed(() => windowWidth.value < parseInt(screens.sm))

const handleResize = () => {
    windowWidth.value = window.innerWidth
}

// ====== Tabs 資料 ======
const tabs = ref([
    { name: 'astrology', label: '吠陀占星', image: tarotImg },
    { name: 'medicine', label: '中醫', image: tcmImg },
    { name: 'magic', label: '古典魔法', image: magicImg },
    { name: 'others', label: '其它術數', image: othersImg }
])

const activeTab = ref('astrology')

const currentImage = computed(() => {
    const tab = tabs.value.find(t => t.name === activeTab.value)
    return tab ? tab.image : ''
})

// ====== 課程資料 ======
const courses = ref({
    astrology: [
        { name: '初階班', lessons: '16', duration: '2小時/堂', price: 'NT$28,000' },
        { name: '中階班', lessons: '16', duration: '3小時/堂', price: 'NT$28,000' },
        { name: '高階班', lessons: '20', duration: '2小時/堂', price: 'NT$36,000' },
        { name: '楊特拉(需有初階班基礎)', lessons: '24', duration: '3小時/堂', price: 'NT$40,000' },
        { name: '擇日', lessons: '24', duration: '3小時/堂', price: 'NT$40,000' },
        { name: '金融占星(需有中階班基礎)', lessons: '24', duration: '3小時/堂', price: 'NT$40,000' },
        { name: '咒陀占星進階班', lessons: '24', duration: '3小時/堂', price: 'NT$40,000' }
    ],
    medicine: [
        { name: '中醫入門', lessons: '16', duration: '2小時/堂', price: 'NT$28,000' },
        { name: '中醫進階', lessons: '20', duration: '3小時/堂', price: 'NT$36,000' }
    ],
    magic: [
        { name: '魔法入門', lessons: '16', duration: '2小時/堂', price: 'NT$28,000' },
        { name: '古典儀式魔法', lessons: '20', duration: '3小時/堂', price: 'NT$36,000' }
    ],
    others: [
        { name: '卜卦基礎', lessons: '12', duration: '2小時/堂', price: 'NT$22,000' },
        { name: '風水學', lessons: '16', duration: '3小時/堂', price: 'NT$28,000' }
    ]
})

// ====== 分頁設定 ======
const coursesPerPage = 6
const currentPage = ref(1)

const getCoursesForTab = (tabName) => {
    return courses.value[tabName] || []
}

const totalPages = computed(() => {
    const coursesForActiveTab = getCoursesForTab(activeTab.value)
    return Math.ceil(coursesForActiveTab.length / coursesPerPage)
})

const paginatedCourses = computed(() => {
    const coursesForActiveTab = getCoursesForTab(activeTab.value)
    const start = (currentPage.value - 1) * coursesPerPage
    const end = start + coursesPerPage
    return coursesForActiveTab.slice(start, end)
})

const changePage = (page) => {
    if (page >= 1 && page <= totalPages.value) {
        currentPage.value = page
    }
}

const changeTab = (tabName) => {
    activeTab.value = tabName
    currentPage.value = 1
}

// ====== LifeCycle Hooks ======
onMounted(() => {
    window.addEventListener('resize', handleResize)
    handleResize()

    // 預載所有圖片
    tabs.value.forEach(tab => {
        const img = new Image()
        img.src = tab.image
    })
})

onBeforeUnmount(() => {
    window.removeEventListener('resize', handleResize)
})
</script>



<template>
    <div>
        <Header />

        <main>
            <!-- banner -->
            <section class="bg-cover bg-center bg-no-repeat w-[1903px] h-[920px]"
                :style="`background-image: url(${bgImage})`"></section>

            <section id="intro" class="bg-white py-12 md:py-16 xl:py-20">
                <div class="max-w-7xl mx-auto px-4">
                    <!-- 主打課程標題 -->
                    <div class="text-center mb-8 md:mb-10 xl:mb-12">
                        <h2 class="text-3xl md:text-4xl xl:text-6xl font-bold text-black font-serif inline-block pb-2">
                            主打課程
                        </h2>
                        <div class="h-0.5 bg-black mt-2 mx-auto w-[180px] md:w-[200px] xl:w-[220px]"></div>
                    </div>

                    <!-- Cards container - flex-col for mobile & tablet, flex-row for desktop -->
                    <div class="flex flex-col xl:flex-row gap-6 md:gap-8 justify-center items-center">
                        <!-- Card 1 -->
                        <div class="bg-white overflow-hidden w-full xl:w-1/2">
                            <img :src="courseImg1" alt="蔣氏玄空風水執業班"
                                class="w-full h-[240px] sm:h-[280px] md:h-[320px] xl:h-[360px] object-cover" />
                            <div class="p-4 md:p-5 xl:p-6">
                                <p class="text-2xl sm:text-3xl md:text-4xl xl:text-[48px] leading-tight xl:leading-[100%] font-bold text-black font-serif text-left"
                                    style="letter-spacing: 2%;">
                                    蔣氏玄空風水執業班
                                </p>

                                <div
                                    class="mt-4 md:mt-5 xl:mt-6 flex flex-wrap sm:flex-nowrap items-center gap-3 md:gap-4">
                                    <button
                                        class="px-4 md:px-5 xl:px-6 py-1.5 md:py-2 bg-alertRed text-white rounded-full text-base md:text-lg hover:bg-gray-800 transition duration-300">
                                        其他術數
                                    </button>
                                    <p class="text-xl md:text-2xl xl:text-3xl font-bold text-black">NT$5,000</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="bg-white overflow-hidden w-full xl:w-1/2 mt-6 xl:mt-0">
                            <img :src="courseImg2" alt="康治本傷寒論"
                                class="w-full h-[240px] sm:h-[280px] md:h-[320px] xl:h-[360px] object-cover" />
                            <div class="p-4 md:p-5 xl:p-6">
                                <p class="text-2xl sm:text-3xl md:text-4xl xl:text-[48px] leading-tight xl:leading-[100%] font-bold text-black font-serif text-left"
                                    style="letter-spacing: 2%;">
                                    康治本傷寒論
                                </p>

                                <div
                                    class="mt-4 md:mt-5 xl:mt-6 flex flex-wrap sm:flex-nowrap items-center gap-3 md:gap-4">
                                    <button
                                        class="px-4 md:px-5 xl:px-6 py-1.5 md:py-2 bg-alertRed text-white rounded-full text-base md:text-lg hover:bg-gray-800 transition duration-300">
                                        中醫
                                    </button>
                                    <p class="text-xl md:text-2xl xl:text-3xl font-bold text-black">NT$5,000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- Courses offered -->
            <section class="relative w-full bg-black text-white overflow-hidden min-h-[858px]">
                <!-- 背景圖片、添加遮罩 -->
                <div class="absolute inset-0 z-0 overflow-hidden">
                    <transition name="fade" mode="out-in">
                        <img :key="activeTab" :src="currentImage" alt="課程背景"
                            class="w-full h-full object-contain object-left transition-opacity duration-500"
                            :class="activeTab === 'medicine' ? 'opacity-90' : 'opacity-50'" />

                    </transition>
                    <div class="absolute inset-0 bg-gradient-to-r from-black via-black/70 to-transparent"></div>
                </div>

                <div class="container mx-auto relative z-10">
                    <!-- 電腦版：兩欄佈局 -->
                    <template v-if="isDesktop">
                        <div class="flex">
                            <!-- 左側：標題和按鈕 -->
                            <div class="w-1/3 relative overflow-hidden bg-transparent pt-10"
                                style="margin-top: 20px; margin-left: 10px;">
                                <!-- 內容區 -->
                                <div class="relative z-10 px-6">
                                    <h2 class="text-[64px] font-serif font-bold">開立課程</h2>
                                    <div class="h-0.5 bg-white mt-2 w-60"></div>
                                    <a href="http://127.0.0.1:8000/wushu/ServiceCourse">
                                        <button
                                            class="w-36 h-14 mt-6 px-6 py-2 bg-deepTeal text-white rounded text-[24px] hover:bg-teal-700 transition duration-300">
                                            了解更多
                                        </button>
                                    </a>
                                </div>
                            </div>

                            <!-- 右區：課程列表 -->
                            <div class="w-2/3 flex flex-col pt-10 pr-6 pl-10">
                                <!-- 課程類型選項卡 -->
                                <div class="flex space-x-6 pb-4 border-b border-gray-700 overflow-x-auto">
                                    <button v-for="tab in tabs" :key="tab.name" class="py-2.5 px-6 font-medium 
                font-[Microsoft JhengHei] transition duration-200 whitespace-nowrap text-[32px]"
                                        :class="{ 'text-blueGreen border-b-2 border-blueGreen': activeTab === tab.name, 'text-gray-300 hover:text-white': activeTab !== tab.name }"
                                        @click="changeTab(tab.name)">
                                        {{ tab.label }}
                                    </button>
                                </div>

                                <!-- 課程清單 -->
                                <div class="flex-1 py-6 space-y-0">
                                    <div v-for="course in paginatedCourses" :key="course.name"
                                        class="flex items-center justify-between py-3.5 border-b border-dotted border-gray-600">
                                        <div class="text-[32px] font-medium w-2/5 truncate pr-4">
                                            {{ course.name }}
                                        </div>
                                        <div class="flex items-center justify-end space-x-4 w-3/5">
                                            <span class="bg-deepTeal text-white text-[24px] px-5 py-2 rounded-full">
                                                {{ course.lessons }}堂課
                                            </span>
                                            <span class="text-gray-300 w-24 text-[24px] text-center">{{ course.duration
                                                }}</span>
                                            <span class="text-deepTeal font-bold text-[24px] w-28 text-right">{{
                                                course.price }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- 分頁按鈕 -->
                                <div class="flex items-center space-x-2 mt-4">
                                    <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1"
                                        class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-white rounded disabled:opacity-50">
                                        ‹
                                    </button>

                                    <button v-for="page in totalPages" :key="page" @click="changePage(page)" :class="[
                                        'w-8 h-8 flex items-center justify-center rounded',
                                        page === currentPage ? 'bg-deepTeal text-white' : 'text-gray-300 hover:text-white'
                                    ]">
                                        {{ page }}
                                    </button>

                                    <button @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages"
                                        class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-white rounded disabled:opacity-50">
                                        ›
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- 平板版 -->
                    <template v-else-if="isTablet">
                        <!-- 標題區 -->
                        <div class="text-center pt-10 pb-6">
                            <h2 class="text-[48px] font-serif font-bold">開立課程</h2>
                            <div class="h-0.5 bg-white mt-2 w-60 mx-auto"></div>
                            <a href="http://127.0.0.1:8000/wushu/ServiceCourse" class="block mt-6">
                                <button
                                    class="w-36 h-14 px-6 py-2 bg-deepTeal text-white rounded text-[24px] hover:bg-teal-700 transition duration-300">
                                    了解更多
                                </button>
                            </a>
                        </div>

                        <!-- 課程類型選項卡 -->
                        <div class="flex justify-center space-x-6 pb-4 border-b border-gray-700 overflow-x-auto px-4">
                            <button v-for="tab in tabs" :key="tab.name"
                                class="py-2 px-4 font-medium text-2xl whitespace-nowrap"
                                :class="{ 'text-blueGreen border-b-2 border-blueGreen': activeTab === tab.name, 'text-gray-300 hover:text-white': activeTab !== tab.name }"
                                @click="changeTab(tab.name)">
                                {{ tab.label }}
                            </button>
                        </div>

                        <!-- 課程清單 -->
                        <div class="py-6 px-6">
                            <div v-for="course in paginatedCourses" :key="course.name"
                                class="flex items-center justify-between py-3.5 border-b border-dotted border-gray-600">
                                <div class="text-2xl font-medium w-1/3 truncate pr-2">
                                    {{ course.name }}
                                </div>
                                <div class="flex items-center justify-end gap-2 w-2/3">
                                    <span
                                        class="bg-deepTeal text-white text-xl px-4 py-1 rounded-full whitespace-nowrap">
                                        {{ course.lessons }}堂課
                                    </span>
                                    <span class="text-gray-300 text-xl text-center whitespace-nowrap">{{ course.duration
                                        }}</span>
                                    <span class="text-deepTeal font-bold text-xl text-right">{{ course.price }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- 分頁按鈕 -->
                        <div class="flex items-center justify-center space-x-2 mt-4 pb-6">
                            <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1"
                                class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-white rounded disabled:opacity-50">
                                ‹
                            </button>

                            <button v-for="page in totalPages" :key="page" @click="changePage(page)" :class="[
                                'w-8 h-8 flex items-center justify-center rounded',
                                page === currentPage ? 'bg-deepTeal text-white' : 'text-gray-300 hover:text-white'
                            ]">
                                {{ page }}
                            </button>

                            <button @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages"
                                class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-white rounded disabled:opacity-50">
                                ›
                            </button>
                        </div>
                    </template>

                    <!-- 手機版：垂直佈局 -->
                    <template v-else>
                        <!-- 標題區 -->
                        <div class="text-center pt-10 pb-6">
                            <h2 class="text-4xl font-serif font-bold">開立課程</h2>
                            <div class="h-0.5 bg-white mt-2 w-40 mx-auto"></div>
                            <a href="http://127.0.0.1:8000/wushu/ServiceCourse" class="block mt-4">
                                <button
                                    class="w-32 h-12 px-5 py-2 bg-deepTeal text-white rounded text-xl hover:bg-teal-700 transition duration-300">
                                    了解更多
                                </button>
                            </a>
                        </div>

                        <!-- 課程類型選項卡 - 橫向捲動 -->
                        <div class="flex overflow-x-auto pb-3 border-b border-gray-700 px-4">
                            <button v-for="tab in tabs" :key="tab.name"
                                class="py-2 px-4 mr-4 font-medium text-lg whitespace-nowrap flex-shrink-0"
                                :class="{ 'text-blueGreen border-b-2 border-blueGreen': activeTab === tab.name, 'text-gray-300 hover:text-white': activeTab !== tab.name }"
                                @click="changeTab(tab.name)">
                                {{ tab.label }}
                            </button>
                        </div>

                        <!-- 課程清單 -->
                        <div class="px-4 py-4">
                            <div v-for="course in paginatedCourses" :key="course.name"
                                class="border-b border-dotted border-gray-600 py-4">
                                <div class="text-xl font-medium mb-2">{{ course.name }}</div>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-2">
                                        <span class="bg-deepTeal text-white text-sm px-3 py-1 rounded-full">{{
                                            course.lessons }}堂課</span>
                                        <span class="text-gray-300 text-sm">{{ course.duration }}</span>
                                    </div>
                                    <span class="text-deepTeal font-bold text-lg">{{ course.price }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- 分頁按鈕 -->
                        <div class="flex items-center justify-center space-x-2 mt-4 pb-6">
                            <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1"
                                class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-white rounded disabled:opacity-50">
                                ‹
                            </button>

                            <button v-for="page in totalPages" :key="page" @click="changePage(page)" :class="[
                                'w-8 h-8 flex items-center justify-center rounded',
                                page === currentPage ? 'bg-deepTeal text-white' : 'text-gray-300 hover:text-white'
                            ]">
                                {{ page }}
                            </button>

                            <button @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages"
                                class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-white rounded disabled:opacity-50">
                                ›
                            </button>
                        </div>
                    </template>
                </div>
            </section>



            <!-- AboutMaster -->
            <!-- 關於站主區塊 -->
            <section id="about-section" class="relative bg-white">
                <div class="max-w-[1200px] mx-auto px-[20px] py-[40px] sm:px-[30px] sm:py-[60px]">
                    <h2
                        class="text-[36px] sm:text-[48px] xl:text-[64px] font-semibold text-center mb-[30px] sm:mb-[40px] relative block font-serif after:content-[''] after:absolute after:bottom-[-6px] after:left-1/2 after:-translate-x-1/2 after:w-[180px] sm:after:w-[260px] after:h-[2px] after:bg-black">
                        關於站主
                    </h2>

                    <!-- 在手機版和平板版文字在上，圖片在下；桌面版圖片在右，文字在左 -->
                    <div class="flex flex-col xl:flex-row items-center gap-[30px] sm:gap-[50px] xl:gap-[40px]">
                        <!-- 文字區塊 (左側) -->
                        <div class="flex-1 text-[18px] sm:text-[20px] xl:text-[24px]">
                            <p class="leading-[1.8] mb-[15px]">
                                文老師自學生時期便開始學習五術，致力於五術教學十餘年。中醫醫術－針灸傳承自古法針灸、董氏奇穴和山西派鍼法；脈學傳承自萬氏的太素脈學；內科傳承各家如經方、溫病、伏氣學派等多位老師；祝由傳承自西河派和軒轅派。
                            </p>
                            <p class="leading-[1.8] mb-[15px]">
                                命學目前以吠陀占星 Jyotish 為主，師從 Komilla、Joni Patry、Marc Boney
                                等國際大家還有十數位印度吠陀占星大師；風水承襲自蔣氏三元玄空風水、吠陀 Vastu
                                和龍門八局，亦通道家奇門遁甲、大六壬、太乙神數三式之學、梅花易數，以及是為熊氏太極拳傳人及華佗門第八十代傳人。
                            </p>
                            <p class="leading-[1.8] mb-[15px]">
                                另外西方之學尚有西洋古典行星護符魔法、北歐魔法等皆是師從大家。
                            </p>
                        </div>

                        <!-- 圖片區塊 (右側) -->
                        <div class="flex-1 w-full xl:w-auto overflow-hidden">
                            <img :src="masterImg1" alt="禪石圖" class="w-full h-auto block" />
                        </div>
                    </div>
                </div>
            </section>



            <!-- 學會創立沿革區塊 -->
            <section id="history-section" class="relative bg-white">
                <div
                    class="max-w-[1200px] mx-auto px-[20px] py-[40px] sm:px-[30px] sm:py-[60px] xl:px-[20px] xl:py-[50px]">

                    <!-- 標題 (在文字區塊上方，桌面版與 RWD 通用) -->
                    <h2 class="text-[36px] sm:text-[48px] xl:text-[64px] font-semibold text-center mb-[30px] sm:mb-[40px] relative block font-serif
             after:content-[''] after:absolute after:bottom-[-6px] after:left-1/2 after:-translate-x-1/2
             after:w-[220px] sm:after:w-[380px] after:h-[2px] after:bg-black">
                        學會創立沿革
                    </h2>

                    <!-- 圖文區塊 -->
                    <div class="flex flex-col xl:flex-row items-start gap-[30px] sm:gap-[50px] xl:gap-[30px]">

                        <!-- 圖片區塊：左側 (桌面) / 上方 (手機平板) -->
                        <div class="w-full xl:w-1/2 overflow-hidden">
                            <img :src="masterImg2" alt="中藥櫃" class="w-full h-auto object-cover" />
                        </div>

                        <!-- 文字區塊：右側 (桌面) / 下方 (手機平板) -->
                        <div class="w-full xl:w-1/2 bg-lightGray px-[20px] py-[15px] sm:px-[30px] sm:py-[20px]">
                            <div class="max-w-[800px] mx-auto">
                                <p class="text-[18px] sm:text-[20px] xl:text-[24px] leading-[1.8] mb-[20px]">
                                    <span
                                        class="text-[30px] sm:text-[36px] xl:text-[40px] font-bold text-black">2008</span>年，當時文老師在內湖高中任教，
                                    部分同事和學生知曉文老師傳承自古老的醫術，便欲向其學習，但老師當時並未想開課授徒，一方面是其老師們尚在世，
                                    二方面是覺得自己尚未成熟，故以五術研究社這種讀書會模式帶領眾人學習，不收學費為眾人解惑。
                                </p>
                                <p class="text-[18px] sm:text-[20px] xl:text-[24px] leading-[1.8] mb-[20px]">
                                    直到2014在湖南攻讀中醫內科學研究所，同儕紛紛希望向文老師學習師承，加上傳授針灸和內科給文老師的老師們都過世了，
                                    文老師才開始決定開課陸續至今。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



        </main>

        <Footer />
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
