/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./app/views/**/*.{php, html}",
      "./public/**/*.{php, js}",
  ],
  theme: {
    extend: {
      colors: {
        'black-rgba': 'rgba(0, 0, 0, 0.64)',
      },
      keyframes: {
        fadeIn: {
          '0%': {opacity: '0', transform: 'translateY(-20px)'},
          '100%': {opacity: '1', transform: 'translateY(0)'},
        },
        fadeOut: {
          '0%': {opacity: '1', transform: 'translateY(0)'},
          '100%': {opacity: '0', transform: 'translateY(-20)'},
        },
      },
      animation: {
        fadeIn: 'fadeIn 0.3s ease-out',
        fadeOut: 'fadeOut 0.3s ease-out',
      },
    },
  },
  plugins: [],
}