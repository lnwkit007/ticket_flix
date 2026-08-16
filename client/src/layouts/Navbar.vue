<script setup lang="ts">
import { RouterLink } from "vue-router";
import { useRouter } from "vue-router";

// import components
import LoadingState from "../components/LoadingState.vue";

// import store
import { useOpenSidebarStore } from "../stores/sidebar/openSidebarStore";
import { useAuthStore } from "../stores/auth/authStore";

const SidebarStore = useOpenSidebarStore();
const authStore = useAuthStore();
const router = useRouter();

const openSidebar = () => {
  SidebarStore.SwitchSidebar();
};

const logout = async () => {
  try {
    await authStore.logout();
    router.push("/");
  } catch (err: any) {
    console.log("Logout failed:", err);
  }
}
</script>

<template>
  <nav
    class="sticky top-0 z-200 w-full border-t-[3.5px] border-[#DE0000] bg-white shadow-[0_1px_3px_rgba(0_0_0/_0.15)]">
    <!-- ////////// Container Layout //////////// -->
    <div class="mx-auto flex w-full items-center justify-between px-4 md:px-8 xl:w-302.5 xl:px-0">
      <!-- ////////// Container Menu Mobile ////////// -->
      <div class="md:hidden" @click="openSidebar">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-menu-icon lucide-menu text-[#B2B2B2]">
          <path d="M4 5h16" />
          <path d="M4 12h16" />
          <path d="M4 19h16" />
        </svg>
      </div>

      <!-- ////////// Container Logo And Menu Desktop ////////// -->
      <div class="flex items-center">
        <!-- ////////// Image Logo ////////// -->
        <RouterLink to="/" class="flex h-12 items-center justify-center md:h-auto">
          <img src="/images/logo/logo-ticket-flix.png" alt="logo" class="w-27 md:w-37" />
        </RouterLink>

        <!-- ////////// List Menu ////////// -->
        <ul class="hidden px-1.5 md:flex">
          <li class="px-3.5 py-7">
            <RouterLink to="/" class="text-base font-semibold text-[#333333] hover:text-[#DE0000]">
              หน้าแรก
            </RouterLink>
          </li>

          <li class="px-3.5 py-7">
            <RouterLink to="/movies" class="text-base font-semibold text-[#333333] hover:text-[#DE0000]">
              ภาพยนตร์
            </RouterLink>
          </li>

          <li class="px-3.5 py-7">
            <RouterLink to="/concert" class="text-base font-semibold text-[#333333] hover:text-[#DE0000]">
              คอนเสิร์ต
            </RouterLink>
          </li>
        </ul>
      </div>

      <!-- ////////// Container Button Search And Button Login Desktop ////////// -->
      <div class="flex items-center gap-3">
        <!-- ////////// Button Search ////////// -->
        <RouterLink to="/">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-search-icon lucide-search text-[#B2B2B2]">
            <path d="m21 21-4.34-4.34" />
            <circle cx="11" cy="11" r="8" />
          </svg>
        </RouterLink>

        

        <div class="hidden md:flex">
          <div v-if="authStore.isAuthLoading">
            <LoadingState />
          </div>

          <div v-else>
            <!-- ////////// Button Login ////////// -->
            <RouterLink v-if="!authStore.isAuthenticated" to="/login" class="hidden md:block">
              <div class="rounded-full bg-linear-to-r from-[#b40000] to-[#f00000] px-4 py-1.5">
                <p class="text-base font-semibold text-white">เข้าสู่ระบบ</p>
              </div>
            </RouterLink>

             <!-- ////////// User Profile & Button Logout ////////// -->
            <div v-else class="flex gap-3">
              <p class="text-[#333333] font-semibold max-w-20 truncate">{{ authStore.user?.user_name }}</p>

              <button @click="logout()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide lucide-log-out-icon lucide-log-out text-[#B2B2B2]">
                  <path d="m16 17 5-5-5-5" />
                  <path d="M21 12H9" />
                  <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>
