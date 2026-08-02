import api from "./api";

export const authService = {
    getCSRF: async () => {
        const res = await api.get(`/sanctum/csrf-cookie`);
        console.log(res);
    }
}