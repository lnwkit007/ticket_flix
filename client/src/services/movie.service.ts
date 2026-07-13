import api from "./api";
import type { moviesApiResponse } from "../types/movie";

export const movieService = {
    getAllMovie: async (page: number | null): Promise<moviesApiResponse> => {
        const res = await api.get<moviesApiResponse>(`/movies?page=${page}`);
        return res.data;
    },

    getMovieById: async (id: number): Promise<moviesApiResponse> => {
        const res = await api.get<moviesApiResponse>(`/movies/${id}`);
        return res.data;
    },

    getAllConcert: async (page: number | null): Promise<moviesApiResponse> => {
        const res = await api.get<moviesApiResponse>(`/concerts?page=${page}`);
        return res.data;
    },

    getConcertById: async (id: number): Promise<moviesApiResponse> => {
        const res = await api.get<moviesApiResponse>(`/concerts/${id}`);
        return res.data;
    },
}