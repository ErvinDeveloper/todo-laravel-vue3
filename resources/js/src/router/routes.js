import Tasks from "@/src/pages/Tasks.vue";
import Home from "@/src/pages/Home.vue";

const routes = [
    {
        path: '/',
        component: Home,
        name: 'home'
    },
    {
        path: '/tasks',
        component: Tasks,
        name: 'tasks'
    }
];

export default routes
