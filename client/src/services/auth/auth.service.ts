import api from "../api";

export const loginAuth = async (email: string, password: string) => {
    await api.get(`/sanctum/csrf-cookie`);
    await api.post(`/login`, {
        user_email: email,
        password: password
    });
}

export const auth = async () => {
    const res = await api.get(`/api/me`);
    return res;
}

export const logoutAuth = async () => {
    await api.post(`/logout`);
}
