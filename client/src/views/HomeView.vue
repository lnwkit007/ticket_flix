<script setup lang="ts">
import { onMounted } from "vue";
import { storeToRefs } from "pinia";

// import components
import IntroSlider from "../components/IntroSlider.vue";
import EventGrid from "../components/EventGrid.vue";
import Loading from "../components/Loading.vue";

// import stores
import { useMoviesStore } from "../stores/movie/movieStore.ts";
import { useConcertsStore } from "../stores/concert/concertStore.ts";

const movieStore = useMoviesStore();
const concertsStore = useConcertsStore();

const { movies, isLoadingMovies } = storeToRefs(movieStore);
const { concerts, isLoadingConcerts } = storeToRefs(concertsStore);

onMounted(async () => {
  await movieStore.loadMovies();
  await concertsStore.loadConcerts();
});

document.title =
  "ซื้อบัตร คอนเสิร์ต, ภาพยนตร์ ทั่วประเทศไทย - TicketFlix.130169.xyz : Ticket Flix";
</script>

<template>
  <IntroSlider />

  <!-- ////////// Content Movies ////////// -->
  <section class="w-full bg-white py-4">
    <div class="mx-auto w-full px-5 md:px-4 xl:w-302.5">
      <div v-if="isLoadingMovies" class="flex h-[50vh] items-center justify-center">
        <Loading />
      </div>

      <div v-else>
        <div class="mt-3 mb-7.5">
          <h1
            class="text-xl font-bold text-[#333333] sm:text-2xl md:text-[28px]"
          >
            ภาพยนตร์
          </h1>
        </div>

        <!-- ////////// Container Content ////////// -->
        <EventGrid :movies="movies" />

        <!-- ////////// Additional Button ////////// -->
        <div class="mt-5 mb-6 flex items-center justify-center">
          <RouterLink to="/movies">
            <div class="rounded-full bg-black px-6 py-2 text-center">
              <p class="text-xs text-white md:text-sm">ดูงานแสดงทั้งหมด</p>
            </div>
          </RouterLink>
        </div>
      </div>
    </div>
  </section>

  <!-- ////////// Container Banner ////////// -->
  <div
    class="flex justify-center bg-[url(/images/background/bg_gradient-red.jpg)] py-4"
  >
    <img
      src="https://tpc.googlesyndication.com/simgad/7367565023888542177"
      alt="banner image"
    />
  </div>

  <!-- ////////// Content Concert ////////// -->
  <section class="w-full bg-white py-4">
    <div class="mx-auto w-full px-5 md:px-4 xl:w-302.5">
      <div v-if="isLoadingConcerts" class="flex h-[50vh] items-center justify-center">
        <Loading />
      </div>

      <div v-else>
        <div class="mt-3 mb-7.5">
          <h1
            class="text-xl font-bold text-[#333333] sm:text-2xl md:text-[28px]"
          >
            คอนเสิร์ต
          </h1>
        </div>

        <!-- ////////// Container Content ////////// -->
        <EventGrid :movies="concerts" />

        <!-- ////////// Additional Button ////////// -->
        <div class="mt-5 mb-6 flex items-center justify-center">
          <RouterLink to="/concert">
            <div class="rounded-full bg-black px-6 py-2 text-center">
              <p class="text-xs text-white md:text-sm">ดูงานแสดงทั้งหมด</p>
            </div>
          </RouterLink>
        </div>
      </div>
    </div>
  </section>
</template>
