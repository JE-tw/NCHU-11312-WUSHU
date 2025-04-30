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
import othersImg from '@/images/a1tgu3-dqrfv.webp'

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
    { name: 'astrology', label: '咒陀占星', image: tarotImg },
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

            <section id="intro" class="bg-white py-20">
                <div class="max-w-7xl mx-auto px-4">
                    <!-- 主打課程標題 -->
                    <div class="text-center mb-12">
                        <h2 class="text-4xl xl:text-6xl font-bold text-black font-serif inline-block pb-2">
                            主打課程
                        </h2>
                        <div class="h-0.5 bg-black mt-2 mx-auto w-[220px]"></div>
                    </div>

                    <!-- Cards container -->
                    <div class="flex flex-col xl:flex-row gap-8 justify-center items-center">
                        <!-- Card 1 -->
                        <div class="bg-white overflow-hidden w-full xl:w-1/2">
                            <img :src="courseImg1" alt="蔣氏玄空風水執業班" class="w-full h-[360px] object-cover" />
                            <div class="p-6">
                                <p class="text-[48px] leading-[100%] font-bold text-black font-serif text-left"
                                    style="letter-spacing: 2%;">
                                    蔣氏玄空風水執業班
                                </p>
                                <!-- 價格和按鈕同一行並與上方文字左對齊 -->
                                <div class="mt-6 flex items-center gap-4">
                                    <button
                                        class="px-6 py-2 bg-alertRed text-white rounded-full text-lg hover:bg-gray-800 transition duration-300">
                                        其他術數
                                    </button>
                                    <p class="text-3xl font-bold text-black">NT$5000</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="bg-white overflow-hidden w-full xl:w-1/2">
                            <img :src="courseImg2" alt="康治本傷寒論" class="w-full h-[360px] object-cover" />
                            <div class="p-6">
                                <p class="text-[48px] leading-[100%] font-bold text-black font-serif text-left"
                                    style="letter-spacing: 2%;">
                                    康治本傷寒論
                                </p>

                                <div class="mt-6 flex items-center gap-4">
                                    <button
                                        class="px-6 py-2 bg-alertRed text-white rounded-full text-lg hover:bg-gray-800 transition duration-300">
                                        中醫
                                    </button>
                                    <p class="text-3xl font-bold text-black">NT$5000</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>


            <!-- Courses offered -->
            <!-- 課程區塊 - RWD實作 -->
            <section class="relative w-full bg-black text-white overflow-hidden" :class="{ 'h-[858px]': !isMobile }">
                <!-- 背景图片 - 使用绝对定位并添加渐变遮罩 -->
                <div class="absolute inset-0 z-0 overflow-hidden">
                    <transition name="fade" mode="out-in">
                        <img :key="activeTab" :src="currentImage" alt="課程背景"
                            class="w-full h-full object-cover opacity-50" />
                    </transition>
                    <!-- 添加渐变遮罩 -->
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

                    <!-- 平板版：一欄佈局 -->
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
            <section id="about-section" class="py-12 sm:py-16 md:py-24 bg-white font-serif text-black overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 xl:pr-8 xl:pl-0 space-y-16 md:space-y-24">
                    <div class="text-center mt-3">
                        <h2
                            class="text-4xl md:text-[48px] xl:text-[64px] leading-[100%] font-bold font-serif border-b-2 border-black inline-block pb-2">
                            關於站主
                        </h2>
                    </div>

                    <div class="flex flex-col xl:flex-row items-center gap-12">
                        <div
                            class="xl:w-1/2 space-y-6 text-lg md:text-xl xl:text-2xl leading-relaxed text-black xl:mt-[-330px] mt-0">
                            <p>
                                文老師自學生時期便開始學習五術，致力於五術教學十餘年。中醫醫術－針灸傳承自古法針灸、董氏奇穴和山西派鍼法；脈學傳承自萬氏的太素脈學；內科傳承各家如經方、溫病、伏氣學派等多位老師；祝由傳承自西河派和軒轅派。
                            </p>
                            <p>
                                命學目前以吠陀占星Jyotish為主，師從Komilla、Joni patry、Marc Boney
                                等國際大家還有十數位印度吠陀占星大師；風水承襲自蔣氏三元玄空風水、吠陀Vastu和龍門八局，亦通道家奇門遁甲、大六壬、太乙神數三式之學、梅花易數，以及是為熊氏太極拳傳人及華佗門第八十代傳人。
                            </p>
                            <p>
                                另外西方之學尚有西洋古典行星護符魔法、北歐魔法等皆是師從大家。
                            </p>
                        </div>
                        <div class="xl:w-1/2 flex justify-center items-center">
                            <img :src="masterImg1" alt="禪石圖" class="shadow-lg object-cover w-full h-auto xl:h-full" />
                        </div>
                    </div>


                    <div
                        class="relative w-full xl:-ml-[calc((100vw-1280px)/2+2rem)] xl:w-[calc(100%+((100vw-1280px)/2+2rem))]">
                        <div class="flex flex-col xl:flex-row items-center xl:items-stretch w-full">
                            <!-- 圖片區塊 - 左側 -->
                            <div class="w-full xl:w-[1023.36px] relative">
                                <img :src="masterImg2" alt="中藥櫃" class="w-full h-auto xl:h-[760px] object-cover" />
                            </div>

                            <!-- 文字區塊 - 右側 -->
                            <div
                                class="absolute top-[675px] left-[928px] w-[487px] h-[975px] bg-gray-200 flex flex-col">
                                <div class="p-6 xl:p-8 h-full flex flex-col">
                                    <h3
                                        class="text-[64px] md:text-4xl xl:text-5xl font-bold font-serif border-b-2 border-black inline-block pb-1 mb-6 whitespace-nowrap">
                                        學會創立沿革
                                    </h3>
                                    <div class="text-lg md:text-xl xl:text-[22px] leading-relaxed">
                                        <p>
                                            2008年，當時文老師在內湖高中任教，部分同事和學生知曉文老師傳承自古老的醫術，便欲向其學習，但老師當時並未想開課授徒，一方面是其老師們尚在世，二方面是覺得自己尚未成熟，故以五術研究社這種讀書會模式帶領眾人學習，不收學費為眾人解惑。
                                        </p>
                                        <p class="mt-4">
                                            直到2014在湖南攻讀中醫內科學研究所，同儕紛紛希望向文老師學習師承，加上傳授針灸和內科給文老師的老師們都過世了，文老師才開始決定開課陸續至今。
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </section>

        </main>

        <Footer />
    </div>
</template>

<style scope>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}


:deep(.bg-deepTeal) {
    background-color: #2D8A98;
}

:deep(.text-blueGreen) {
    color: #2D8A98;
}

:deep(.border-blueGreen) {
    border-color: #2D8A98;
}
</style>
