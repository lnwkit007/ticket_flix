<script setup lang="ts">
import { RouterView } from "vue-router";

// import layouts
import Navbar from "./layouts/Navbar.vue";
import Banner from "./layouts/Banner.vue";
import Footer from "./layouts/Footer.vue";
import Sidebar from "./layouts/Sidebar.vue";
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
