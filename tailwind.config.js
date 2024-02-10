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
                lightPink: 'hsl(18, 100%, 96%)',
                lightBlue: 'hsl(199, 87%, 83%)',
                darkBlue: 'hsl(199, 41%, 64%)',
                headerBlue: 'hsl(198, 100%, 46%)',
              }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
