import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

//const path = require('path') // Path module für ältere Node Versionen

export default defineConfig(({ command, mode }) => {
    return {
        base: (command == 'build') ? "/backend/build/": '',
        plugins: [
            laravel({
                input: [
                    "resources/sass/app.scss",
                    "resources/js/app.js",
                    "resources/js/views/backend/dashboard.js",
                    "resources/js/views/wizard/summary.js",
                ],
                refresh: true,
            }),
        ],
        server: {
            hmr: false,
        },
        resolve: {
            alias: {
                "~bootstrap": path.resolve(
                    __dirname,
                    "./node_modules/bootstrap"
                ),
                "~fonts": path.resolve(__dirname, "./resources/webfonts"),
            },
        },
    };
});
