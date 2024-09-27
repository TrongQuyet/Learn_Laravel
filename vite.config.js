import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@": "/resources/js",
        },
    },
    // server: {
    //     https: false,
    //     host: true,
    //     strictPort: true,
    //     port: 3000,
    //     hmr: {
    //         host: 'localhost',
    //     },
    // },
});
