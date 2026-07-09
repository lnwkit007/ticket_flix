<script setup lang="ts">
import { onMounted } from "vue";
import { storeToRefs } from "pinia";

// import components
import IntroSlider from "../components/IntroSlider.vue";

// import stores
import { useMovieStore } from "../stores/movieStore";
const movieStore = useMovieStore();

const { movies, isLoading } = storeToRefs(movieStore);

onMounted(() => {
  movieStore.loadMovies();
});
</script>

<template>
  <IntroSlider />

  <div class="flex flex-col gap-2">
    <div v-for="movie in movies" class="border border-red-500">
      <img :src="movie.movie_poster" :alt="movie.movie_title" />
      <p>{{ movie.movie_title }}</p>
      <p v-for="tag in movie.tags">
        {{ tag.movie_tag_name }}
      </p>
      <p>{{ movie.movie_synopsis }}</p>
    </div>
  </div>
</template>
