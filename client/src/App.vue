<script setup lang="ts">
import { onMounted } from "vue";
import { RouterView } from "vue-router";

// import layouts
import Navbar from "./layouts/Navbar.vue";
import Banner from "./layouts/Banner.vue";
import Footer from "./layouts/Footer.vue";
import Sidebar from "./layouts/Sidebar.vue";

// import store
import { useAuthStore } from "./stores/auth/authStore.ts";
const authStore = useAuthStore();


onMounted(async () => {
  const isLoggedIn = localStorage.getItem('isLoggedIn');

  if (isLoggedIn === 'true') {
    try {
      await authStore.checkAuth();
    } catch (err: any) {
      console.log('User is not logged in yet.');
      localStorage.removeItem('isLoggedIn');
    }
  }
});
</script>

<template>
  <Navbar />

  <Sidebar />

  <main class="min-h-screen">
    <Banner />

    <RouterView />
  </main>

  <Footer />
</template>
