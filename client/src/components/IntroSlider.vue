<script setup lang="ts">
import { RouterLink } from "vue-router";

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from "swiper/vue";

// Import Swiper styles
import "swiper/css";
import "swiper/css/pagination";
import "swiper/css/autoplay";

// import required modules
import { Pagination, Autoplay } from "swiper/modules";

const ImagesBanners = [
  {
    name: "Banner1",
    src: "/images/banner/highlight_ttmevent_3866-69e042315de3b.jpg",
  },
  {
    name: "Banner2",
    src: "/images/banner/highlight_ttmevent_3958-6a2a7ddd3d2e5.png",
  },
  {
    name: "Banner3",
    src: "/images/banner/highlight_ttmevent_3960-6a2a82d09e756.png",
  },
  {
    name: "Banner4",
    src: "/images/banner/highlight_ttmevent_3976-6a323be714d53.png",
  },
  {
    name: "Banner5",
    src: "/images/banner/highlight_ttmevent_3978-6a3e1e65e2940.png",
  },
];
</script>

<template>
  <section class="bg-[url(/images/background/bg_blur-black.jpg)] bg-top">
    <div class="flex justify-center py-4">
      <div class="w-full max-w-217.5">
        <swiper
          :pagination="true"
          :autoplay="{
            delay: 2000,
            disableOnInteraction: false,
          }"
          :modules="[Pagination, Autoplay]"
          class="mySwiper"
        >
          <swiper-slide v-for="ImagesBanner in ImagesBanners" :key="ImagesBanner.name">
            <RouterLink to="/">
              <img
                :src="ImagesBanner.src"
                :alt="ImagesBanner.name"
                class="h-full w-full object-cover object-center"
              />
            </RouterLink>
          </swiper-slide>
        </swiper>
      </div>
    </div>
  </section>
</template>

<style scoped>
.mySwiper {
  --swiper-pagination-color: #de0000;

  --swiper-pagination-bullet-inactive-color: #ffffff;
  --swiper-pagination-bullet-inactive-opacity: 0.5;
}
</style>
