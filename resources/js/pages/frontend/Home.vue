<script setup>
import Header from '../../Header.vue'
import Footer from '../../Footer.vue'
import imgSrc from '../../../images/藥材aocax-ufyt5.webp'


</script>

<!-- 首頁 -->
<template>
    <div>
        <Header />

        <main>
            <!-- banner -->
            <section class="bg-cover bg-center bg-no-repeat w-[1903px] h-[920px]"
                :style="`background-image: url(${bgImage})`">
            </section>

            <!-- IntroSection -->
            <section id="intro" class="bg-white py-20">
                <div class="max-w-7xl mx-auto px-4 flex flex-col-reverse md:flex-row items-center gap-12">
                    <!-- Text Content -->
                    <div class="md:w-1/2 text-center md:text-left">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">
                            吠陀占星課程
                        </h2>
                        <p class="text-gray-700 text-lg leading-relaxed mb-6">
                            吠陀占星為印度古老智慧之一，透過星體與靈魂結構的對應，理解命運、業力與修行方向。本課程將由實務入手，逐步引導你掌握分析星盤的核心技巧。
                        </p>
                        <a href="/courses/vedic-astrology"
                            class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition">
                            課程介紹
                        </a>
                    </div>

                    <!-- Image -->
                    <div class="md:w-1/2">
                        <img src="/resources/js/imgages/主打課程1a2axq-d0uqq.webp" alt="吠陀占星課程"
                            class="rounded-xl shadow-lg" />
                    </div>
                </div>
            </section>

            <!-- CourseCategoryTab -->


            <!-- AboutMaster -->
            <section id="about" class="py-16 bg-white font-['Microsoft_JhengHei'] text-[#0b0b0b]">
                <div class="max-w-6xl mx-auto px-4 md:px-6 space-y-24">

                    <!-- 標題 -->
                    <h2 class="text-3xl font-bold text-center border-b-2 border-gray-400 inline-block pb-2 mx-auto">
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
                            <img src="@/assets/img/關於站主a8k69-ybprq.webp" alt="禪石圖"
                                class="rounded-xl shadow-lg object-cover w-full" />
                        </div>
                    </div>

                    <!-- 第二段：左圖右文 -->
                    <div class="flex flex-col md:flex-row-reverse items-center gap-10">
                        <div class="md:w-1/2 space-y-4 text-lg leading-8 text-gray-800">
                            <h3 class="text-2xl font-bold border-b-2 border-gray-400 inline-block pb-1 mb-2">
                                學會創立沿革
                            </h3>
                            <p>
                                2008
                                年，當時文老師在內湖擔中醫主課，部分同學和學生期望文老師傳承自己的命理術，從而成立學員課程。但老師尚無意大量授課，另一方面藉機重整自身教學邏輯，重新吸納中西派系，建立五術研究社並建議書籍寫作規劃。
                            </p>
                            <p>
                                直到 2014 在讀河洛書中找到科學研究所，同時納入命理文字與修煉路系，加上傳授技巧與理論皆受學生的回饋重整，文老師才開始決定開展完整課程。
                            </p>
                        </div>
                        <div class="md:w-1/2">
                            <img src="@/assets/img/學會創立研革ay2gj-8gn6h.webp" alt="中藥櫃"
                                class="rounded-xl shadow-lg object-cover w-full" />
                        </div>
                    </div>

                    <!-- 結尾金句 -->
                    <p class="text-center text-gray-500 mt-12 italic text-sm">
                        「由內而外修煉，從知識走向智慧，讓靈魂回到自然之道。」
                    </p>
                </div>
            </section>


        </main>

        <Footer />
    </div>


</template>
