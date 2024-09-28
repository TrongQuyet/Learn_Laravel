import { createWebHistory, createRouter } from "vue-router";
import Login from "@/pages/Login.vue";

const routes = [
    {
        path: "/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/dashboard",
        name: "Dashboard",
        component: () => import("@/pages/Dashboard.vue"),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
