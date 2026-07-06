import { defineStore } from "pinia";
import { ref } from "vue";
import type { movie, moviesApiResponse } from "../types/movie";
import { movieService } from "../api/movie.service";

export const useMovieStore = defineStore('movie', () => {

    const movies = ref<movie[]>([]);
    const isLoading = ref<boolean>(false);

    const loadMovies = async () => {
        isLoading.value = true;

        try {
            const res = await movieService.getAllMovie();
            movies.value = res.data;
        } catch (err) {
            console.error('Loading Movies Error : ', err);
        } finally {
            isLoading.value = false;
        }
    }

    return {
        movies,
        isLoading,
        loadMovies
    }
});