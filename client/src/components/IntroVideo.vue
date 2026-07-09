<script setup lang="ts">
const props = defineProps<{
  namepage: string;
  src: string;
  poster: string;
}>();
</script>

<template>
  <section
    class="bg-[url(/images/background/bg_blur-gradient.jpg)] bg-top"
  >
    <!-- ////////// Path ////////// -->
    <nav class="flex justify-center py-4">
      <div class="flex w-full max-w-302.5 items-center gap-2 px-4 text-sm">
        <RouterLink to="/" class="text-[#5E6060] hover:text-[#999999]">
          หน้าแรก
        </RouterLink>

        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="12"
          height="12"
          viewBox="0 0 24 24"
          fill="none"
          color="#999999"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="lucide lucide-chevron-right-icon lucide-chevron-right"
        >
          <path d="m9 18 6-6-6-6" />
        </svg>

        <p class="text-[#999999]">{{ namepage }}</p>
      </div>
    </nav>

    <!-- ////////// Container Video ////////// -->
    <div class="flex justify-center py-4">
      <section class="w-full max-w-217.5">
        <media-player :src="src" view-type="video" autoplay muted>
          <media-provider>
            <media-poster
              :src="poster"
              alt="Video Poster"
              class="vds-poster bg-black/50 object-contain!"
            ></media-poster>
          </media-provider>
          <media-video-layout></media-video-layout>
        </media-player>
      </section>
    </div>
  </section>
</template>
