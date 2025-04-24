<script setup>
import Header from '../../components/Header.vue'
import Footer from '../../components/Footer.vue'

import imgSrc from '@/images/藥材aocax-ufyt5.webp'
import courseImg1 from '@/images/主打課程1a2axq-d0uqq.webp'
import courseImg2 from '@/images/主打課程2a1t2a-q5lk4.webp'
import masterImg1 from '@/images/關於站主a8k69-ybprq.webp'
import masterImg2 from '@/images/學會創立研革ay2gj-8gn6h.webp'

import { ref, computed } from 'vue';

const bgImage = imgSrc;

const tabs = ref([
  { name: 'vedic-astrology', label: '吠陀占星', image: '/images/vedic-astrology-banner.jpg' },
  { name: 'chinese-medicine', label: '中醫', image: '/images/chinese-medicine-banner.jpg' },
  { name: 'classical-magic', label: '古典魔法', image: '/images/classical-magic-banner.jpg' },
  { name: 'other-occult', label: '其他術數', image: '/images/other-occult-banner.jpg' }
]);

const activeTab = ref(tabs.value[0].name);

const currentImage = computed(() => {
  const activeTabObject = tabs.value.find(tab => tab.name === activeTab.value);
  return activeTabObject ? activeTabObject.image : '/images/default-course-banner.jpg';
});

const coursesData = ref({
  'vedic-astrology': [
    { name: '初階班', duration: '2小時/堂', price: 'NT$28,000', lessons: 16 },
    { name: '中階班', duration: '3小時/堂', price: 'NT$28,000', lessons: 16 },
    { name: '高階班', duration: '2小時/堂', price: 'NT$36,000', lessons: 20 },
    { name: '專特拉(需有初階班基礎)', duration: '3小時/堂', price: 'NT$40,000', lessons: 24 },
    { name: '專特拉(需有初階班基礎)', duration: '3小時/堂', price: 'NT$40,000', lessons: 24 },
    { name: '擇日', duration: '3小時/堂', price: 'NT$40,000', lessons: 24 }
  ],
  'chinese-medicine': [
    { name: '中醫入門', duration: '2小時/堂', price: 'NT$25,000', lessons: 12 },
    { name: '經絡學', duration: '3小時/堂', price: 'NT$32,000', lessons: 18 }
  ],
  'classical-magic': [
    { name: '魔法入門', duration: '2.5小時/堂', price: 'NT$30,000', lessons: 10 }
  ],
  'other-occult': [
    { name: '塔羅牌初階', duration: '1.5小時/堂', price: 'NT$18,000', lessons: 8 }
  ]
});

const getCoursesForTab = (tabName) => {
  return coursesData.value[tabName] || [];
};
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
            <section class="relative w-full md:w-[1903px] h-auto md:h-[858px] overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('/images/courses-bg.jpg')"></div>

                <div class="absolute inset-0 bg-black opacity-70"></div>

                <div
                    class="relative z-10 flex flex-col md:flex-row items-stretch md:items-center justify-start md:justify-center text-white min-h-[600px] px-4 md:px-8 py-8 md:py-0">

                    <div class="md:w-1/3 flex items-center justify-center mb-6 md:mb-0 md:mr-8">
                        <img :src="currentImage" alt="課程主題圖片" class="max-w-full h-auto rounded-md shadow-lg">
                    </div>

                    <div class="md:w-2/3 bg-white text-black  ">
                        <div class="flex border-b border-[#e0e0e0]">
                            <button v-for="tab in tabs" :key="tab.name"
                                class="py-2 px-4 md:py-3 md:px-6 block font-semibold text-sm md:text-base"
                                :class="{ 'text-[#1e88e5] border-b-2 border-[#1e88e5]': activeTab === tab.name, 'text-[#757575] hover:text-[#212121]': activeTab !== tab.name }"
                                aria-selected="activeTab === tab.name" @click="activeTab = tab.name">
                                {{ tab.label }}
                            </button>
                        </div>
                        <div class="mt-4 px-4 md:px-6">
                            <div v-for="tab in tabs" :key="tab.name" :id="`${tab.name}-courses`"
                                :class="{ 'hidden': activeTab !== tab.name }">
                                <h3 class="text-lg md:text-xl font-semibold mb-3">{{ tab.label }}</h3>
                                <table class="w-full border-collapse">
                                    <thead>
                                        <tr
                                            class="border-b border-[#e0e0e0] text-left text-sm md:text-base text-[#757575]">
                                            <th class="py-2"></th>
                                            <th class="py-2"></th>
                                            <th class="py-2"></th>
                                            <th class="py-2"></th>
                                            <th class="py-2 text-right"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(course, index) in getCoursesForTab(tab.name)" :key="course.name"
                                            class="border-b border-[#e0e0e0] text-sm md:text-base text-[#212121]">
                                            <td class="py-2 text-[#9e9e9e]">{{ index + 1 }}.</td>
                                            <td class="py-2">{{ course.name }}</td>
                                            <td class="py-2 text-[#9e9e9e]">{{ course.lessons }}堂</td>
                                            <td class="py-2 text-[#9e9e9e]">{{ course.duration }}</td>
                                            <td class="py-2 text-right">{{ course.price }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p v-if="getCoursesForTab(tab.name).length === 0" class="text-gray-500 mt-2">
                                    目前沒有 {{ tab.label }} 相關課程。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- AboutMaster -->
            <section class="py-24 bg-white font-serif text-[#0b0b0b]">
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
