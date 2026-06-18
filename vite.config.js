import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                    'resources/css/login.css',
                    'resources/js/app.js',
                    'resources/css/dashboard.css',
                    'resources/css/compass_nw.css',
                    'resources/css/nilai.css',
                    'resources/css/mata_kuliah.css',
                    'resources/css/nilai_detail.css',
                    'resources/css/rps.css'
                ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
