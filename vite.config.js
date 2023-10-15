import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/videojs.css',
                'resources/js/app.js',
                'resources/js/videojs.js',
                'resources/js/bootstrap.js',
                'resources/js/app2.js',
                'resources/js/ckeditor.js',
                'resources/js/custom.js',
                'resources/js/metisMenu.js'
            ],
            refresh: true,
        }),
    ],
});
