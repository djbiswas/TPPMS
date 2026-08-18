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
                    DEFAULT: '#0A2621',
                    dark: '#071c18',
                    light: '#12352e',
                },
                gold: {
                    DEFAULT: '#C29C6D',
                    dark: '#a67d4e',
                },
                cream: '#F5F1E8',
                canvas: '#F9F9F7',
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
