import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    safelist: [
        'bg-red-600', 'hover:bg-red-700', 'focus:ring-red-500',
        'bg-green-600', 'hover:bg-green-700', 'focus:ring-green-500',
        'bg-blue-600', 'hover:bg-blue-700', 'focus:ring-blue-500',
        'bg-yellow-600', 'hover:bg-yellow-700', 'focus:ring-yellow-500',
        'bg-gray-600', 'hover:bg-gray-700', 'focus:ring-gray-500',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
