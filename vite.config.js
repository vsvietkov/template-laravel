import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import svgr from 'vite-plugin-svgr';
import i18n from 'laravel-react-i18n/vite';

export default defineConfig({
    server: {
        host: '0.0.0.0',
    },
    plugins: [
        laravel({
            input: ['resources/js/app.tsx'],
            refresh: true,
        }),
        react(),
        svgr(),
        i18n(),
    ],
});
