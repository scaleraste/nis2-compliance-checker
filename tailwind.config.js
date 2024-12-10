import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {

            keyframes: {
                'fade-in': {
                  '0%': { opacity: 0 },
                  '100%': { opacity: 1 },
                },
              },
              animation: {
                'fade-in': 'fade-in 0.5s ease-in forwards',
              },

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],

            },
        },
    },

    plugins: [forms, require('flowbite/plugin')],
    darkMode: 'false',
};
