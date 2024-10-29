/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./html/**/*.{html,js}"],
  prefix: 'tw-',
  theme: {
    extend: {
      fontFamily: {
        poppins: ['Poppins', 'sans-serif'],
      },
      fontWeight: {
        thin: '100',
        extralight: '200',
        light: '300',
        normal: '400',
        medium: '500',
        semibold: '600',
        bold: '700',
        extrabold: '800',
        black: '900',
      },
      colors: {
        customOrange: '#ee7e1b',
        customBlue: '#002852',
      },
      fontSize: {
        'custom-size1': '10rem',
        'custom-size2': '5rem',
      },
    },
  },
  plugins: [],
};