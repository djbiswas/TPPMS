import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                forest: {
                    DEFAULT: '#16382f',
                    dark: '#0f241e',
                    light: '#1f4a3d',
                },
                gold: {
                    DEFAULT: '#c4a36a',
                    dark: '#a8884e',
                },
                cream: '#f4efe6',
                zelle: '#6d1ed4',
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
        },
    },

    plugins: [forms],
};
