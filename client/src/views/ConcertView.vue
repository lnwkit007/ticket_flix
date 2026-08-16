<script setup lang="ts">
import { onMounted } from "vue";
import { storeToRefs } from "pinia";

// import components
import IntroVideo from "../components/IntroVideo.vue";
import EventGrid from "../components/EventGrid.vue";
import Loading from "../components/Loading.vue";
import PaginationButton from "../components/PaginationButton.vue";

// import stores
import { useConcertsStore } from "../stores/concert/concertStore.ts";
const concertsStore = useConcertsStore();

const { concerts, isLoadingConcerts, pagination } = storeToRefs(concertsStore);

onMounted(() => {
  concertsStore.loadConcerts();
});

document.title = "คอนเสิร์ต - TicketFlix.130169.xyz : Ticket Flix";
</script>

<template>
  <IntroVideo
    namepage="คอนเสิร์ต"
    src="https://www.youtube.com/watch?v=MCZhRCBRdME"
    poster="https://i.ytimg.com/vi/MCZhRCBRdME/hq720.jpg?sqp=-oaymwEnCNAFEJQDSFryq4qpAxkIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB&rs=AOn4CLDw_uoUeC6kthwKpbQAVL52iRowsQ"
  />

  <section class="w-full bg-white py-4">
    <div class="mx-auto w-full px-5 md:px-4 xl:w-302.5">
      <div v-if="isLoadingConcerts" class="flex h-[50vh] items-center justify-center">
        <Loading />
      </div>

      <div v-else>
        <div class="mt-3 mb-7.5">
          <h1
            class="text-xl font-bold text-[#333333] sm:text-2xl md:text-[28px]"
          >
            คอนเสิร์ต
          </h1>
        </div>

        <!-- ////////// Container Content ////////// -->
        <EventGrid :movies="concerts" />

        <!-- ////////// Container Pagination ////////// -->
        <PaginationButton
          :pagination="pagination"
          @link-page="concertsStore.loadConcerts"
        />
      </div>
    </div>
  </section>
</template>
