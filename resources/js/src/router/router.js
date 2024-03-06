import { createRouter, createWebHistory } from "vue-router"
import routes from "@/src/router/routes";

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active',
    routes
})

export default router;
