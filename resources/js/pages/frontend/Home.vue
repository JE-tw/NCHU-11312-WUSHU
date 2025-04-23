<script setup>
import Header from '../../components/Header.vue'
import Footer from '../../components/Footer.vue'

import imgSrc from '@/images/藥材aocax-ufyt5.webp'
import courseImg1 from '@/images/主打課程1a2axq-d0uqq.webp'
import courseImg2 from '@/images/主打課程2a1t2a-q5lk4.webp'
import masterImg1 from '@/images/關於站主a8k69-ybprq.webp'
import masterImg2 from '@/images/學會創立研革ay2gj-8gn6h.webp'

const bgImage = imgSrc;
</script>

<template>
    <div>
        <Header />

        <main>
            <!-- banner -->
            <section class="bg-cover bg-center bg-no-repeat w-[1903px] h-[920px]"
                :style="`background-image: url(${bgImage})`"></section>

            <!-- IntroSection -->
            <section id="intro" class="bg-white py-20">
                <div class="max-w-7xl mx-auto px-4 flex flex-col-reverse md:flex-row items-center gap-12">
                    <!-- Text Content -->
                    <div class="md:w-1/2 text-center md:text-left">
                        <h2 class="text-3xl md:text-4xl font-bold text-black mb-6">主打課程</h2>
                        <div>
                            <img :src="courseImg1" alt="蔣氏玄空風水執業班" class="rounded-xl shadow-lg" />
                            <p class="text-gray-700 text-lg leading-relaxed mb-6">
                                蔣氏玄空風水執業班
                            </p>
                        </div>
                        <div>
                            <img :src="courseImg2" alt="康治本傷寒論" class="rounded-xl shadow-lg" />
                            <p class="text-gray-700 text-lg leading-relaxed mb-6">
                                康治本傷寒論
                            </p>
                        </div>
                    </div>

                    
                </div>
            </section>

            <!-- Courses offered -->
            <section class="relative w-[1903px] h-[858px] overflow-hidden">
                <!-- 背景圖片（可換成你實際的圖片） -->
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('/images/courses-bg.jpg')"></div>

                <!-- 遮罩 -->
                <div class="absolute inset-0 bg-black"></div>

                <!-- 課程內容 -->
                <div class="relative z-10 flex flex-col items-center justify-center text-white h-full px-8">
                    <h2 class="text-4xl font-bold font-['Microsoft_JhengHei'] mb-6">課程介紹</h2>

                    <!-- 可以在這裡加上按鈕或卡片清單 -->
                </div>
            </section>


            <!-- AboutMaster -->
            <section class="py-16 bg-white font-['Microsoft_JhengHei'] text-[#0b0b0b]">

                <div class="max-w-6xl mx-auto px-4 md:px-6 space-y-24">
                    <!-- 標題 -->
                    <h2
                        class="text-[64px] leading-[100%] font-bold text-center font-['Microsoft_JhengHei'] border-b-2 border-gray-400 inline-block pb-2 mx-auto">
                        關於站主
                    </h2>


                    <!-- 第一段：右圖左文 -->
                    <div class="flex flex-col md:flex-row items-center gap-10">
                        <div class="md:w-1/2 space-y-4 text-lg leading-8 text-gray-800">
                            <p>
                                文老師自學生時期開始學習五術，致力於五術教學十多年。曾師事各中西派別之法師、靈性導師和占星家，融合傳統命理與西洋神秘學；內科傳統與自然醫學，展現多維的生命觀，並在教學中落實日常和實修並重。
                            </p>
                            <p>
                                命學目前以吠陀占星 Jyotish 為主，師承 Komilla、Joni Patry、Marc Boney 等大師級占星家與印度吠陀巨擘，輔以西洋占星與三元玄空學。吠陀
                                Vastu 地理、阿育吠陀、內丹學、元神、大乙術、禪修、中醫十二經絡學，以及原始點和脈輪氣場學皆為主修。
                            </p>
                            <p>
                                另外西方玄學修習西方古典元素理論、北歐魔法等皆為重大支點。
                            </p>
                        </div>
                        <div class="md:w-1/2">
                            <img :src="masterImg1" alt="禪石圖" class=" shadow-lg object-cover w-full" />
                        </div>
                    </div>

                    <!-- 第二段：左圖右文 -->
                    <div class="flex flex-col md:flex-row-reverse items-center gap-10">
                        <div class="md:w-1/2 space-y-4 text-lg leading-8 text-gray-800">
                            <h3 class="text-2xl font-bold border-b-2 border-black inline-block pb-1 mb-2">學會創立沿革</h3>
                            <div class="w-[487px] h-[975px] bg-lightGray">
                                <p>
                                    2008年，當時文老師在內湖高中任教，部分同事和學生知曉文老師傳承自古老的醫術，便欲向其學習，但老師當時並未想開課授徒，一方面是其老師們尚在世，二方面是覺得自己尚未成熟，故以五術研究社這種讀書會模式帶領眾人學習，不收學費為眾人解惑。

                                </p>
                                <p>
                                    直到2014在湖南攻讀中醫內科學研究所，同儕紛紛希望向文老師學習師承，加上傳授針灸和內科給文老師的老師們都過世了，文老師才開始決定開課陸續至今。
                                </p>
                            </div>
                        </div>
                        <div class="md:w-1/2 ">
                            <img :src="masterImg2" alt="中藥櫃" class=" shadow-lg object-cover w-full" />
                        </div>
                    </div>


                </div>
            </section>
        </main>

        <Footer />
    </div>
</template>
