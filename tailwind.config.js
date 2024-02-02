const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            xl: '1280px'
          },
        fontSize: {
            'exs':'0.40rem',
            'xxs': '0.60rem',
            'sm': '0.8rem',
            'base': '1rem',
            'xl': '1.25rem',
            '2xl': '1.563rem',
            '3xl': '1.953rem',
            '4xl': '2.441rem',
            '5xl': '3.052rem',
          },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                whiteSmoke: 'hsl(0, 0%, 96%)',
                darkBlue: 'hsl(209, 99%, 27%)',
                lightBlue: 'hsl(218, 73%, 53%)',
                lightBlack: 'hsl(0, 1%, 30%)',
              }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
