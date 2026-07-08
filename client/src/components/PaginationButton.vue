<script setup lang="ts">
import { computed } from "vue";

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

const displayedLinks = computed(() => {
  const links = props.pagination.links;
  if (links.length <= 0) return [];

  const currentPage = props.pagination.current_page;
  const lastPage = props.pagination.last_page;

  const previousButton = links[0];
  const nextButton = links[links.length - 1];

  const pagesToShow = new Set<number>();
  pagesToShow.add(1);
  pagesToShow.add(lastPage);
  if (currentPage > 1) pagesToShow.add(currentPage - 1);
  pagesToShow.add(currentPage);
  if (currentPage < lastPage) pagesToShow.add(currentPage + 1);

  const sortedPages = Array.from(pagesToShow).sort((a, b) => a - b);

  const result: (pageLink & { isEllipsis?: boolean })[] = [];

  result.push(previousButton);

  for (let i = 0; i < sortedPages.length; i++) {
    const pageNum = sortedPages[i];

    const originalLink = links.find(
      (l, idx) => l.page === pageNum && idx !== 0 && idx !== links.length - 1,
    );

    if (i > 0) {
      const prevPageNum = sortedPages[i - 1];
      if (pageNum - prevPageNum > 1) {
        result.push({
          url: null,
          label: "...",
          page: null,
          active: false,
          isEllipsis: true,
        });
      }
    }

    if (originalLink) {
      result.push(originalLink);
    }
  }

  result.push(nextButton);

  return result;
});

const cleanLabel = (label: string) => {
  if (label.includes("Previous")) {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left-icon lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg> <span class="ml-1 mr-1.5">ก่อนหน้า</span>';
  }
  if (label.includes("Next")) {
    return '<span class="mr-1 ml-1.5">ถัดไป</span> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right-icon lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>';
  }
  return label;
};
</script>

<template>
  <div
    class="mt-7.5 mb-3 flex flex-wrap items-center justify-center gap-1 sm:gap-1.5"
  >
    <button
      v-for="(link, index) in displayedLinks"
      :key="index"
      :disabled="(!link.url && !link.isEllipsis) || link.active"
      :class="[
        'flex h-8 min-w-8 items-center justify-center rounded-full border px-2 text-xs font-semibold transition-all duration-200 select-none sm:h-10 sm:min-w-10 sm:px-4 sm:text-sm',
        '[&_span]:hidden sm:[&_span]:inline',

        link.active
          ? 'border-transparent bg-linear-to-r from-[#b40000] to-[#f00000] text-white'
          : link.isEllipsis
            ? 'min-w-4 cursor-default border-transparent bg-transparent px-0 text-gray-400'
            : 'cursor-pointer border-gray-300 bg-white text-[#333333] hover:bg-gray-50',
        (!link.url && !link.isEllipsis) || link.active
          ? 'cursor-not-allowed opacity-50 [&_div]:cursor-not-allowed'
          : '',
      ]"
      @click="!link.isEllipsis && emit('linkPage', link.page)"
      v-html="cleanLabel(link.label)"
    ></button>
  </div>
</template>
