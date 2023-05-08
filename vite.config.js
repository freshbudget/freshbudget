import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/marketing.css',
                'resources/css/app.css', 
                'resources/js/marketing.js',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
