<script setup lang="ts">
interface paginationState {
  current_page: number;
  last_page: number;
  links: pageLink[];
}

interface pageLink {
  url: string | null;
  label: string;
  page: number | null;
  active: boolean;
}

const props = defineProps<{
  pagination: paginationState;
}>();

const emit = defineEmits<{
  (e: "linkPage", page: number | null): void;
}>();
</script>

<template>
  <div class="mt-7.5 mb-3 flex justify-center gap-1">
    <button
      v-for="(link, index) in pagination.links"
      :key="index"
      :disabled="!link.url || link.active"
      :class="[
        'rounded-full border px-4 py-2 text-sm font-semibold',
        link.active
          ? 'border-transparent bg-linear-to-r from-[#b40000] to-[#f00000] text-white'
          : 'border-gray-300 bg-white text-[#333333] hover:bg-gray-50',
        !link.url || link.active
          ? 'cursor-not-allowed opacity-50'
          : 'cursor-pointer',
      ]"
      @click="emit('linkPage', link.page)"
      v-html="link.label"
    ></button>
  </div>
</template>
