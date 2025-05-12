<!-- 課程介紹頁 -->
<script setup>
import CardButton from '@/components/CardButton.vue';
import CartButton from '@/components/CartButton.vue';
import play from '@/images/f-play.png';
import lock from '@/images/f-lock.png';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';

// 引入展開卡片 - 影片卡片
import ExpandCard from '@/components/ExpandCard.vue';

// 判斷是否購買了，假資料：實際上會由後端提供
// const hasPurchased = false;
// 按鈕點擊功能 CardButton
function handleClick(item) {
  if (!hasPurchased) return; // 沒買就直接什麼都不做！
  // console.log('✅ 播放影片：', item.name); // 有買，才執行下面功能
}
// ========

const props = defineProps({
  course: Array | Object,
  isAccessible: Boolean,
});

const hasPurchased = computed(() => props.isAccessible);
</script>

<template>
  <Header />

  <div class="bg-softGray">
    <!-- header -->
    <header class="flex h-[234px] flex-col items-center bg-black sm:h-[323px] xl:h-[444px]">
      <!-- 課程名稱 -->
      <p
        class="pt-[120px] font-serif text-[32px]/[46px] font-bold text-grayWhite sm:pt-[160px] sm:text-[52px]/[75px] xl:pt-[224px] xl:text-[64px]/[92px]"
      >
        {{ course.name }}
      </p>
      <span class="mb-[60px] w-[120px] border-b-2 border-grayWhite sm:mb-[80px] sm:w-[300px] xl:mb-[120px]"></span>
    </header>
    <main class="h-auto px-[24px] xl:m-auto xl:w-[997px]">
      <div v-if="!hasPurchased" class="flex flex-col items-end">
        <!-- 價錢 -->
        <p
          class="mb-[12px] mt-[30px] text-[20px]/[26.6px] font-bold text-blueGreen sm:mb-[16px] sm:mt-[60px] sm:text-[28px]/[37px] xl:mb-[12px] xl:text-[32px]/[43px]"
        >
          NT$ {{ course.price }}
        </p>
        <!-- 加入購物車案紐 -->
        <!-- <CartButton 
          :hideText="false" 
          :cartShorter="false" 
          class="h-[32px] w-[120px]" /> -->

        <CartButton
          :hideText="false"
          :cartShorter="false"
          :productId="course.id"
          :productName="course.name"
          :price="course.price"
          :productType="2"
          class="h-[32px] w-[120px]"
        />
      </div>
      <p class="mb-[24px] mt-[32px] text-[20px]/[26.6px] font-bold text-blueGreen sm:my-[24px] sm:text-[36px]/[44px]">課程介紹:</p>
      <!-- 課程介紹 -->
      <p class="text-[16px] text-black sm:text-[24px]">
        {{ course.detail }}
      </p>
      <p v-if="!hasPurchased" class="mb-[20px] mt-[30px] text-[16px]/[28px] font-bold text-blueGreen sm:mb-[24px] sm:mt-[40px] sm:text-[24px]/[32px]">
        付費課程，將於購買後解鎖。
      </p>
      <!-- 課程列表 -->
      <!-- 傳入插槽 ExpandCard.vue 並傳入插槽中的插槽CardBtn-->
      <ExpandCard v-for="item in course.chapters" :key="item.id" :name="item.name" :introduction="item.introduction">
        <!-- 傳入插槽 CardButton 插槽放 -->
        <div @click="handleClick(item)" class="rounded-full" :class="hasPurchased ? 'bg-blueGreen' : 'bg-darkGray'">
          <CardButton :hideText="false" :cartShorter="false" :isUnlocked="hasPurchased">
            <!-- 按鈕icon -->
            <template #icon>
              <!-- 播放 -->
              <img v-if="hasPurchased" :src="play" alt="play" class="mr-3 h-[16px] w-[16px] sm:mr-4 sm:h-[24px] sm:w-[24px]" />

              <img v-if="!hasPurchased" :src="lock" alt="lock" class="mr-3 h-[16px] w-[16px] sm:mr-4 sm:h-[24px] sm:w-[24px]" />
            </template>
          </CardButton>
        </div>
      </ExpandCard>
    </main>
    <Footer class="mt-[80px]" />
  </div>
</template>
