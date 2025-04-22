<template>
    <footer class="bg-[#0b0b0b] text-white w-full py-4 text-sm">
        <div
            class="max-w-[1903px] mx-auto px-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4 md:h-[88px]">

            <!-- 左側：版權文字 -->
            <div class="flex flex-col md:items-start items-center leading-tight">
                <p>© 2022 五術研究社 版權所有</p>
            </div>

            <!-- 中間：連結 -->
            <div class="flex flex-wrap justify-center gap-6 text-sm">
                <a href="/contact" class="hover:text-gray-300">聯絡我們</a>
                <a href="/policy/refund" class="hover:text-gray-300">付款與退款政策</a>
                <a href="/policy/privacy" class="hover:text-gray-300">隱私權政策</a>
            </div>

            <!-- 右側：社群 icon -->
            <div class="mt-4 md:mt-0 flex space-x-6">
                <a href="https://www.facebook.com/?locale=zh_TW" target="_blank" aria-label="Facebook">
                    <img src="@/assets/img/facebook.png" alt="facebook" class="w-10 h-10" />
                </a>

                <a href="https://www.youtube.com/" target="_blank" aria-label="YouTube">
                    <img src="@/assets/img/youtube-白 1.png" alt="youtube" class="w-10 h-10" />
                </a>
            </div>
        </div>
    </footer>
</template>
