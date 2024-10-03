import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import vueDevTools from 'vite-plugin-vue-devtools'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/js/app.js',
                'resources/css/tabler.min.css',
                'resources/js/tabler.min.js',
                'resources/css/tabler-vendors.min.css',
                'resources/css/tabler-payments.min.css',
                'resources/libs/apexcharts/dist/apexcharts.min.js',
                'resources/libs/jsvectormap/dist/js/jsvectormap.min.js',
                'resources/libs/jsvectormap/dist/maps/world.js',
                'resources/libs/jsvectormap/dist/maps/world-merc.js',
                'resources/css/tabler-flags.css',
                'resources/css/demo.min.css',
                'resources/js/demo-theme.min.js',
                'resources/js/demo.min.js'
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
            devtools: true,
        }),
        vueDevTools(),
    ],
    resolve: {
        alias: {
            'resources': path.resolve(__dirname, 'resources'),
            '@img': path.resolve(__dirname, './resources/img'),
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});