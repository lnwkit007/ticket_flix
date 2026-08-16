import { defineStore } from "pinia";
import { ref } from "vue";

export const useOpenSidebarStore = defineStore('openSidebar', () => {
    const isOpenSidebar = ref<boolean>(false);

    const SwitchSidebar = () => {
        isOpenSidebar.value = !isOpenSidebar.value;
    }

    return { isOpenSidebar, SwitchSidebar };
});