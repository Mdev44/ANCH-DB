/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: "class",
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",],
  theme: {
    extend: {
      colors: {
        'paradise-pink': '#FF8997',
        'forest-green-crayola': '#6CAE75',
        'sky-blue-crayola': '#8AE1FC',
        'fish': '#A0D3E7',
        'sea': '#3CDFFF',
        'bugs': '#B0DEA3',
        'villagers': '#C4A484',
      },
    },
  },
  plugins: [],
}
