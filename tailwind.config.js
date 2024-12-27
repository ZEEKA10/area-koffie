/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./views/**/*.{html,js,php}", // Semua file HTML dan JS di dalam folder views
    "./src/**/*.{html,js,php}", // Jika ada file HTML atau JS dalam folder src
  ],
  theme: {
    extend: {
      colors: {
        color1: "##fcd34d",
        color2: "##fef9c3",
        color3: "#FAFFAF",
        colors: {
          'coffee-dark': '#2b2522',
          'coffee-light': '#3c322d',
      }
      },
    },
  },
  plugins: [require("daisyui")],
};
