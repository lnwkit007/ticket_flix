import axios from "axios";

const api = axios.create({
    baseURL: `${import.meta.env.VITE_API_PATH}`,
    withCredentials: true,
    withXSRFToken: true,
    headers: { "Content-Type": "application/json" },
});

export default api;
