<script setup lang="ts">
import { onMounted } from "vue";
import { storeToRefs } from "pinia";

// import stores
import { useMovieStore } from "../stores/movie";
const movieStore = useMovieStore();

const { movies, isLoading } = storeToRefs(movieStore);

onMounted(() => {
  movieStore.loadMovies();
});
</script>

<template>
    <p v-if="isLoading">กำลังโหลด ...</p>

    <div v-else>
        <div v-for="movie in movies">
            <img :src="movie.movie_poster" :alt="movie.movie_title">
            <p>{{ movie.movie_title }}</p>
        </div>
    </div>
</template>
