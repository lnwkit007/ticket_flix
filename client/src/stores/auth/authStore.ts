import { defineStore } from "pinia";
import { ref, computed } from "vue";
import { loginAuth, auth, logoutAuth } from "../../services/auth/auth.service";

interface User {
    id: number;
    role: string;
    user_email: string;
    user_name: string;
}

export const useAuthStore = defineStore('auth', () => {
    const user = ref<User | null>(null);
    const isAuthLoading = ref<boolean>(false);
    const errorMsg = ref<string | null>(null);

    const isAuthenticated = computed(() => !!user.value);

    const checkAuth = async () => {
        isAuthLoading.value = true;
        try {
            const res = await auth();
            if (res.data.data) {
                user.value = res.data.data;
                errorMsg.value = null;
            }
        } catch (err: any) {
            user.value = null;
            isAuthLoading.value = false;
            errorMsg.value = err.response?.data?.message || err.message;
            throw err;
        } finally {
            isAuthLoading.value = false;
        }
    };

    const login = async (email: string, password: string) => {
        isAuthLoading.value = true;
        try {
            await loginAuth(email, password);
            await checkAuth();
            localStorage.setItem('isLoggedIn', 'true');
        } catch (err: any) {
            isAuthLoading.value = false;
            errorMsg.value = err.response?.data?.message || err.message;
            throw err;
        } finally {
            isAuthLoading.value = false;
        }
    };

    const logout = async () => {
        isAuthLoading.value = true;
        try {
            await logoutAuth();
            user.value = null;
            errorMsg.value = null;
            localStorage.removeItem('isLoggedIn');
        } catch (err: any) {
            isAuthLoading.value = false;
            errorMsg.value = err.response?.data?.message || err.message;
            throw err;
        } finally {
            isAuthLoading.value = false;
        }
    };

    return {
        user,
        isAuthLoading,
        errorMsg,
        isAuthenticated,
        checkAuth,
        login,
        logout
    };
});