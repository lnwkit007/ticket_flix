<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';

// import stores
import { useAuthStore } from '../../stores/auth/authStore';

// import components
import LoadingState from '../../components/LoadingState.vue';

const email = ref<string>('');
const password = ref<string>('');

const authStore = useAuthStore();
const router = useRouter();

const handleLogin = async () => {
    try {
        await authStore.login(email.value, password.value);
        await router.push("/");
    } catch (err: any) {
        console.log("Login failed:", err);
    }
}
</script>

<template>
    <section class="w-full bg-white py-4 border border-red-500 h-[70vh]">
        <div class="mx-auto w-full px-5 md:px-4 xl:w-302.5 border border-blue-500 h-full flex justify-center items-center">
            <div class="border border-green-500 flex flex-col items-center p-7">
                <h1 class="text-xl font-bold text-[#333333] sm:text-2xl md:text-[28px] my-3">เข้าสู่ระบบ</h1>
                <form @submit.prevent="handleLogin" class="flex flex-col gap-2">
                    <div class="flex flex-col">
                        <label for="email-address" class="text-[#333333] font-semibold">Email</label>
                        <input id="email-address" type="email" v-model="email" name="email" required
                            placeholder="example@gmail.com" class="border">
                    </div>

                    <div class="flex flex-col">
                        <label for="password" class="text-[#333333] font-semibold">Password</label>
                        <input id="password" type="password" v-model="password" name="password" required class="border">
                    </div>

                    <button type="submit" :disabled="authStore.isAuthLoading" class="rounded-full bg-linear-to-r from-[#b40000] to-[#f00000] px-4 py-1.5">
                        <LoadingState v-if="authStore.isAuthLoading" />
                        <p v-else class="text-base font-semibold text-white">เข้าสู่ระบบ</p>
                    </button>
                </form>
            </div>
        </div>
    </section>
</template>