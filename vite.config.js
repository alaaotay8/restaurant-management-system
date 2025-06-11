import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/admin_style.css', 'resources/js/admin_script.js'],
            refresh: true,
        }),
    ],
});
