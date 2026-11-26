import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/components/mind-training-cta.css',
                'resources/css/components/mind-skill-callout.css',
                'resources/css/components/theme-dropdown.css',
                'resources/css/components/media-upload.css',
                'resources/js/theme-dropdown-boot.js',
                'resources/js/admin-boot.js',
                'resources/css/pages/home.css',
                'resources/css/pages/about.css',
                'resources/css/pages/programs.css',
                'resources/css/pages/testimonials.css',
                'resources/css/pages/blogs.css',
                'resources/css/pages/contact.css',
                'resources/css/pages/gallery.css',
                'resources/css/pages/coming-soon.css',
                'resources/js/app.js',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
