<template>
    <footer class="bg-[#0b0b0b] text-white w-full text-sm font-['Microsoft_JhengHei']">
        <div class="max-w-[1903px] mx-auto px-4 h-[120px] flex items-center justify-around flex-wrap md:flex-nowrap">

            <!-- 左側：版權文字 -->
            <div class="w-[313px] text-center md:text-left">
                <p class="font-bold text-[24px] leading-[100%] tracking-[0] whitespace-nowrap">
                    © 2022 五術研究社 版權所有
                </p>
            </div>

            <!-- 中間：連結 -->
            <div class="flex flex-wrap justify-center gap-6 font-bold text-[24px] leading-[100%] tracking-[0]">
                <a href="/contact" class="hover:text-blueGreen hover:underline border-r border-white pr-6">聯絡我們</a>
                <a href="/policy/refund" class="hover:text-blueGreen hover:underline border-r border-white pr-6">付款與退款政策</a>
                <a href="/policy/privacy" class="hover:text-blueGreen hover:underline">隱私權政策</a>
            </div>

            <!-- 右側：社群 icon -->
            <div class="w-[220px] flex items-center justify-end space-x-6">
                <a href="https://www.facebook.com/?locale=zh_TW" target="_blank" aria-label="Facebook">
                    <img src="@/images/facebook.png" alt="facebook" class="w-10 h-10" />
                </a>
                <a href="https://www.youtube.com/" target="_blank" aria-label="YouTube">
                    <img src="@/images/youtube-白 1.png" alt="youtube" class="w-10 h-10" />
                </a>
            </div>

        </div>
    </footer>

</template>