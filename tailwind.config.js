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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            gradientColorStopPositions: {
              33: '33%',
            },
            colors:{
              primary: {
                50: "#ececf3",
                100: "#c5c6d0",
                200: "#9fa1b3",
                300: "#787a96",
                400: "#51537a",
                500: "#2a2d5d",
                600: "#22254a",
                700: "#1a1c38",
                800: "#121226",
                900: "#161d35",
                950: "#04050a",
              },
              secondary: {
                50: "#f1ccf1",
                100: "#d9b3d9",
                200: "#c7c7c7",
                300: "#bd98bd",
                400: "#9f7d9f",
                500: "#816381",
                600: "#674d67",
                700: "#4f394f",
                800: "#432f43",
                900: "#4a2b4c",
              },
            }
        },
    },

    plugins: [forms],
};
