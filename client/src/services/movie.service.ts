import api from "./api";
import type { moviesApiResponse } from "../types/movie";

export const movieService = {
    getAllMovie: async (page: number | null): Promise<moviesApiResponse> => {
        const res = await api.get<moviesApiResponse>(`/movies?page=${page}`);
        return res.data;
    },

    getMovieById: async (id: number): Promise<moviesApiResponse> => {
        const res = await api.get<moviesApiResponse>(`/movie/${id}`);
        return res.data;
    }
}