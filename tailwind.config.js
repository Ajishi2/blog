/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue', // if using Vue
    './resources/**/*.jsx', // if using React/JSX
    './resources/**/*.ts',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};


