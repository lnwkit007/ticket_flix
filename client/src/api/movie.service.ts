import api from "./api";
import type { movie, moviesApiResponse } from "../types/movie";

export const movieService = {
    getAllMovie: async (): Promise<moviesApiResponse> => {
        const res = await api.get<moviesApiResponse>('/movies');
        return res.data;
    },

    getMovieById: async(id: number): Promise<moviesApiResponse> => {
        const res = await api.get<moviesApiResponse>(`/movie/${id}`);
        return res.data;
    }
}