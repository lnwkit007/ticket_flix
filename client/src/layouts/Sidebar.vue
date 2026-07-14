<script setup lang="ts">
import { watch } from "vue";
import { RouterLink } from "vue-router";

// import Store
import { useOpenSidebarStore } from "../stores/openSidebarStore";
const SidebarStore = useOpenSidebarStore();

const hiddenSidebar = () => {
  SidebarStore.SwitchSidebar();
};

watch(
  () => SidebarStore.isOpenSidebar,
  (isOpen) => {
    if (isOpen) {
      document.body.classList.add("overflow-y-hidden");
    } else {
      document.body.classList.remove("overflow-y-hidden");
    }
  },
);
</script>

<template>
  <aside
    :class="[
      'fixed top-0 z-2001 h-screen w-full bg-white md:hidden',
      'transition-transform duration-300 ease-in-out',
      SidebarStore.isOpenSidebar ? 'translate-x-0' : '-translate-x-full',
    ]"
  >
    <div class="flex justify-between border-b border-[#e5e7eb] sm:px-4">
      <div class="p-4">
        <img
          src="/images/logo/logo-ttm-tm-test.png"
          alt="logo nongbualamphu"
          class="w-30"
        />
      </div>

      <button class="flex items-center px-4 py-3" @click="hiddenSidebar">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="lucide lucide-x-icon lucide-x"
        >
          <path d="M18 6 6 18" />
          <path d="m6 6 12 12" />
        </svg>
      </button>
    </div>

    <div>
      <!-- ////////// Button Login ////////// -->
      <RouterLink
        to="/"
        class="group flex justify-between border-b border-[#e5e7eb] px-4 py-5 sm:px-8"
      >
        <span class="flex">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            color="#DE1000"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="lucide lucide-user-icon lucide-user"
          >
            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
            <circle cx="12" cy="7" r="4" />
          </svg>

          <p
            class="px-4 text-base font-semibold text-[#333333] transition duration-200 group-hover:text-[#DE1000]"
          >
            เข้าสู่ระบบ / สมัครสมาชิก
          </p>
        </span>

        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          color="#B3B3B3"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="lucide lucide-chevron-right-icon lucide-chevron-right"
        >
          <path d="m9 18 6-6-6-6" />
        </svg>
      </RouterLink>

      <!-- ////////// Button Home ////////// -->
      <RouterLink
        to="/"
        class="group flex justify-between border-b border-[#e5e7eb] px-4 py-5 sm:px-8"
      >
        <span class="flex">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            color="#DE1000"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="lucide lucide-house-icon lucide-house"
          >
            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
            <path
              d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
            />
          </svg>

          <p
            class="px-4 text-base font-semibold text-[#333333] transition duration-200 group-hover:text-[#DE1000]"
          >
            หน้าแรก
          </p>
        </span>

        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          color="#B3B3B3"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="lucide lucide-chevron-right-icon lucide-chevron-right"
        >
          <path d="m9 18 6-6-6-6" />
        </svg>
      </RouterLink>

      <!-- ////////// Button Movies ////////// -->
      <RouterLink
        to="/movies"
        class="group flex justify-between border-b border-[#e5e7eb] px-4 py-5 sm:px-8"
      >
        <span class="flex">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            color="#DE1000"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="lucide lucide-film-icon lucide-film"
          >
            <rect width="18" height="18" x="3" y="3" rx="2" />
            <path d="M7 3v18" />
            <path d="M3 7.5h4" />
            <path d="M3 12h18" />
            <path d="M3 16.5h4" />
            <path d="M17 3v18" />
            <path d="M17 7.5h4" />
            <path d="M17 16.5h4" />
          </svg>

          <p
            class="px-4 text-base font-semibold text-[#333333] transition duration-200 group-hover:text-[#DE1000]"
          >
            ภาพยนตร์
          </p>
        </span>

        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          color="#B3B3B3"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="lucide lucide-chevron-right-icon lucide-chevron-right"
        >
          <path d="m9 18 6-6-6-6" />
        </svg>
      </RouterLink>

      <!-- ////////// Button Concerts ////////// -->
      <RouterLink
        to="/concert"
        class="group flex justify-between border-b border-[#e5e7eb] px-4 py-5 sm:px-8"
      >
        <span class="flex">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            color="#DE1000"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="lucide lucide-spotlight-icon lucide-spotlight"
          >
            <path d="M15.295 19.562 16 22" />
            <path d="m17 16 3.758 2.098" />
            <path d="m19 12.5 3.026-.598" />
            <path
              d="M7.61 6.3a3 3 0 0 0-3.92 1.3l-1.38 2.79a3 3 0 0 0 1.3 3.91l6.89 3.597a1 1 0 0 0 1.342-.447l3.106-6.211a1 1 0 0 0-.447-1.341z"
            />
            <path d="M8 9V2" />
          </svg>

          <p
            class="px-4 text-base font-semibold text-[#333333] transition duration-200 group-hover:text-[#DE1000]"
          >
            คอนเสิร์ต
          </p>
        </span>

        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          color="#B3B3B3"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="lucide lucide-chevron-right-icon lucide-chevron-right"
        >
          <path d="m9 18 6-6-6-6" />
        </svg>
      </RouterLink>
    </div>
  </aside>
</template>
