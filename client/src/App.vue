<script setup lang="ts">
import { RouterView } from "vue-router";

// import layouts
import Navbar from "./layouts/Navbar.vue";
</script>

<template>
  <Navbar />
  
  <main class="min-h-screen pt-15 sm:pt-17 md:pt-21.25">
    <RouterView />
  </main>
</template>
