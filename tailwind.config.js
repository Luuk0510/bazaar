import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';


/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/preline/dist/*.js',
    ],

    theme: {
        extend: {
            colors: {
                red: {
                    100: '#fee2e2',
                    950: '#7f1d1d',
                },
                green: {
                    100: '#d1fae5',
                    950: '#064e3b',
                },
                blue: {
                    100: '#dbeafe',
                    950: '#1e3a8a',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    safelist: [
        'bg-red-100',
        'bg-red-950',
        'bg-green-100',
        'bg-green-950',
        'bg-blue-100',
        'bg-blue-950',
    ],

    plugins: [
        forms,
    ],
};
