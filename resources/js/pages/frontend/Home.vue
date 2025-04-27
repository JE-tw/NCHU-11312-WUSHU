<script setup>
import { ref, computed } from 'vue'

import Header from '../../components/Header.vue'
import Footer from '../../components/Footer.vue'

import imgSrc from '@/images/藥材aocax-ufyt5.webp'
import courseImg1 from '@/images/主打課程1a2axq-d0uqq.webp'
import courseImg2 from '@/images/主打課程2a1t2a-q5lk4.webp'
import masterImg1 from '@/images/關於站主a8k69-ybprq.webp'
import masterImg2 from '@/images/學會創立研革ay2gj-8gn6h.webp'

// 背景圖
const bgImage = imgSrc

// Tabs 資料
const tabs = ref([
  { name: 'tarot', label: '吠陀占星', image: '/images/tarot-bg.jpg' },
  { name: 'tcm', label: '中醫', image: '/images/tcm-bg.jpg' },
  { name: 'magic', label: '古典魔法', image: '/images/magic-bg.jpg' },
  { name: 'others', label: '其它術數', image: '/images/others-bg.jpg' }
])

// 預設選中的 tab
const activeTab = ref('tarot')

// 依照 activeTab 計算對應的背景圖片
const currentImage = computed(() => {
  const tab = tabs.value.find(t => t.name === activeTab.value)
  return tab ? tab.image : ''
})

// 課程資料
const courses = ref({
  tarot: [
    { name: '', lessons: '16', duration: '2小時/堂', price: 'NT$28,000' },
    { name: '', lessons: '16', duration: '3小時/堂', price: 'NT$28,000' },
    { name: '', lessons: '20', duration: '2小時/堂', price: 'NT$36,000' },
    { name: '', lessons: '24', duration: '3小時/堂', price: 'NT$40,000' },
    { name: '', lessons: '24', duration: '3小時/堂', price: 'NT$40,000' },
    { name: '', lessons: '24', duration: '3小時/堂', price: 'NT$40,000' }
  ],
  tcm: [
    { name: '古典針灸基礎班', lessons: '12', duration: '3小時/堂', price: 'NT$36,000' },
    { name: '康治本傷寒論', lessons: '12', duration: '2小時/堂', price: 'NT$36,000' },
    { name: '金匱要略', lessons: '20', duration: '2小時/堂', price: 'NT$40,000' },
    { name: '伏氣溫病學', lessons: '20', duration: '2小時/堂', price: 'NT$52,000' }
  ],
  magic: [
    { name: '蔣氏玄空風水執業班', lessons: '24', duration: '2小時/堂', price: 'NT$36,000' }
  ],
  others: [
    { name: '蔣氏玄空風水執業班', lessons: '16', duration: '2小時/堂', price: 'NT$28,000' },
    { name: '', lessons: '16', duration: '2小時/堂', price: 'NT$28,000' },
    { name: '', lessons: '16', duration: '3小時/堂', price: 'NT$28,000' },
    { name: '', lessons: '20', duration: '2小時/堂', price: 'NT$36,000' },
    { name: '', lessons: '24', duration: '3小時/堂', price: 'NT$40,000' },
    { name: '', lessons: '24', duration: '3小時/堂', price: 'NT$40,000' },
    { name: '', lessons: '24', duration: '3小時/堂', price: 'NT$40,000' }
  ]
})

// 取得某個 tab 對應的課程清單
const getCoursesForTab = (tabName) => {
  return courses.value[tabName] || []
}

// 切換 activeTab
const changeTab = (tabName) => {
  activeTab.value = tabName
}
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
            <section class="relative w-full h-auto md:h-[858px] bg-black text-white overflow-hidden">
                <!-- Background with pentagram symbol overlay -->
                <div class="absolute inset-0 bg-black opacity-70"></div>
                <div class="absolute inset-0 bg-left-bottom bg-no-repeat"
                    style="background-image: url('/images/pentagram-bg.jpg'); opacity: 0.3; background-size: 50%;">
                </div>

                <div class="container mx-auto h-full flex flex-col relative z-10">
                    <!-- Title section - 修改為左對齊 -->
                    <div class="text-left pt-10 pb-6">
                        <h2 class="text-5xl font-serif font-bold">開立課程</h2>
                        <div class="h-0.5 bg-deepTeal mt-2 w-32"></div>
                        <button
                            class="mt-6 px-8 py-2 bg-deepTeal text-white rounded text-lg hover:bg-teal-700 transition duration-300">
                            了解更多
                        </button>
                    </div>

                    <!-- Tabs navigation -->
                    <div class="flex justify-start space-x-6 pb-2 border-b border-gray-700">
                        <button v-for="tab in tabs" :key="tab.name"
                            class="py-2.5 px-6 font-medium transition duration-200 text-lg"
                            :class="{ 'text-blueGreen border-b-2 border-blueGreen': activeTab === tab.name, 'text-gray-300 hover:text-white': activeTab !== tab.name }"
                            @click="changeTab(tab.name)">
                            {{ tab.label }}
                        </button>
                    </div>

                    <!-- Course listings -->
                    <div class="flex-1 overflow-y-auto py-6">
                        <div v-for="tab in tabs" :key="tab.name" v-show="activeTab === tab.name">
                            <div class="space-y-1">
                                <div v-for="(course, index) in getCoursesForTab(tab.name)" :key="index"
                                    class="flex flex-col md:flex-row justify-between items-start md:items-center py-4 border-b border-dotted border-gray-600">
                                    <div class="text-xl font-medium md:w-1/3">{{ course.name }}</div>
                                    <div class="flex items-center space-x-8 md:w-2/3 justify-end">
                                        <span class="bg-deepTeal text-white px-5 py-1.5 rounded-full">
                                            {{ course.lessons }}堂課
                                        </span>
                                        <span class="text-gray-300">{{ course.duration }}</span>
                                        <span class="text-deepTeal font-bold text-xl">{{ course.price }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pagination -->
                            <div class="flex justify-start mt-12">
                                <div class="flex space-x-2">
                                    <button
                                    class="w-8 h-8 flex items-center justify-center rounded text-gray-300 hover:bg-gray-700"><</button>
                                    <button
                                        class="w-8 h-8 flex items-center justify-center rounded bg-deepTeal text-white">1</button>
                                    <button
                                        class="w-8 h-8 flex items-center justify-center rounded text-gray-300 hover:bg-gray-700">2</button>
                                    <button
                                        class="w-8 h-8 flex items-center justify-center rounded text-gray-300 hover:bg-gray-700">3</button>
                                    <button
                                        class="w-8 h-8 flex items-center justify-center rounded text-gray-300 hover:bg-gray-700">4</button>
                                    <button
                                        class="w-8 h-8 flex items-center justify-center rounded text-gray-300 hover:bg-gray-700">›</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dynamic background image (shows on desktop) -->
                <div class="hidden md:block absolute top-0 left-0 w-1/2 h-full z-0">
                    <img :src="currentImage" alt="課程背景"
                        class="hidden md:block absolute top-1/2 left-1/4 transform -translate-x-1/2 -translate-y-1/2 opacity-10 max-w-none h-full">
                </div>
            </section>


            <!-- AboutMaster -->
            <section class="py-24 bg-white font-serif text-black">
                <div class="max-w-7xl mx-auto px-4 xl:px-8 space-y-24">
                    <!-- 標題 -->
                    <div class="text-center">
                        <h2
                            class="text-[48px] xl:text-[64px] leading-[100%] font-bold border-b-2 border-black inline-block pb-2">
                            關於站主
                        </h2>
                    </div>

                    <!-- 第一段：右圖左文 -->
                    <div class="flex flex-col xl:flex-row items-center gap-12">
                        <div class="xl:w-1/2 space-y-6 text-lg leading-relaxed text-black">
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
                        <div class="xl:w-1/2">
                            <img :src="masterImg1" alt="禪石圖" class="shadow-lg object-cover w-full " />
                        </div>
                    </div>

                    <!-- 第二段：左圖右文 -->
                    <div class="flex flex-col xl:flex-row-reverse items-center gap-12">
                        <div class="xl:w-1/2 space-y-6 text-lg leading-relaxed text-gray-800">
                            <h3
                                class="text-[48px] xl:text-[64px] font-bold border-b-2 border-black inline-block pb-1 mb-4">
                                學會創立沿革</h3>
                            <div class="bg-lightGray p-6 ">
                                <p>
                                    2008年，當時文老師在內湖高中任教，部分同事和學生知曉文老師傳承自古老的醫術，便欲向其學習，但老師當時並未想開課授徒，一方面是其老師們尚在世，二方面是覺得自己尚未成熟，故以五術研究社這種讀書會模式帶領眾人學習，不收學費為眾人解惑。
                                </p>
                                <p class="mt-4">
                                    直到2014在湖南攻讀中醫內科學研究所，同儕紛紛希望向文老師學習師承，加上傳授針灸和內科給文老師的老師們都過世了，文老師才開始決定開課陸續至今。
                                </p>
                            </div>
                        </div>
                        <div class="xl:w-1/2">
                            <img :src="masterImg2" alt="中藥櫃" class="shadow-lg object-cover w-full " />
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <Footer />
    </div>
</template>

<style scope>
/* Ensure smooth transitions when switching tabs */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

/* RWD adjustments */
@media (max-width: 600px) {
    section {
        min-height: 600px;
    }
}
</style>
