<!-- <template>
    <footer class="bg-[#0b0b0b] text-white w-full text-sm font-['Microsoft_JhengHei']">
        <div class="max-w-[1903px] mx-auto px-4 h-[120px] flex items-center justify-around flex-wrap md:flex-nowrap">

           
            <div class="w-[313px] text-center md:text-left">
                <p class="font-bold text-[24px] leading-[100%] tracking-[0] whitespace-nowrap">
                    © 2022 五術研究社 版權所有
                </p>
            </div>

     
            <div class="flex flex-wrap justify-center gap-6 font-bold text-[24px] leading-[100%] tracking-[0]">
                <a href="/contact" class="hover:text-blueGreen hover:underline border-r border-white pr-6">聯絡我們</a>
                <a href="/policy/refund" class="hover:text-blueGreen hover:underline border-r border-white pr-6">付款與退款政策</a>
                <a href="/policy/privacy" class="hover:text-blueGreen hover:underline">隱私權政策</a>
            </div>

         
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

<style scoped>

</style> -->

<template>
    <footer class="bg-[#0b0b0b] text-white w-full text-sm font-['Microsoft_JhengHei']">
      <div class="max-w-[1903px] mx-auto px-4 h-[120px] flex items-center justify-around flex-wrap md:flex-nowrap">
  
        <div class="w-[313px] text-center md:text-left copyright">
          <p class="font-bold text-[24px] leading-[100%] tracking-[0] whitespace-nowrap">
            © 2022 五術研究社 版權所有
          </p>
        </div>
  
        <div class="flex flex-wrap justify-center gap-6 font-bold text-[24px] leading-[100%] tracking-[0] links">
          <a href="http://127.0.0.1:8000/wushu/ContactUs" class="hover:text-blueGreen hover:underline border-r border-white pr-6">聯絡我們</a>
          <a href="http://127.0.0.1:8000/wushu/Policy" class="hover:text-blueGreen hover:underline border-r border-white pr-6">付款與退款政策</a>
          <a href="http://127.0.0.1:8000/wushu/Privacy" class="hover:text-blueGreen hover:underline">隱私權政策</a>
        </div>
  
        <div class="w-[220px] flex items-center justify-end social-icons gap-2">
          <a href="https://www.facebook.com/?locale=zh_TW" target="_blank" aria-label="Facebook" class="social-icon-link">
            <img src="@/images/facebook.png" alt="facebook" class="w-10 h-10" />
          </a>
          <a href="https://www.youtube.com/" target="_blank" aria-label="YouTube" class="social-icon-link">
            <img src="@/images/youtube-白 1.png" alt="youtube" class="w-10 h-10" />
          </a>
        </div>
  
      </div>
    </footer>
  </template>
  
  <style scoped>
  
  @media (max-width: 599px) {
    .copyright {
      width: 100%;
      text-align: center;
      font-size: 20px;
    }
  
    .links {
      width: 100%;
      flex-direction: column;
      align-items: center;
      gap: 4px;
      font-size: 18px;
    }
  
    .links a {
      border-right: none !important;
      padding-right: 0 !important;
    }
  
    .social-icons {
      width: 100%;
      justify-content: center;
      display: flex; 
    }
  
    .social-icons .social-icon-link {
      margin-right: 12px; 
    }
  
    .social-icons .social-icon-link:last-child {
      margin-right: 0;
    }
  
    .social-icons img {
      width: 32px;
      height: 32px;
    }
  }
  
  
  @media (min-width: 600px) and (max-width: 1269px) {
    .copyright {
      text-align: left;
      font-size: 22px;
    }
  
    .links {
      gap: 8px;
      font-size: 22px;
    }
  
    .links a {
      padding-right: 8px !important;
    }
  
    .social-icons {
      justify-content: flex-end;
      display: flex; 
    }
  
    .social-icons .social-icon-link {
      margin-right: 8px; 
    }
  
    .social-icons .social-icon-link:last-child {
      margin-right: 0;
    }
  
    .social-icons img {
      width: 36px;
      height: 36px;
    }
  }
  
  
  @media (min-width: 1270px) {
    .social-icons {
      width: 220px;
      justify-content: flex-end;
      display: flex; 
    }
  
    .social-icons .social-icon-link {
      margin-right: 6px; 
    }
  
    .social-icons .social-icon-link:last-child {
      margin-right: 0;
    }
  }
  </style>