/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./src/**/*.php",
  ],
  theme: {
    colors: {
      'matcha': '#A7C957',
      'matcha-light': '#DAF166',
      'matcha-accent': '#8AB545',
      'grey-lavender': '#D7D7F2',
      'pink-watermelon': '#FF6B95',
      'text': '#464242',
      'footer-text': '#FFF8E2',
    },
    
    extend: {
      backgroundImage: {
        'footer': "url('/public/images/footer-bg.avif'), url('/public/images/footer-bg.webp'), url('/public/images/footer-bg.svg')",
      },
    },
  },
  plugins: [],
}

