<script setup lang="ts">
import { RouterLink } from "vue-router";

import type { movie } from "../types/movie";

const props = defineProps<{
  movies: movie[];
}>();
</script>

<template>
  <div
    class="grid grid-cols-3 gap-x-3 gap-y-5 md:grid-cols-4 md:gap-x-7 lg:grid-cols-6"
  >
    <RouterLink
      v-for="movie in movies"
      :key="movie.id"
      to="/"
      class="group flex cursor-pointer flex-col justify-between pb-2"
    >
      <div class="mb-4 flex flex-col">
        <img
          :src="movie.movie_poster"
          :alt="movie.movie_title"
          loading="lazy"
          class="transition-transfrom mb-4 rounded-md duration-200 group-hover:scale-105"
        />
        <p
          class="line-clamp-3 px-1.5 text-sm/4 font-semibold text-[#333333] group-hover:text-[#DE0000]"
        >
          {{ movie.movie_title }}
        </p>
      </div>

      <RouterLink to="/">
        <div
          class="rounded-full bg-linear-to-r from-[#b40000] to-[#f00000] px-4 py-1.5 text-center"
        >
          <p class="text-xs font-semibold text-white md:text-sm lg:text-base">
            ซื้อบัตร
          </p>
        </div>
      </RouterLink>
    </RouterLink>
  </div>
</template>
