import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin' 

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/marketing.css',
                'resources/js/marketing.js',
                'resources/js/highcharts.js',
                'resources/css/highcharts.css',
                'resources/css/app.css', 
                'resources/js/app.js'
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
                'app/Controllers/**',
            ],
        }),
    ],
});
