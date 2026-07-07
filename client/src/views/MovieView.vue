<script setup lang="ts">
import { onMounted } from "vue";
import { storeToRefs } from "pinia";

// import components
import IntroVideo from "../components/IntroVideo.vue";
import EventGrid from "../components/EventGrid.vue";
import Loading from "../components/Loading.vue";
import PaginationButton from "../components/PaginationButton.vue";

// import stores
import { useMovieStore } from "../stores/movieStore.ts";
const movieStore = useMovieStore();

const { movies, isLoading, pagination } = storeToRefs(movieStore);

onMounted(() => {
  movieStore.loadMovies();
});
</script>

<template>
  <IntroVideo
    namepage="ภาพยนตร์"
    src="https://www.youtube.com/watch?v=owig3ZmkjGs"
  />

  <section class="w-full bg-white py-4">
    <div class="mx-auto w-full px-5 md:px-4 xl:w-302.5">
      <div v-if="isLoading" class="flex h-[50vh] items-center justify-center">
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

        <EventGrid :movies="movies" />

        <!-- ////////// Container Pagination ////////// -->
        <PaginationButton
          :pagination="pagination"
          @link-page="movieStore.loadMovies"
        />
      </div>
    </div>
  </section>
</template>
