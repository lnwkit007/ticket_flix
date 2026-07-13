import { defineStore } from "pinia";
import { ref } from "vue";
import type { movie } from "../types/movie";
import { movieService } from "../services/movie.service";

export const useMoviesStore = defineStore('movies', () => {

    interface paginationState {
        current_page: number;
        last_page: number;
        links: pageLink[];
    }

    interface pageLink {
        url: string | null;
        label: string;
        page: number | null;
        active: boolean;
    }

    const pagination = ref<paginationState>({
        current_page: 1,
        last_page: 1,
        links: []
    });

    const movies = ref<movie[]>([]);
    const isLoadingMovies = ref<boolean>(false);

    const loadMovies = async (page: number | null = 1) => {
        isLoadingMovies.value = true;

        try {
            const res = await movieService.getAllMovie(page);

            if (res.status === 'success') {
                movies.value = res.data.data

                pagination.value = {
                    current_page: res.data.current_page,
                    last_page: res.data.last_page,
                    links: res.data.links
                }
                console.log(pagination.value);
            }
        } catch (err) {
            console.error('Loading Movies Error : ', err);
        } finally {
            isLoadingMovies.value = false;
        }
    }

    return {
        movies,
        isLoadingMovies,
        pagination,
        loadMovies
    }
});


export const useConcertsStore = defineStore('concerts', () => {

    interface paginationState {
        current_page: number;
        last_page: number;
        links: pageLink[];
    }

    interface pageLink {
        url: string | null;
        label: string;
        page: number | null;
        active: boolean;
    }

    const pagination = ref<paginationState>({
        current_page: 1,
        last_page: 1,
        links: []
    });

    const concerts = ref<movie[]>([]);
    const isLoadingConcerts = ref<boolean>(false);

    const loadConcerts = async (page: number | null = 1) => {
        isLoadingConcerts.value = true;

        try {
            const res = await movieService.getAllConcert(page);

            if (res.status === 'success') {
                concerts.value = res.data.data

                pagination.value = {
                    current_page: res.data.current_page,
                    last_page: res.data.last_page,
                    links: res.data.links
                }
                console.log(pagination.value);
            }
        } catch (err) {
            console.error('Loading Movies Error : ', err);
        } finally {
            isLoadingConcerts.value = false;
        }
    }

    return {
        concerts,
        isLoadingConcerts,
        pagination,
        loadConcerts
    }
});