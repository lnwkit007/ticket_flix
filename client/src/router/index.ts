import { createRouter, createWebHistory } from "vue-router";

// import view
import HomeView from "../views/HomeView.vue";
import MovieView from "../views/MovieView.vue";
import ConcertView from "../views/ConcertView.vue";

const router = createRouter({
    history: createWebHistory(),
    scrollBehavior(to, from, savedPosition) {
        return { top: 0 }
    },
    routes: [
        {
            path: '/',
            component: HomeView,
        },
        {
            path: '/movies',
            component: MovieView,
        },
        {
            path: '/concert',
            component: ConcertView,
        },
    ]
});

export default router;