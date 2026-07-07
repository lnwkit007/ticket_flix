<script setup lang="ts">
import { RouterView } from "vue-router";

// import layouts
import Navbar from "./layouts/Navbar.vue";
import Banner from "./layouts/Banner.vue";
</script>

<template>
  <Navbar />
  
  <main class="min-h-screen">
    <Banner />

    <RouterView />
  </main>
</template>
