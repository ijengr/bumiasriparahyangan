import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        // Production optimizations with esbuild (faster than terser)
        minify: 'esbuild',
        target: 'es2015',
        rollupOptions: {
            output: {
                manualChunks: {
                    // Split vendor code for better caching
                    vendor: ['alpinejs'],
                },
            },
        },
        // Chunk size warnings
        chunkSizeWarningLimit: 600,
        // Asset file names
        assetsInlineLimit: 4096, // Inline assets smaller than 4kb
    },
    // Development server
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    // CSS optimization
    css: {
        devSourcemap: false,
    },
});
