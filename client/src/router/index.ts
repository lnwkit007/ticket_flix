import { createRouter, createWebHistory } from "vue-router";

// import view
import HomeView from "../views/HomeView.vue";
import MovieView from "../views/MovieView.vue";
import ConcertView from "../views/ConcertView.vue";
import LoginView from '../views/auth/LoginView.vue'

const router = createRouter({
    history: createWebHistory(),
    scrollBehavior(_to, _from, _savedPosition) {
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
        {
            path: '/login',
            component: LoginView,
        }
    ]
});

export default router;