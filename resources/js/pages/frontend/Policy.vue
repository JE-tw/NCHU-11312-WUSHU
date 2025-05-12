<script>
import Header from '@/components/Header.vue';
import Footer from '@/components/Footer.vue';
</script>

<!-- 款與退款政策頁 -->
<template>
  <Header />

  <div class="bg-softGray">
    <!-- header -->
    <header class="flex h-[234px] flex-col items-center bg-black sm:h-[303px] xl:h-[444px]">
      <p
        class="pt-[120px] font-serif text-[32px]/[46px] font-bold text-grayWhite sm:pt-[160px] sm:text-[52px]/[75px] xl:pt-[224px] xl:text-[64px]/[92px]"
      >
        付款與退款政策
      </p>
      <span class="w-[120px] border-b-2 border-grayWhite sm:w-[300px]"></span>
    </header>
    <main class="px-[24px] font-['Microsoft_JhengHei'] sm:px-[48px]">
      <div class="mx-auto mb-[60px] mt-[30px] max-w-5xl">
        <div class="mx-auto mb-2 mt-3 max-w-5xl px-4 text-left">
          <p class="md:text-4xl my-4 font-['Microsoft_JhengHei'] text-[32px] font-bold text-deepTeal sm:text-[36px]">付款政策：</p>
          <ul
            class="md:text-[24px] md:leading-[55px] space-y-6 text-left font-['Microsoft_JhengHei'] text-[20px] font-medium leading-[36px] tracking-[0.02em] text-black sm:text-[22px] sm:leading-[44px]"
          >
            <li>1. 所有課程及服務費用均以新台幣計算。</li>
            <li>2. 最終售價將以下單時的顯示為準。</li>
            <li>3. 我們接受匯款、線上轉帳的方式付款，會在下單後提供您匯款帳戶。</li>
            <li>
              4.
              下單課程並匯款之後，我們會在24小時內核對訂單和款項，確認無誤後會開啟權限。若金額有誤或其他狀況，會寄Email聯繫。若24小時後，課程權限未開啟也未收到我們的Email，請聯繫我們，謝謝。
            </li>
            <li>5. 下單服務後，我們會在24小時內聯繫您，並和您確認服務細節和費用，確認收到款項後才算是完成預約。</li>
            <li>6. 對有關銀行於處理交易時所發生的故障而導致之損失，本網站將不承擔任何責任。</li>
          </ul>
        </div>
        <div class="mx-auto mb-2 mt-3 max-w-5xl px-4 text-left">
          <p class="md:text-4xl my-4 font-['Microsoft_JhengHei'] text-[32px] font-bold text-deepTeal sm:text-[36px]">退款政策：</p>
          <ul
            class="md:text-[24px] md:leading-[55px] space-y-6 text-left font-['Microsoft_JhengHei'] text-[20px] font-medium leading-[36px] tracking-[0.02em] text-black sm:text-[22px] sm:leading-[44px]"
          >
            <li>
              1. 實體或線上直播課程，於開課日前申請退款，將全額退還該課程您所支付之金額；開課日後，則不接受退款申請，該課程您所支付之金額將不予退還。
            </li>
            <li>2. 錄影課程、商品和服務恕無法辦理退款。</li>
            <li>3. 我們將以轉帳方式進行退款，請提供正確的匯款帳號，以利完成退款手續。款項將會在7個工作天內退還至您提供的帳戶。</li>
          </ul>
        </div>
      </div>
    </main>
    <Footer />
  </div>
</template>
